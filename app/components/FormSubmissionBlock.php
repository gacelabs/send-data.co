<?php

namespace Component;

use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

use Component\Models\FormBlockField;

class FormSubmissionBlock extends DataObject {

	private static $table_name = 'FormSubmissionBlock';
	private static $description = '';
	private static $singular_name = 'Submission';
	private static $plural_name = 'Submissions';

	private static $db = [
		'Name' => 'Varchar(100)',
		'SortOrder' => 'Int'
	];
	private static $default_sort = 'SortOrder';

	private static $has_many = [];
	private static $has_one = [];

	private static $many_many = [
		'FormBlockFields' => FormBlockField::class
	];

	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];

	private static $summary_fields = [
		'Name' => 'Name'
	];

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder', 'FormBlockFields']);

		$fields->addFieldToTab('Root.Main', FieldHelper::HeaderField('Data Submissions')->setHeadingLevel(1), 'Name');

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::ListBox('FormBlockFields', 'Form Fields', FormBlockField::get()->map('ID', 'GridName')->toArray())
		]);

		return $fields;
	}
}
