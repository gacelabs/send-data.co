<?php

namespace Component\Blocks;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use Component\Models\MembershipItem;
use Component\Block;

class MembershipBlock extends Block {

	private static $table_name = 'MembershipBlock';

	private static $description = 'Membership blocks content';
	private static $singular_name = 'Membership block';
	private static $plural_name = 'Membership blocks';

	private static $db = [
		'Anchor' => 'Varchar(20)'
	];
	private static $has_one = [];

	private static $has_many = [
		'MembershipItems' => MembershipItem::class
	];

	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];
	private static $summary_fields = [];

	public $page_js = [
		'properties/js/calc.js'
	];

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields = $this->owner->resetFields($fields);
		
		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Text('Anchor'),
			GridHelper::sortable('MembershipItems', 'Membership Items', $this->MembershipItems())
		]);

		return $fields;
	}

	public function forTemplate()
	{
		return $this;
	}

}