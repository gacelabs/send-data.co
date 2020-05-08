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
use InvalidArgumentException;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use App\Helpers\GeneralHelper;

use Component\Models\DropdownObject;
use Component\Models\FormBlockField;
use Component\Models\Recipient;

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
								$List = explode(',', trim($Field->CustomDropdown));
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
		// debug::show($Controller);
		// debug::endshow($Data);

		// debug::endshow($this->Form->getSubmissions());
		if ($this->Form->hasMethod('getSubmissions')) {
			$Submission = $this->Form->getSubmissions()::create();
			$Form->saveInto($Submission);
			$Submission->write();
			// add ID to Contact form summission for this form type
			// $Controller->Submissions()->add($Submission->ID);
		}

		if ($this->Form->hasMethod('getRecipients') AND isset($Submission)) {
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
				$RecipientData->push(['Name' => 'Devs', 'Email' => 'garciaeddiem+devs@gmail.com']);
				$this->no_recipients = true;
			}
			// debug::endshow($RecipientData);
			foreach ($RecipientData as $Recipient) {
				if (isset($Recipient->Name) AND $Recipient->Name) {
					$Data['RecipientName'] = $Recipient->Name;
				}
				$EmailClass = $this->prepareEmail($Data, $Submission, $Controller);
				$EmailClass->setData($Data);
				$EmailClass->setTo($Recipient->Email);
				// $EmailClass->setBCC(['eddie@ypdigital.com.au']);
				$EmailClass->setReplyTo($Data['Email'], $Data['AdminName']); //Reply to
				// debug::endshow($EmailClass);
				$EmailClass->send();
			}
		}

		return $this->onSuccess($Form->getController());
	}

	public function prepareEmail(&$Data, $Submission, $Controller)
	{
		$subject = $this->Form->SubjectLine ?: 'New Enquiry';
		$From    = $this->Form->RecipientEmailFrom ?: $Submission->Email;

		$EmailClass = new Email($From, '', $subject);

		$Data['Submission'] = $Submission;
		if ($this->no_recipients) {
			$Data['NoRecipients'] = 'Has no recipients with this form! '.$this->Form->getName();
		}

		$EmailClass->setHTMLTemplate(Config::inst()->get(get_class($this), 'auto_response_template'));
		return $EmailClass;
	}

	public function onSuccess($Controller=null)
	{
		if (!is_null($Controller)) {
			$ThankYouPage = SiteTree::get()->byID($Controller->TyPageID);
			// debug::endshow($ThankYouPage);
			$Link = $Controller->Link();
			if ($ThankYouPage->Exists()) {
				$Link = $ThankYouPage->Link();
			}
			return $Controller->redirect($Link);
		}
		return $Controller->redirect('/page-not-found/');
	}
}