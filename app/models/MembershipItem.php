<?php

namespace Component\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\CMS\Model\SiteTree;

use App\Helpers\FieldHelper;

use Component\Block;
use Component\Blocks\MembershipBlock;
use Component\Models\DropdownObject;

class MembershipItem extends DropdownObject {

	private static $table_name = 'MembershipItem';
	private static $description = '';
	private static $singular_name = 'Membership';
	private static $plural_name = 'Memberships';

	private static $db = [
		'Title' => 'Varchar(150)',
		'Content' => 'HTMLText',
		'ButtonText' => 'Varchar(150)',
		'IsSlider' => 'Boolean',
		'Max' => 'Int',
		'SortOrder' => 'Int'
	];
	private static $default_sort = 'SortOrder';

	private static $has_one = [
		'Page' => SiteTree::class,
		'MembershipBlock' => MembershipBlock::class
	];
	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];

	private static $summary_fields = [
		'Title' => 'Title',
		'Page.Title' => 'Page'
	];

	public function getCMSValidator()
	{
		return FieldHelper::Required(['Title', 'Content']);
	}

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder','PageID','MembershipBlockID','IsSlider']);
		
		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Text('Title'),
			FieldHelper::Checkbox('IsSlider', 'Slider enabled?'),
			FieldHelper::Text('Max', 'Max Number')->displayIf('IsSlider')->isChecked()->end(),
			FieldHelper::HTMLEditor('Content', 'Content', $this),
			FieldHelper::Text('ButtonText'),
			FieldHelper::TreeDropdown('PageID', 'Link', SiteTree::class)
		]);
		return $fields;
	}

	public function forTemplate()
	{
		return $this;
	}

}