<?php

namespace App\Forms;

use App\Helpers\FieldHelper;

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
use SilverStripe\Dev\Backtrace;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Forms\HiddenField;

use App\Subscriptions\Submission;

class ContactForm extends Form {

	private static $field_labels = [
		'Message' => 'Message',
		'Name' => 'Name',
		'Email' => 'Email'
	];

	private static $auto_response_template = 'AutoResponseEmail';
	private static $auto_response_email_from = '';
	private static $show_link_to_recipients = false;
	private static $config_is_ajax = false;
	protected $no_recipients = false;

	private static $required_fields = [
		'Name', 'Email'
	];

	public $is_ajax = false;
	public $active_page;
	public $success_redirect = false;

	public function FieldList() {
		$labels = Config::inst()->get(get_class($this), 'field_labels');

		$list = [
			FieldHelper::Textarea('Message', $labels['Message'])->setAttribute('placeholder', 'Can you tell us something what you need or want?'),
			FieldHelper::Text('Name', $labels['Name'])->setAttribute('placeholder', 'Juan Dela Cruz'),
			FieldHelper::Input('email', 'Email', $labels['Email'])->setAttribute('placeholder', 'juandelacruz@softwarecompany.com'),
			FieldHelper::Invisiblecaptcha(),
		];
		// debug::endshow($list);

		$fields = new FieldList($list);

		return $fields;
	}

	function __construct($controller, $name = ContactForm::class, $TemplatePath=ContactForm::class) {

		$this->active_page = $controller;

		$fields = $this->FieldList();
		$actions = new FieldList(FormAction::create('doSubmit'));
		$requiredFields = new RequiredFields(
			Config::inst()->get(get_class($this), 'required_fields')
		);

		if (SSViewer::hasTemplate([$TemplatePath])) {
			$this->setTemplate($TemplatePath);
		}

		$fields->push(HiddenField::create('BackURL', 'BackURL', $controller->Link()));

		parent::__construct($controller, $name, $fields, $actions, $requiredFields);
	}

	public function doSubmit(Array $RawData, Form $Form)
	{
		$SiteConfig = DataObject::get_one(SiteConfig::class);
		$Controller = $Form->getController();
		$Data = Convert::raw2sql($RawData);
		$isSent = false;
		$Recaptcha = $Form->Fields()->dataFieldByName('Recaptcha');
		if (!empty($Recaptcha)) {
			$captchaResponse = $Recaptcha->getVerifyResponse();
			// debug::show($captchaResponse['success']);
			// debug::show($Controller->request->getVar('blockid'));
			// debug::show($SiteConfig);
			if ($SiteConfig->hasMethod('Enquiries') AND (isset($captchaResponse['success']) AND $captchaResponse['success'])) {
				// debug::endshow($Data);
				// debug::endshow($SiteConfig->Enquiries());
				$Submission = Submission::create();
				$Submission->BlockID = $Controller->request->getVar('blockid');
				$Form->saveInto($Submission);
				$Submission->write();
				if ($SiteConfig->Enquiries()->hasMethod('add')) {
					/*add ID to Contact form summission for this form type*/
					$SiteConfig->Enquiries()->add($Submission->ID);
				}

				$isSent = $this->sendEmail($Data, $Submission, $Controller);
			}
		}

		if ($isSent != true) {
			$Form->sessionMessage('There Something wrong, email not sent!');
			return $Controller->redirect($Data['BackURL']);
		} else {
			return $this->onSuccess($Form->getController(), $SiteConfig);
		}
	}

	public function sendEmail(&$Data, $Submission, $Controller)
	{
		$SiteConfig = DataObject::get_one(SiteConfig::class);
		if ($SiteConfig->hasMethod('Recipients')) {
			$FormRecipients = $SiteConfig->Recipients();
			// debug::endshow($FormRecipients);
			if ($FormRecipients->Count()) {
				$RecipientData = $FormRecipients;
			} else {
				$RecipientData = ArrayList::create([
					['Name' => 'Eddie', 'Email' => 'garciaeddiem@gmail.com']
				]);
				$this->no_recipients = true;
			}
			// debug::endshow($RecipientData);
			if (isset($Submission)) {
				$Data['Submission'] = $Submission;
			}
			if (Config::inst()->get(get_class($this), 'show_link_to_recipients')) {
				$Data['FormLink'] = Director::absoluteBaseURL() . trim($Controller->Link(), '/');
			}
			if ($this->no_recipients) {
				$Data['NoRecipients'] = 'Has no recipients with this form! '.
					Director::absoluteBaseURL().'admin/pages/edit/show/'.$Controller->ID.'#Root_Recipients';
			}
			// debug::endshow($Data);
			$Email = new Email();
			//Set Email From
			$Email->setSubject('You have received a new Send-Data Enquiry.');
			$Email->setFrom($Data['Email']);

			foreach ($RecipientData as $Recipient) {
				if (isset($Recipient->Name) AND $Recipient->Name) {
					$Data['RecipientName'] = $Recipient->Name;
					$Email->addTo($Recipient->Email, $Recipient->Name);
				} else {
					$Email->addTo($Recipient->Email);
				}
			}
			$Data['Greetings'] = 'New Enquiry.';
			// debug::endshow($Data);
			$Template = Config::inst()->get(get_class($this), 'auto_response_template');
			$Email->setHTMLTemplate($Template);
			$Email->setData($Data);
			
			if (isset($Data['Email']) AND isset($Data['Name'])) {
				$Email->setReplyTo($Data['Email'], $Data['Name']); //Reply to
			}
			// debug::endshow($Email);
			// $Email->setSandboxMode(true);
			return $Email->send();
		}
		return false;
	}

	public function onSuccess($Controller=null, $SiteConfig=null)
	{
		if (!is_null($SiteConfig)) {
			$Link = $Controller->Link();

			if ($SiteConfig->hasMethod('TyPage')) {
				$ThankYouPage = $SiteConfig->TyPage();
			} elseif ($SiteConfig->TyPageID) {
				$ThankYouPage = $SiteConfig->TyPage();
			}
			if (isset($ThankYouPage)) {
				$Link = $ThankYouPage->Link();
			}
			// debug::endshow($Link);
			return $Controller->redirect($Link);
		}
		return $Controller->redirect('/page-not-found/');
	}
}
