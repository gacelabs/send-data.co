<?php
namespace App\Contacts;

use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\Debug;
use ContactUsPage;

class Recipient extends DataObject
{
	private static $table_name = 'Recipient';
	private static $description = 'Email contact details';
	private static $singular_name = 'Recipient';
	private static $plural_name = 'Recipients';

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

	private static $searchable_fields = [
		'Name',
		'Email',
	];

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder']);
		return $fields;
	}

	public function getCMSValidator(){
		return new RequiredFields(Email::class);
	}
}