<?php

namespace Component\Blocks;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use Component\Models\ImageItem;
use Component\Block;

class ColumnImagesBlock extends Block {

	private static $table_name = 'ColumnImagesBlock';

	private static $description = 'Add column images block';
	private static $singular_name = 'Column image block';
	private static $plural_name = 'Column image blocks';

	private static $db = [];
	private static $has_one = [];

	private static $has_many = [
		'ImageItems' => ImageItem::class
	];

	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];
	private static $summary_fields = [];

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields = $this->owner->resetFields($fields);
		
		$fields->addFieldsToTab('Root.Main', [
			GridHelper::sortable('ImageItems', 'Image Items', $this->ImageItems())
		]);

		return $fields;
	}

	public function forTemplate()
	{
		return $this;
	}

}