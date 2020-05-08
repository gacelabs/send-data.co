<?php

namespace Component\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;

use Component\FormBlock;
use Component\Models\Recipient;

class SelectRecipient extends DataObject {

	private static $table_name = 'SelectRecipient';
	private static $description = '';
	private static $singular_name = 'Recipient';
	private static $plural_name = 'Recipients';

	private static $db = [
		'SortOrder' => 'Int'
	];

	private static $default_sort = 'SortOrder';

	private static $has_one = [
		'FormBlock' => FormBlock::class,
		'Recipient' => Recipient::class
	];

	private static $summary_fields = [
		'Recipient.Name' => 'Name',
		'Recipient.Email' => 'Email'
	];

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder']);

		$fields->addFieldToTab('Root.Main', FieldHelper::HeaderField('SelectRecipient')->setHeadingLevel(1), 'RecipientID');

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Dropdown('RecipientID', 'Select a recipient', Recipient::get())
		]);

		return $fields;

	}
}