<?php

namespace Component;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use App\Helpers\GeneralHelper;

class Block extends DataObject {

	private static $table_name = 'Block';
	private static $description = 'Section Block';
	private static $singular_name = 'General Block';
	private static $plural_name = 'General Blockes';

	private static $db = [
		'Name' => 'Varchar(255)',
		'Heading' => 'Varchar(255)',
		'Description' => 'HTMLText',
		'Published' => 'Boolean(1)',
		'SortOrder' => 'Int'
	];
	private static $default_sort = 'SortOrder';

	private static $has_one = [
		'Page' => SiteTree::class
	];
	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];

	private static $summary_fields = [
		'Name' => 'Name',
		'ClassName.ShortName' => 'Block Type'
	];

	public function getCMSValidator()
	{
		return FieldHelper::Required(['Name']);
	}

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder','PageID','Name','Heading','Description']);
		
		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Text('Name'),
			FieldHelper::Text('Heading'),
			FieldHelper::HTMLEditor('Description', 'Description', $this),
		]);

		return $fields;
	}

	public function resetFields($fields)
	{
		$tempFields = $fields;
		foreach ($fields->dataFields() as $key => $field) {
			if (!in_array($field->getName(), ['Name', 'Published', 'SortOrder'])) {
				$fields->removeByName($field->getName());
			}
		}
		// debug::endshow($field->getName());
		return $tempFields;
	}

}