<?php

use SilverStripe\View\Requirements;
use SilverStripe\View\SSViewer;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\Control\Controller;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

use App\Models\PackageType;

class RegistrationPage extends ContentBuilder
{
	private static $table_name = 'RegistrationPage';
	private static $description   = 'A Registration Page to build using blocks';
	private static $singular_name = 'Registration Page';
	private static $plural_name   = 'Registration Pages';

	private static $can_be_root = true;
	public $cache_layout = true;
	public $no_css_js = false;

	private static $allowed_children = [];

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
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['Content']);

		return $fields;
	}

}

class RegistrationPageController extends ContentBuilderController
{
	private static $allowed_actions = [
		'view'
	];

	private static $url_handlers = [
		'view/$ID/$Name' => 'view'
	];
	
	public function init() {
		parent::init();
	}
	
	public function view() {
		$params = $this->owner->request->params();
		$ID = $params['ID'];
		$Name = $params['Name'];

		// debug::endshow(PackageType::get_by_id($ID));
		return $this->owner->customise([
			'PackageTypes' => PackageType::get(),
			'PackageType' => PackageType::get_by_id($ID),
		])->renderWith('Layout\\RegistrationPage_view');
	}

}
