<?php

namespace ContentBuilder\Blocks\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Forms\RequiredFields;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

use ContentBuilder\Blocks\MultipleContent;

class StepItem extends DataObject {
	
	private static $table_name = 'StepItem';
	private static $singular_name = 'Step';
	private static $plural_name   = 'Steps';
	
	private static $db = [
		'Title' => 'Varchar',
		'Description' => 'HTMLText',
		'SortOrder' => 'Int',
	];

	private static $has_one = [
		'Image' => Image::class,
		'MultipleContent' => MultipleContent::class,
	];

	private static $summary_fields = array(
		'Title' => 'Title',
	);

	public function getCMSValidator() {
		return RequiredFields::create(['Title']);
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		foreach (self::$db as $key => $value) $fields->removeByName($key);
		foreach (self::$has_one as $key => $value) $fields->removeByName($key.'ID');
		foreach (self::$has_one as $key => $value) $fields->removeByName($key);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Text('Title'),
			FieldHelper::HTMLEditor('Description'),
			FieldHelper::Upload('Image'),
		]);

		return $fields;
	}

}