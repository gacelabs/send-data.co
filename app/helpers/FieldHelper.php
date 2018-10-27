<?php

namespace App\Helpers;

use SilverStripe\Forms\TextField;
use SilverStripe\Forms\ListboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HiddenField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TimeField;
use SilverStripe\Forms\FileField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\Forms\HeaderField;
use App\Helpers\GeneralHelper;
use SilverStripe\Forms\SelectionGroup;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use SilverStripe\ORM\SS_List;
use SilverStripe\Assets\Upload;

class FieldHelper{
	
	public static function Required($array = array()){
		return new RequiredFields($array);
	}

	public static function Text($name = null, $title = null, $description = null){
	    if($description)
            return TextField::create($name, $title ?: GeneralHelper::CamelName($name))->setDescription($description);

		return TextField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function Dropdown($name = null, $title = null, $list){
		return DropdownField::create($name, $title ?: GeneralHelper::CamelName($name), $list)->setEmptyString('(Select one)');
	}

	public static function Upload($name = null, $title = null, $description = null, $baseFolder = null, SS_List $items = null){
		if ($items instanceof SS_List) {
	    	$field = UploadField::create($name, $title ?: GeneralHelper::CamelName($name), $items);
		} else {
	    	$field = UploadField::create($name, $title ?: GeneralHelper::CamelName($name));
		}

		if ($baseFolder != null) {
	    	$Upload = Upload::create();
	    	$field->setUpload($Upload);
	    	$field->setFolderName($baseFolder);
		}

	    if($description) {
	        $field->setDescription($description);
	    }

		return $field;
	}

	public static function file($name = null, $title = null, $description = null){
		return new FileField($name, $title, $description);
	}

	public static function Accordion(&$fields, $name = null, $title = null, $list = array(), $heading_level = 4){
		foreach($list as $field){
			$fields->removeByName($field->Name);
		}
		return ToggleCompositeField::create($name, $title ?: GeneralHelper::CamelName($name), $list)->setHeadingLevel($heading_level);
	}

	public static function ListBox($name, $title, $list, $value = false){
		return ListboxField::create($name, $title ?: GeneralHelper::CamelName($name), $list, $value);
	}

    public static function OptionsetField($name, $title, $list, $value = false){
        return OptionsetField::create($name, $title ?: GeneralHelper::CamelName($name), $list, $value);
    }

	public static function TreeDropdown($name = null, $title = null, $class = null){
		return TreeDropdownField::create($name, $title ?: GeneralHelper::CamelName($name), $class)->setEmptyString('(Select one)');
	}

	public static function Checkbox($name = null, $title = null, $value = null){
		return CheckboxField::create($name, $title ?: GeneralHelper::CamelName($name), $value);
	}

	public static function HTMLEditor($name = null, $title = null){
		return HTMLEditorField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function Textarea($name = null, $title = null){
		return TextareaField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function Hidden($name = null, $title = null){
		return HiddenField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function Date($name = null, $title = null){
		return DateField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function Time($name = null, $title = null){
		return TimeField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function HTMLText($value = ''){
		return DBHTMLText::create()->setValue($value);
	}

    public static function HeaderField($name = null, $title = null){
        return HeaderField::create($name, $title ?: GeneralHelper::CamelName($name));
    }

    public static function SelectionGroup($name = null, $title = null){
        return SelectionGroup::create($name, $title ?: GeneralHelper::CamelName($name));
    }

}