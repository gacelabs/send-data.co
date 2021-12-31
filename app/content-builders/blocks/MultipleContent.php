<?php

namespace ContentBuilder\Blocks;

use ContentBuilder\GeneralBlock;

use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

use ContentBuilder\Blocks\Models\StepItem;

class MultipleContent extends GeneralBlock {

	private static $table_name    = 'MultipleContent';
	private static $singular_name = 'Multiple Content';
	private static $plural_name   = 'Multiple Contents';

	private static $db = [
		'HideTitles' => 'Boolean',
	];

	public $block_css = [];
	public $block_js = [];
	public $block_templates = [];
	
	private static $has_many = [
		'StepItems' => StepItem::class,
	];

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		parent::resetFields($fields, ['Content', 'StepItems']);
		
		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Checkbox('HideTitles'),
			GridHelper::sortable('StepItems', 'Steps', $this->StepItems()),
		], 'Content');

		return $fields;
	}

}
