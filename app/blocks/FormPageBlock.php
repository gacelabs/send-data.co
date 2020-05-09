<?php

namespace Component\Blocks;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\Control\Controller;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use Component\Block;
use Component\FormBlock;
use Component\FormHandler;
use Component\FormSubmissionBlock;

class FormPageBlock extends Block {

	private static $table_name = 'FormPageBlock';

	private static $description = 'Add a form block in a page';
	private static $singular_name = 'Form page block';
	private static $plural_name = 'Form page blocks';

	private static $db = [
		'Title' => 'Varchar',
		'SubTitle' => 'Varchar',
		'SortOrder' => 'Int'
	];

	private static $has_one = [
		'FormBlock' => FormBlock::class
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
			FieldHelper::Text('Title'),
			FieldHelper::Text('SubTitle'),
			FieldHelper::Dropdown('FormBlockID', 'Select a form', FormBlock::get())
		]);

		return $fields;
	}

	public function GetForm()
	{
		// debug::endshow($this->FormBlock()->Submission());
		$Form = new FormHandler($this->getController(), $this->FormBlock());
		$Form->setFormAction(Controller::curr()->Link() . 'DataForm/?id=' . $this->FormBlock()->ID);
		return $Form;
	}

	public function getController()
	{
		return Controller::curr();
	}

	public function forTemplate()
	{
		return $this;
	}

}