<?php

namespace Component\Blocks;

use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\Debug;
use SilverStripe\View\SSViewer;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use Component\Block;
use Page;

class DuplicateBlock extends Block {

	private static $table_name = 'DuplicateBlock';

	private static $description = 'Duplicate a block';
	private static $singular_name = 'Duplicate Block';
	private static $plural_name = 'Duplicate Blocks';

	private static $db = [];

	private static $has_one = [
		'ACopy' => Block::class
	];

	private static $has_many = [];
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
			FieldHelper::Dropdown('ACopyID', 'Make a block copy', Block::get())
		]);

		return $fields;
	}

	public function forTemplate()
	{
		return $this;
	}

	public function renderCopy($ClassName) {
		$Template = $this->ACopy()->ClassName ?: 'Component\\Default';
		$HTML = $this->ACopy()->renderWith($Template);
		return $HTML;
		debug::endshow($HTML);
		$Block = Block::get()->byID($this->ACopy()->ID);
		if ($Blocks) {
			foreach ($Blocks as $Block) {
				// debug::endshow($Block);
				$Template = $Block->ClassName ?: 'Component\\Default';
				$HTML .= $Block->renderWith($Template);
			}
		}
		return FieldHelper::HTMLText($HTML);
	}

}