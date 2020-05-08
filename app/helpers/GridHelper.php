<?php

namespace App\Helpers;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;

use Colymba\BulkManager\BulkManager;
use Colymba\BulkUpload\BulkUploader;

use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

class GridHelper {

	public static function sortable($name, $title, $list = null, $limit = 50,  $sort_field = 'SortOrder', $add_button = true){

		$gridConfig = GridFieldConfig_RelationEditor::create($limit)
				->addComponent(new GridFieldSortableRows($sort_field))
				->removeComponentsByType(GridFieldAddExistingAutocompleter::class);

		if(!$add_button){
			$gridConfig->removeComponentsByType(GridFieldAddNewButton::class);
		}

		$gridField = GridField::create($name, $title,
			$list,
			$gridConfig
		);

		return $gridField;
	}

	public static function relational($name, $title, $list = null, $columns = [], $limit = 100){
		$gridConfig = GridFieldConfig_RelationEditor::create($limit)
				->removeComponentsByType(GridFieldAddExistingAutocompleter::class);

		$grid = new GridField($name, $title, $list, $gridConfig);

		if(!empty($columns)){
			$config = $grid->getConfig();
			$dataColumns = $config->getComponentByType(GridFieldDataColumns::class);
			$dataColumns->setDisplayFields($columns);
		}

		return $grid;
	}

	public static function bulkupload($name, $title, $list = null){
		$config = GridFieldConfig_RelationEditor::create(100)
				->addComponent(new GridFieldSortableRows('SortOrder'))
				->addComponent(new BulkManager())
				->addComponent(new BulkUploader(null, null, true));

		return  new GridField($name, $title, $list, $config);
	}

	public static function custom($name, $title, $list = null, $limit = 100){
		$gridConfig = GridFieldConfig_RelationEditor::create($limit)
				->removeComponentsByType(GridFieldAddExistingAutocompleter::class);

		$grid = new GridField($name, $title, $list, $gridConfig);
		return $grid;
	}

}
