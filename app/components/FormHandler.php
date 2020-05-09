<?php

namespace Component;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Convert;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\Director;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\View\SSViewer;
use SilverStripe\Dev\Debug;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Core\ClassInfo;
use SilverStripe\View\Requirements;
use InvalidArgumentException;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use App\Helpers\GeneralHelper;

use Component\Models\DropdownObject;
use Component\Models\FormBlockField;
use Component\Models\Recipient;
use Component\Models\FormSubmissionData;

class FormHandler extends Form {

	public $RequiredFields = [];
	public $Form = null;
	public $Fields = null;
	public $Controller = null;
	private static $auto_response_template = 'ResponseEmail';
	protected $no_recipients = false;

	public function FieldList()
	{
		if ($this->Form AND $this->Form->hasMethod('FormBlockFields')) {
			$SelectFormField = $this->Form->FormBlockFields();
			$Fields = $RequiredFields = [];
			if ($SelectFormField->Count()) {
				foreach ($SelectFormField as $key => $FormField) {
					$Field = FormBlockField::get()->byID($FormField->FormFieldID);
					if ($Field->Exists()) {
						// debug::endshow($Field);
						$Name = str_replace(' ', '', $Field->Name);
						$Label = GeneralHelper::CamelNameConcat($Name);
						$PlaceHolder = $Field->PlaceHolder ?: $Label;
						if (strtolower($Field->Type) == 'input') {
							$FieldData = FieldHelper::{$Field->Type}($Field->DataType, $Name, $Label)
								->setAttribute('placeholder', $PlaceHolder);
						} else if (in_array(strtolower($Field->Type), ['dropdown','listbox','optionsetfield'])) {
							$List = [];
							if (strtolower($Field->DropdownObject) == 'custom') {
								// debug::endshow($Field->CustomDropdowns());
								// $List = explode(',', trim($Field->CustomDropdown));
								$List = $Field->CustomDropdowns();
							} else {
								if (ClassInfo::hasTable($Field->DropdownObject)) {
									$List = DropdownObject::get()->Filter('ClassName', 'Component\\Models\\'.$Field->DropdownObject);
								}
							}
							$FieldData = FieldHelper::{$Field->Type}($Name, $Label, $List, false);
						} else {
							$FieldData = FieldHelper::{$Field->Type}($Name, $Label);
							if (in_array(strtolower($Field->Type), ['text','textarea','input'])) {
								$FieldData->setAttribute('placeholder', $PlaceHolder);
							}
						}
						if ($Field->ExtraClass) {
							$FieldData->addExtraClass($Field->ExtraClass);
						}
						$Fields[] = $FieldData;
						if ($Field->Required) $this->RequiredFields[] = $Name;
						if ($Field->Invisible) $FieldData->addExtraClass('d-none');
						if ($Field->DefaultValue) $FieldData->setValue($Field->DefaultValue);
					}
				}
			}
			$this->Fields = new FieldList($Fields);
			// debug::endshow($this->RequiredFields);
			return true;
		}
		return false;
	}

	public function __construct($Controller, $FormData)
	{
        Requirements::javascript('https://www.google.com/recaptcha/api.js?onload=reCaptchaLoad&render=explicit');
		$this->Controller = $Controller;
		$this->Form = $FormData;
		$this->FieldList();
		// debug::endshow($Controller->Form);

		$Actions = new FieldList(FormAction::create('doSubmit')->setTitle($this->Form->ActionName ?: 'Submit'));
		$RequiredFields = new RequiredFields($this->RequiredFields);
		$Template = $this->Form->FormTemplate ?: 'Form\\DataForm'; 

		if (SSViewer::hasTemplate($Template)) {
			$this->setTemplate($Template);
		}
		// debug::endshow($Controller);

		parent::__construct($Controller, 'FormHandler', $this->Fields, $Actions, $RequiredFields);
	}

	public function doSubmit(Array $RawData, Form $Form)
	{
		$Controller = $Form->getController();
		$Data = Convert::raw2sql($RawData);
		/*debug::show($this->Form->Submission());
		debug::endshow($Data);*/
		$TemplateData = ArrayList::create();

		$Submission = $this->Form->Submission();
		// debug::endshow($Submission->Exists());
		if ($this->Form->hasMethod('Submission') AND $Submission->Exists()) {
			$Columns = $Submission->FormBlockFields();
			// debug::show($Columns);
			$FormData = [];
			foreach ($Columns as $key => $FormBlockField) {
				if ($FormBlockField->DropdownObject == 'Custom') {
					$Value = $Data[$FormBlockField->Name];
					if ($FormBlockField->CustomDropdowns()->Exists()) {
						$Value = $FormBlockField->CustomDropdowns()->byID($Value)->Value;
					}
				}
				$FormData[$FormBlockField->Name] = $Value;
				$TemplateData->push(['label' => $FormBlockField->Name, 'value' => $Value]);
			}
			// debug::endshow(base64_encode(serialize($FormData)));
			$SubmissionObject = FormSubmissionData::create();
			$SubmissionObject->Data = base64_encode(serialize($FormData));
			$SubmissionObject->write();
			// debug::endshow($SubmissionObject->FormSubmissionBlocks()->hasMethod('add'));
			$SubmissionObject->FormSubmissionBlocks()->add($Submission->ID);
		} else {
			// $this->Form->sessionMessage('Form has no assigned Submission! Please contact us!', 'bad');
		}
		// debug::endshow($Submission);
		// debug::endshow($this->Form->getSubmissions());

		if ($this->Form->hasMethod('getRecipients') AND isset($Submission) AND isset($Data['Email'])) {
			$FormRecipients = $this->Form->getRecipients();
			// debug::endshow($FormRecipients);
			$RecipientData = ArrayList::create();
			if ($FormRecipients->Count()) {
				foreach ($FormRecipients as $Person) {
					$Recipient = Recipient::get()->byID($Person->RecipientID);
					if ($Recipient->Exists()) {
						$RecipientData->push($Recipient);
					}
				}
			} else {
				$RecipientData->push(['Name' => 'Devs', 'Email' => 'gacelabs.inc+devs@gmail.com']);
				$this->no_recipients = true;
			}
			// debug::endshow($RecipientData);
			foreach ($RecipientData as $Recipient) {
				if (isset($Recipient->Name) AND $Recipient->Name) {
					$Data['RecipientName'] = $Recipient->Name;
				}
				$EmailClass = $this->prepareEmail($Data, $TemplateData, $Controller);
				$EmailClass->setData($Data);
				$EmailClass->setTo($Recipient->Email);
				// $EmailClass->setBCC(['eddie@ypdigital.com.au']);
				// $EmailClass->setReplyTo($Data['Email'], $Data['AdminName']); //Reply to
				// debug::endshow($EmailClass);
				$EmailClass->send();
			}
		}

		return $this->onSuccess($Form->getController(), $Data);
	}

	public function prepareEmail(&$Data, $TemplateData, $Controller)
	{
		$subject = $this->Form->SubjectLine ?: 'New Enquiry';
		$From    = $this->Form->RecipientEmailFrom ?: $Data['Email'];

		$EmailClass = new Email($From, '', $subject);

		$Data['Submission'] = $TemplateData;
		if ($this->no_recipients) {
			$Data['NoRecipients'] = 'Has no recipients with this form! '.$this->Form->getName();
		}
		$EmailClass->setHTMLTemplate(Config::inst()->get(get_class($this), 'auto_response_template'));

		return $EmailClass;
	}

	public function onSuccess($Controller=null, $Data=null)
	{
		/*check some BackURL links*/
		// debug::endshow($this->Form);
		$SelFields = $this->selectedFields();
		$BackURLData = $SelFields->Filter('FormField.Name', 'BackURL');
		if ($BackURLData->Count() AND in_array($this->Form->ActionName, ['Login', 'Register'])) {
			$BackURLData = $BackURLData->First()->FormField();
			$GETUrl = [];
			if ($this->Form->ActionName == 'Login') {
				foreach ($SelFields->Filter('FormField.Name:Not', 'BackURL') as $key => $Selects) {
					$Name = $Selects->FormField()->Name;
					$GETUrl['accounts'][$Name] = $Data[$Name];
				}
			} else {
				foreach ($SelFields->Filter('FormField.Name:Not', 'BackURL') as $key => $Selects) {
					$Name = $Selects->FormField()->Name;
					$toUse = explode('_', $Name);
					if (count($toUse) > 1) {
						$index = strtolower($toUse[0]);
						$hash = $toUse[1];
						if (count($toUse) == 3) {
							$hash .= '_'.$toUse[2];
						}
						$GETUrl[$index][$hash] = $Data[$Name];
					}
				}
			}
			// debug::show($GETUrl);
			$URL = $BackURLData->DefaultValue.'?'.http_build_query($GETUrl);
			// debug::endshow($URL);
			return $Controller->redirect($URL);
		} else {
			if (!is_null($Controller)) {
				$ThankYouPage = SiteTree::get()->byID($Controller->TyPageID);
				// debug::endshow($ThankYouPage);
				$Link = $Controller->Link();
				if ($ThankYouPage->Exists()) {
					$Link = $ThankYouPage->Link();
				}
				return $Controller->redirect($Link);
			}
		}
	
		return $Controller->redirect('/page-not-found/');
	}

	public function selectedFields()
	{
		return $this->Form->FormBlockFields();
	}

	public function isInGroupWith($ID)
	{
		$Field = FormBlockField::get()->byID($ID);
		if ($Field->Exists()) {
			return $Field->InGroup;
			// debug::endshow($Field->InGroup);
		}
		return FALSE;
	}
}