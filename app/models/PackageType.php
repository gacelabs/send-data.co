<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Dev\Debug;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\ArrayList;

use App\Helpers\FieldHelper;

use App\Models\BillingPeriod;

use RegistrationPage;

class PackageType extends DataObject {

	private static $table_name = 'PackageType';

	private static $description = 'Add a Package Type';
	private static $singular_name = 'Package Type';
	private static $plural_name = 'Package Types';

	private static $db = [
		'Name' => 'Varchar',
		'Price' => 'Currency',
		'HasPriceTrack' => 'Boolean',
		'IsActive' => 'Boolean',
		'Payload' => 'Int',
		'Description' => 'HTMLText',
		'SortOrder' => 'Int',
	];

	private static $default_sort = 'SortOrder';

	private static $has_one = [
		'Billed' => BillingPeriod::class,
	];

	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];
	
	private static $summary_fields = [
		'Name' => 'Name',
		'Billed.Name' => 'Billed',
		'IsActive.Nice' => 'Active',
	];

	public function getCMSValidator() {
		return RequiredFields::create(['Name', 'Price']);
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder', 'IsActive', 'Description']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Checkbox('IsActive', 'Active'),
			FieldHelper::HTMLEditor('Description'),
		], 'BilledID');

		return $fields;
	}

	public function RegistrationPage() {
		$RegistrationPage = RegistrationPage::get();
		// debug::endshow($RegistrationPage);
		return $RegistrationPage->Count() ? $RegistrationPage->First() : ArrayList::create(['Link' => '/']);
	}

}
