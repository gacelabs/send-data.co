<?php

namespace Component\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;
use Component\FormSubmissionBlock;

class FormSubmissionData extends DataObject {

	private static $table_name = 'FormSubmissionData';

	private static $db = [
		'Data' => 'Text',
		'SortOrder' => 'Int'
	];

	private static $default_sort = 'SortOrder';

	private static $many_many = [
		'FormSubmissionBlocks' => FormSubmissionBlock::class
	];
}