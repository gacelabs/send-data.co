<?php

namespace ContentBuilder\Blocks\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

class ImageItem extends DataObject {
	
	private static $table_name = 'ImageItem';
	private static $singular_name = 'Image';
	private static $plural_name   = 'Images';
	
	private static $db = [
		'Title' => 'Varchar',
		'SortOrder' => 'Int',
	];

	private static $has_one = [
		'Image' => Image::class,
	];

	private static $summary_fields = array(
		'Title' => 'Title',
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Text('Title'),
			FieldHelper::Upload('Image')->setDescription('<em>(Dimensions: 1920x1080)</em>')
		]);

		return $fields;
	}

}