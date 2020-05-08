<?php

namespace Component\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;

use Component\Block;
use Component\Blocks\ProjectBuildsBlock;
use Component\Models\DropdownObject;

class ProjectBuild extends DropdownObject {

	private static $table_name = 'ProjectBuild';
	private static $description = '';
	private static $singular_name = 'Item';
	private static $plural_name = 'Items';

	private static $db = [
		'Title' => 'Varchar(150)',
		'Description' => 'Text',
		'SortOrder' => 'Int'
	];
	private static $default_sort = 'SortOrder';

	private static $has_one = [
		'TopImage' => Image::class,
		'ProjectBuildsBlock' => ProjectBuildsBlock::class
	];
	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];

	private static $summary_fields = [
		'Title' => 'Title',
		'Description' => 'Description'
	];

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder','ProjectBuildsBlockID']);
		
		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Upload('TopImage'),
			FieldHelper::Text('Title'),
			FieldHelper::Textarea('Description'),
		]);
		return $fields;
	}

	public function forTemplate()
	{
		return $this;
	}

}