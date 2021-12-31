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

class HomePage extends ContentBuilder
{
	private static $table_name = 'HomePage';
	private static $description   = 'A home page to build using blocks';
	private static $singular_name = 'Home Page';
	private static $plural_name   = 'Home Pages';

	private static $can_be_root = true;
	public $cache_layout = true;
	public $no_css_js = false;

	public $page_js = [];
	public $page_css = [];
	public $page_mobile_js = [];
	public $page_mobile_css = [];

	private static $db = [
		'Introduction' => 'HTMLText'
	];

	private static $has_one = [
		'BackgroundImage' => Image::class,
	];

	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['Content']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Upload('BackgroundImage')->setDescription('<em>(Dimensions: 1920x515)</em>'),
			FieldHelper::HTMLEditor('Introduction')->setRows(8),
		], 'Metadata');

		return $fields;
	}

}

class HomePageController extends ContentBuilderController
{
	private static $allowed_actions = [];
	
	public function init() {
		parent::init();
	}

}
