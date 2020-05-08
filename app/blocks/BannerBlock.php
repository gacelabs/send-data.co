<?php

namespace Component\Blocks;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\CMS\Model\SiteTree;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use Component\Block;

class BannerBlock extends Block {

	private static $table_name = 'BannerBlock';

	private static $description = 'Banner block content';
	private static $singular_name = 'Banner block';
	private static $plural_name = 'Banner blocks';

	private static $db = [
		/*RIGHT*/
		'UpperRightText' => 'HTMLText',
		'UpperRightSubText' => 'Text',
		'UpperRightButtonText' => 'Varchar(50)',
		'IsRightButtonAnchor' => 'Boolean',
		'RightButtonAnchorText' => 'Varchar(50)',
		/*LEFT*/
		'UpperLeftText' => 'HTMLText',
		'UpperLeftSubText' => 'Text',
		'UpperLeftButtonText' => 'Varchar(50)',
		'IsLeftButtonAnchor' => 'Boolean',
		'LeftButtonAnchorText' => 'Varchar(50)',
	];

	private static $has_one = [
		'Banner' => Image::class,
		'UpperRightButton' => SiteTree::class,
		'UpperLeftButton' => SiteTree::class
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
			FieldHelper::Upload('Banner'),
			/*RIGHT*/
			FieldHelper::HTMLEditor('UpperRightText'),
			FieldHelper::Textarea('UpperRightSubText'),
			FieldHelper::Text('UpperRightButtonText'),
			FieldHelper::Checkbox('IsRightButtonAnchor'),
			FieldHelper::Text('RightButtonAnchorText')->displayIf('IsRightButtonAnchor')->isChecked()->end(),
			FieldHelper::Wrap(FieldHelper::TreeDropdown('UpperRightButtonID', 'Right Link', SiteTree::class))
				->hideIf('IsRightButtonAnchor')->isChecked()->end(),
			/*LEFT*/
			FieldHelper::HTMLEditor('UpperLeftText'),
			FieldHelper::Text('UpperLeftSubText'),
			FieldHelper::Text('UpperLeftButtonText'),
			FieldHelper::Checkbox('IsLeftButtonAnchor'),
			FieldHelper::Text('LeftButtonAnchorText')->displayIf('IsLeftButtonAnchor')->isChecked()->end(),
			FieldHelper::Wrap(FieldHelper::TreeDropdown('UpperLeftButtonID', 'Left Link', SiteTree::class))
				->hideIf('IsLeftButtonAnchor')->isChecked()->end()
		]);

		return $fields;
	}
}