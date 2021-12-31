<?php

namespace ContentBuilder;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Core\Config\Config;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Dev\Debug;
use SilverStripe\Assets\File;

use App\Helpers\FieldHelper;
use App\Helpers\GeneralHelper;
use App\Helpers\CacheHelper;

use App\Models\ExtraClass;

use Page;

class GeneralBlock extends DataObject {

	private static $table_name = 'GeneralBlock';
	private static $singular_name = 'General Block';
	private static $plural_name   = 'General Blocks';

	private static $db = [
		'Name' => 'Varchar',
		'Block' => 'Varchar',
		'ExtraClasses' => 'Varchar',
		'Published' => 'Boolean',
		'Content' => 'HTMLText',
		'Template' => 'Varchar',
		'SortOrder' => 'Int',
	];

	private static $default_sort = 'SortOrder';

	private static $has_one = [
		'Parent' => Page::class,
	];

	private static $defaults = [
		'Published' => 1,
	];

	private static $summary_fields = [
		'ClassSingularName' => 'Block',
		'Name' => 'Name',
		'Published.Nice' => 'Published',
	];

	private static $searchable_fields = [
		'Block',
		'Name'
	];

	public static $classes = [
		'no-padding' => 'No Padding',
		'no-padding-top' => 'No Padding Top',
		'no-padding-bottom' => 'No Padding Bottom',
	];

	public $block_templates = [];
	public $block_css = [];
	public $block_js = [];

	public function arrayTemplates() {
		if (!empty($this->block_templates)) {
			return $this->block_templates;
		} else {
			return false;
		}
	}

	public function getTemplateName()
	{
		$TemplateName = $this->Template ? $this->Template : 'None';
		return FieldHelper::HTMLText(GeneralHelper::CamelName($TemplateName));
	}

	public function isPublished()
	{
		return FieldHelper::HTMLText($this->owner->Published ? 'Yes' : 'No');
	}

	public function getClassSingularName()
	{
		$name = Config::inst()->get($this->owner, 'singular_name');
		return FieldHelper::HTMLText($name);
	}

	public function SingularName()
	{ 
		return Config::inst()->get($this->owner, 'singular_name');
	}

	/*public function getCMSValidator() {
		return RequiredFields::create(['Name']);
	}*/

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['ParentID', 'SortOrder', 'Name', 'ExtraClasses', 'Published', 'Content', 'Block', 'Template']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Text('Name')->setAttribute('required', 'required'),
			FieldHelper::ListBox('ExtraClasses', 'Extra Classes', self::$classes),
			FieldHelper::Checkbox('Published'),
			FieldHelper::HTMLEditor('Content')->setRows(8),
		]);

		$Templates = $this->arrayTemplates();
		if ($Templates) {
			$fields->addFieldToTab('Root.Main', 
				FieldHelper::Dropdown('Template', null, $Templates)->setHasEmptyDefault(false), 
			'Published');
		}

		return $fields;
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();
		$this->Block = Config::inst()->get($this->owner, 'singular_name');
		// debug::endshow($this);
	}

	public function onAfterWrite() {
		parent::onAfterWrite();
		// $this->Parent()->write();
	}

	/*public function validate() 
	{
		$result = parent::validate();
		if($this->Name == '' OR strlen(trim($this->Name)) == 0) {
			$result->addFieldError('Name', '"Name" is required', 'required');
		}
		return $result;
	}*/

	public function getElementClasses()
	{
		$ClassesText = [];
		$Classes = self::$classes;
		$ExtraClasses = json_decode($this->owner->ExtraClasses, true);
		if ($ExtraClasses) {
			foreach ($ExtraClasses as $key => $value) {
				if (in_array($value, array_keys($Classes))) {
					// debug::show($value);
					$ClassesText[] = $value;
				}
			}
		}
		// debug::endshow($ClassesText);
		return implode(' ', $ClassesText);
	}

	public static function resetFields(&$fields, $Columns=[])
	{
		if (count($Columns) == 0) $Columns = ['Content'];
		foreach ($fields->dataFields() as $key => $field) {
			if (in_array($field->getName(), $Columns)) {
				$fields->removeByName($field->getName());
			}
		}
	}
}
