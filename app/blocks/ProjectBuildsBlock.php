<?php

namespace Component\Blocks;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use Component\Models\ProjectBuild;
use Component\Block;

class ProjectBuildsBlock extends Block {

	private static $table_name = 'ProjectBuildsBlock';

	private static $description = 'Add columned block with project image';
	private static $singular_name = 'Projects columned block';
	private static $plural_name = 'Projects columned blocks';

	private static $db = [];
	private static $has_one = [];

	private static $has_many = [
		'ProjectBuilds' => ProjectBuild::class
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
			GridHelper::sortable('ProjectBuilds', 'Image Content Items', $this->ProjectBuilds())
		]);

		return $fields;
	}

	public function forTemplate()
	{
		return $this;
	}

}