<?php

namespace Component\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;

use Component\Block;
use Component\Blocks\ColumnImagesBlock;
use Component\Models\DropdownObject;

class ImageItem extends DropdownObject {

	private static $table_name = 'ImageItem';
	private static $description = '';
	private static $singular_name = 'Image';
	private static $plural_name = 'Images';

	private static $db = [
		'SortOrder' => 'Int'
	];
	private static $default_sort = 'SortOrder';

	private static $has_one = [
		'Image' => Image::class,
		'ColumnImagesBlock' => ColumnImagesBlock::class
	];
	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];
	private static $summary_fields = [
		'Image.Title' => 'Filename'
	];

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder','ColumnImagesBlockID']);
		
		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Upload('Image')
		]);
		return $fields;
	}

	public function forTemplate()
	{
		return $this;
	}

}