<?php

namespace Component\Models;

use SilverStripe\Forms\RequiredFields;
use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\Debug;

use Component\Models\FormBlockField;

class CustomDropdown extends DataObject
{
	private static $table_name = 'CustomDropdown';
	private static $description = '';
	private static $singular_name = 'CustomDropdown';
	private static $plural_name = 'CustomDropdowns';

	private static $db = [
		'Name' => 'Varchar(255)',
		'Value' => 'Varchar(255)',
		'SortOrder' => 'Int'
	];

	private static $has_one = [
		'FormBlockField' => FormBlockField::class
	];
	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];

	private static $field_labels = [
		'Name' => 'Name',
		'Value' => 'Value'
	];

	private static $summary_fields = [
		'Name' => 'Name',
		'Value' => 'Value'
	];

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder','FormBlockFieldID']);
		return $fields;
	}

	public function getCMSValidator(){
		return new RequiredFields(['Name','Value']);
	}
}