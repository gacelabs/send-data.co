<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;

class BillingPeriod extends DataObject {

	private static $table_name = 'BillingPeriod';

	private static $description = 'Add Billing Period';
	private static $singular_name = 'Billing Period';
	private static $plural_name = 'Billing Periods';

	private static $db = [
		'Name' => 'Varchar(255)',
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
	];

	public function getCMSValidator(){
		return FieldHelper::Required(['Name']);
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder']);

		return $fields;
	}

}
