<?php

namespace ContentBuilder\Blocks;

use ContentBuilder\GeneralBlock;

use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

class ColumnedContent extends GeneralBlock {

	private static $table_name    = 'ColumnedContent';
	private static $singular_name = 'Columned Content';
	private static $plural_name   = 'Columned Contents';

	private static $db = [
		'Column1' => 'HTMLText',
		'Column2' => 'HTMLText',
		'Column3' => 'HTMLText',
	];

	public $block_css = [];
	public $block_js = [];
	
	public $block_templates = [
		'TwoColumn' => 'Two Column Content',
		'ThreeColumn' => 'Three Column Content',
	];

	private static $has_many = [];

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		parent::resetFields($fields);
		// debug::endshow($this->Template);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::HTMLEditor('Column1', 'Column 1')->setRows(8)
				->displayIf('Template')->isEqualTo('TwoColumn')
					->orIf('Template')->isEqualTo('ThreeColumn')->end(),
			FieldHelper::HTMLEditor('Column2', 'Column 2')->setRows(8)
				->displayIf('Template')->isEqualTo('TwoColumn')
					->orIf('Template')->isEqualTo('ThreeColumn')->end(),
			FieldHelper::HTMLEditor('Column3', 'Column 3')->setRows(8)
				->displayIf('Template')->isEqualTo('ThreeColumn')->end(),
		], 'Content');

		return $fields;
	}

}
