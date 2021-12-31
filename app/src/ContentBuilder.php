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

class ContentBuilder extends Page
{
	private static $table_name = 'ContentBuilder';
	private static $description   = 'A generic page to build using blocks';
	private static $singular_name = 'Content Builder';
	private static $plural_name   = 'Content Builders';

	private static $can_be_root = true;
	public $cache_layout = true;
	public $no_css_js = false;

	public $page_js = [];
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

class ContentBuilderController extends PageController
{
	private static $allowed_actions = [];
	
	public function init() {
		parent::init();
	}

}
