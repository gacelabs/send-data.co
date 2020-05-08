<?php

namespace Component\Models;

use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\Debug;

use Component\FormBlock;

class Recipient extends DataObject
{
	private static $table_name = 'Recipient';
	private static $description = '';
	private static $singular_name = 'Email Contact Recipient';
	private static $plural_name = 'Email Contact Recipients';

	private static $db = [
		'Name' => 'Varchar(255)',
		'Email' => 'Varchar(255)',
		'SortOrder' => 'Int'
	];

	private static $has_one = [];
	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];

	private static $field_labels = [
		'Name' => 'Name',
		'Email' => 'Email'
	];

	private static $summary_fields = [
		'Name' => 'Name',
		'Email' => 'Email'
	];

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder']);
		return $fields;
	}

	public function getCMSValidator(){
		return new RequiredFields(['Email']);
	}
}