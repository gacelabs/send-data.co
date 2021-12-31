<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;

class ExtraClass extends DataObject {

	private static $table_name = 'ExtraClass';

	private static $description = 'ExtraClass';
	private static $singular_name = 'ExtraClass';
	private static $plural_name = 'ExtraClasses';

	private static $db = [
		'Name' => 'Varchar(255)',
		'Class' => 'Varchar(255)',
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
		'Class' => 'Class'
	];

	public function getCMSValidator(){
		return FieldHelper::Required(['Name']);
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		return $fields;
	}

}
