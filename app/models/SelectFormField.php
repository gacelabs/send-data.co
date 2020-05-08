<?php

namespace Component\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;

use Component\FormBlock;
use Component\Models\FormBlockField;

class SelectFormField extends DataObject {

	private static $table_name = 'SelectFormField';
	private static $description = '';
	private static $singular_name = 'Form Field';
	private static $plural_name = 'Form Fields';

	private static $db = [
		'SortOrder' => 'Int'
	];

	private static $default_sort = 'SortOrder';

	private static $has_one = [
		'FormBlock' => FormBlock::class,
		'FormField' => FormBlockField::class
	];

	private static $summary_fields = [
		'FormField.GridName' => 'Name',
		'FormField.Type' => 'Type',
		'FormField.DataType' => 'DataType'
	];

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder']);

		$fields->addFieldToTab('Root.Main', FieldHelper::HeaderField('SelectField')->setHeadingLevel(1), 'FormBlockID');

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Dropdown('FormFieldID', 'Select a field', FormBlockField::get()->Map('ID', 'GridName'))
		]);

		return $fields;

	}
}