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
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\PasswordField;

use SilverStripe\ORM\SS_List;
use SilverStripe\Assets\Upload;
use UncleCheese\DisplayLogic\Forms\Wrapper;
use SilverStripe\CMS\Forms\SiteTreeURLSegmentField;
use RyanPotter\SilverStripeColorField\Forms\ColorField;
use SilverStripe\Control\Controller;
use Annix\SilverStripeRecaptcha\InvisibleRecaptchaField;

class FieldHelper {

	public static function Required($array = array()){
		return new RequiredFields($array);
	}

	public static function Text($name = null, $title = null, $description = null, $value = null){
		if($description)
			return TextField::create($name, $title ?: GeneralHelper::CamelName($name))->setDescription($description);

		if ($value) {
			/*debug::endshow(TextField::create($name, $title ?: GeneralHelper::CamelName($name), $value));*/
			return TextField::create($name, $title ?: GeneralHelper::CamelName($name), $value);
		}

		return TextField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function Dropdown($name = null, $title = null, $list=null, $empty_string=true){
		if ($empty_string) {
			return DropdownField::create($name, $title ?: GeneralHelper::CamelName($name), $list)->setEmptyString('(Select one)');
		} else {
			return DropdownField::create($name, $title ?: GeneralHelper::CamelName($name), $list)->setHasEmptyDefault(false);
		}
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

	public static function File($name = null, $title = null, $description = null){
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

	public static function HTMLEditor($name = null, $title = null, $object = null){
		$default_rows = 4;
		/*set the rows base on the content*/
		if (!is_null($object) OR Controller::curr()->hasMethod('currentPage')) {
			if (is_null($object) AND Controller::curr()->hasMethod('currentPage')) {
				$object = Controller::curr()->currentPage();
			}
			// debug::endshow($object->$name);
			if (isset($object->{$name}) AND trim($object->{$name}) != '') {
				${$name} = preg_replace('/<\/.+?>/', '<br />', $object->{$name});
				$rows = substr_count(${$name}, '<br />');
				$default_rows = ceil((int)$rows/* * 1.2*/);
				// debug::endshow($default_rows);
			}
		}
		return HTMLEditorField::create($name, $title ?: GeneralHelper::CamelName($name))->setRows($default_rows);
	}

	public static function Textarea($name = null, $title = null, $object = null){
		$default_rows = 4;
		/*set the rows base on the content*/
		if (!is_null($object) OR Controller::curr()->hasMethod('currentPage')) {
			if (is_null($object) AND Controller::curr()->hasMethod('currentPage')) {
				$object = Controller::curr()->currentPage();
			}
			if (isset($object->{$name}) AND trim($object->{$name}) != '') {
				$default_rows = ceil(substr_count($object->{$name}, "\n") * 2);
			}
		}
		return TextareaField::create($name, $title ?: GeneralHelper::CamelName($name))->setRows($default_rows);
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

	public static function Input($field_type='text', $name = null, $title = null, $description = null){
		switch (strtolower($field_type)) {
			case 'email':
			$InputField = EmailField::create($name, $title ?: GeneralHelper::CamelName($name));
			break;

			case 'number':
			$InputField = NumericField::create($name, $title ?: GeneralHelper::CamelName($name))->setHTML5(true);
			break;

			case 'password':
			$InputField = PasswordField::create($name, $title ?: GeneralHelper::CamelName($name));
			break;

			case 'url':
			$InputField = TextField::create($name, $title ?: GeneralHelper::CamelName($name))->setAttribute('type', 'url');
			break;

			default: /*text*/
			$InputField = TextField::create($name, $title ?: GeneralHelper::CamelName($name));
			break;
		}

		if($description) {
			$InputField->setDescription($description);
		}
		return $InputField;
	}

	public static function Wrap($field = null){
		return Wrapper::create($field);
	}

	public static function URLSegment($name = null, $title = null, $url = '/'){
		return SiteTreeURLSegmentField::create($name, $title ?: GeneralHelper::CamelName($name))->setURLPrefix($url);
	}

	public static function ColorPicker($name = null, $title = null, $description = null){
		$ColorField = ColorField::create($name, $title ?: GeneralHelper::CamelName($name));
		if($description) {
			$ColorField->setDescription($description);
		}
		return $ColorField;
	}

	/*public static function Invisiblecaptcha($name = null, $title = null) {
		return InvisibleRecaptchaField::create($name, $title ?: GeneralHelper::CamelName($name));
	}*/

}