<?php

namespace App\Helpers;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldExportButton;
use SilverStripe\Core\ClassInfo;

use Colymba\BulkManager\BulkManager;
use Colymba\BulkUpload\BulkUploader;

use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Blog\Forms\GridField\GridFieldConfigBlogPost;

class GridHelper{
		
	public static function sortable($name, $title, $list = null, $limit = 50,  $sort_field = 'SortOrder', $add_button = true, $export_button = false){

		$gridConfig = GridFieldConfig_RelationEditor::create($limit)
				->addComponent(new GridFieldSortableRows($sort_field))
				->removeComponentsByType(GridFieldAddExistingAutocompleter::class);

		if(!$add_button){
			$gridConfig->removeComponentsByType(GridFieldAddNewButton::class);
		}

		if (isset($export_button['add']) AND $export_button['add'] == true) {
			if (isset($export_button['button_position'])) {
				$exportButton = Injector::inst()->createWithArgs(GridFieldExportButton::class, $export_button['button_position']);
			} else {
				$exportButton = Injector::inst()->createWithArgs(GridFieldExportButton::class, ['after']);
			}

			if (isset($export_button['export_columns'])) {
				$exportButton->setExportColumns($export_button['export_columns']);
			}

			$gridConfig->addComponent($exportButton);
		}

		$gridField = GridField::create($name, $title,
			$list, 
			$gridConfig
		);

		return $gridField;
	}

	public static function relational($name, $title, $list = null, $export_button = false, $columns = [], $limit = 100){
		$gridConfig = GridFieldConfig_RelationEditor::create($limit)
				->removeComponentsByType(GridFieldAddExistingAutocompleter::class);

		/*must set static $export_fields in $list object*/
		if (ClassInfo::hasMethod($list, 'First')) {
			if (!empty($list->First()) AND $export_button == true) {
				$Class = $list->First();
				// debug::show($Class);
				$export_fields = $Class::$export_fields;
				$exportButton = Injector::inst()->createWithArgs(GridFieldExportButton::class, ['before', $export_fields]);
				$gridConfig->addComponent($exportButton);
			}
		}

		$grid = new GridField($name, $title, $list, $gridConfig);
	
		if(!empty($columns)){
			$config = $grid->getConfig();
			$dataColumns = $config->getComponentByType(GridFieldDataColumns::class);
			$dataColumns->setDisplayFields($columns);
		}

		return $grid;
	}

	public static function bulkupload($name, $title, $list = null, $setup = false){
		$BulkUploader = new BulkUploader(null, null, true);
		if ($setup) {
			$BulkUploader->setUfSetup($setup['function'], $setup['param']);
		}

		$config = GridFieldConfig_RelationEditor::create(100)
			->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
			->addComponent(new GridFieldSortableRows('SortOrder'))
			->addComponent(new BulkManager())
			->addComponent($BulkUploader);

		return new GridField($name, $title, $list, $config);
	}

	public static function custom($name, $title, $list = null, $limit = 100){
		$gridConfig = GridFieldConfig_RelationEditor::create($limit)
				->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
				
		$grid = new GridField($name, $title, $list, $gridConfig);
		return $grid;
	}

	public static function blogPostGrid($name, $label, $list, $exportFIelds = []){

		$grid = new GridField(
			$name,
			$label,
			$list,
			GridFieldConfigBlogPost::create(100)
				->addComponents($exportBtn = new GridFieldExportButton('before'))
				->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
		);

		if(!empty($exportFIelds)){
			$exportBtn->setExportColumns($exportFIelds);
		}

		return $grid;
	}

	public static function sortableMaxRows($name, $title, $list=null, $max=false){
		$add_button = true;
		if ($max AND $list) {
			if ($list->hasMethod('Count')) {
				if ($list->Count() == $max) {
					$add_button = false;
				}
			}
		}
		$grid = self::sortable($name, $title, $list, 50,  'SortOrder', $add_button, false);
		return $grid;
	}

}
