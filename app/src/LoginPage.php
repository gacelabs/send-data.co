<?php

use SilverStripe\View\Requirements;
use SilverStripe\View\SSViewer;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;

use SilverStripe\Control\Controller;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CompositeField;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

use App\Forms\LoginForm;

use App\Contacts\Recipient;
use App\Subscriptions\LoginSubmission;

class LoginPage extends ContentBuilder
{
	private static $table_name = 'LoginPage';
	private static $description   = 'A Login page to build using blocks';
	private static $singular_name = 'Login Page';
	private static $plural_name   = 'Login Pages';

	private static $can_be_root = true;
	public $cache_layout = true;
	public $no_css_js = false;

	public $page_js = [
		'required/js/jquery.validate.min.js',
		'required/js/validate-forms.js',
	];

	public $page_css = [];
	public $page_mobile_js = [];
	public $page_mobile_css = [];

	private static $db = [];

	private static $has_one = [];
	private static $has_many = [];

	private static $many_many = [
		'Recipients' => Recipient::class,
		'Enquiries' => LoginSubmission::class,
	];

	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['Content']);

		$fields->addFieldsToTab('Root.Contacts.Recipients', [
			GridHelper::relational('Recipients', 'Recipients', $this->owner->Recipients())
		]);

		$fields->addFieldsToTab('Root.Contacts.Enquiries', [
			GridHelper::relational('Enquiries', 'Enquiries', $this->owner->Enquiries(), true)
		]);

		return $fields;
	}

}

class LoginPageController extends ContentBuilderController
{
	private static $allowed_actions = [
		'LoginForm'
	];

	public function init() {
		parent::init();
	}

	public function LoginForm()
	{
		$LoginForm = new LoginForm($this, __FUNCTION__);
		// $LoginForm->setFormAction($this->Link() . 'LoginForm/?formblockid=');
		return $LoginForm;
	}
}
