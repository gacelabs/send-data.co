<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;

class PayloadLicense extends DataObject {

	private static $table_name = 'PayloadLicense';

	private static $description = 'Add Payload License';
	private static $singular_name = 'Payload License';
	private static $plural_name = 'Payload Licenses';

	private static $db = [
		'Name' => 'Varchar',
		'IsActive' => 'Boolean',
		'Price' => 'Int',
		'Percentage' => 'Varchar',
		'SortOrder' => 'Int'
	];

	private static $default_sort = 'SortOrder';

	private static $has_one = [];
	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];
	
	private static $summary_fields = [
		'Name' => 'Name',
		'Percentage' => 'Percentage',
		'IsActive.Nice' => 'Active',
	];

	public function getCMSValidator(){
		return FieldHelper::Required(['Name', 'Price', 'Percentage']);
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder', 'Name', 'Price', 'Percentage']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Text('Name', 'Name', '<em>(required)</em>'),
			FieldHelper::Text('Price', 'Price', '<em>(required)</em>'),
			FieldHelper::Text('Percentage', 'Percentage', '<em>(required)</em>'),
		]);

		return $fields;
	}

}
