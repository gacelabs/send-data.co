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
use SilverStripe\Forms\SelectionGroup;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\PasswordField;
use SilverStripe\ORM\SS_List;
use SilverStripe\Assets\Upload;
use SilverStripe\CMS\Forms\SiteTreeURLSegmentField;
use SilverStripe\Control\Controller;

use UncleCheese\DisplayLogic\Forms\Wrapper;
// use RyanPotter\SilverStripeColorField\Forms\ColorField;
// use App\Overrides\CurrencyFieldOverride;
// use CyberDuck\Recaptcha\Forms\RecaptchaField;
// use CyberDuck\Recaptcha\Forms\InvisibleRecaptchaField;
use App\Helpers\GeneralHelper;

use UndefinedOffset\NoCaptcha\Forms\NocaptchaField;

class FieldHelper{

	public static function Required($array = array()){
		return new RequiredFields($array);
	}

	public static function Text($name = null, $title = null, $description = null, $value = null){
		if($description) {
			return TextField::create($name, $title ?: GeneralHelper::CamelName($name))->setDescription($description);
		}

		if ($value) {
			/*debug::endshow(TextField::create($name, $title ?: GeneralHelper::CamelName($name), $value));*/
			return TextField::create($name, $title ?: GeneralHelper::CamelName($name), $value);
		}

		return TextField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function Dropdown($name = null, $title = null, $list, $description = null){
		if($description) {
			return DropdownField::create($name, $title ?: GeneralHelper::CamelName($name), $list)
				->setDescription($description)
				->setEmptyString('Select an option');
		} else {
			return DropdownField::create($name, $title ?: GeneralHelper::CamelName($name), $list)->setEmptyString('Select an option');
		}
	}

	public static function Upload($name = null, $title = null, $description = null, $baseFolder = null, SS_List $items = null){
		if ($items instanceof SS_List) {
			$field = UploadField::create($name, $title ?: GeneralHelper::CamelName($name), $items);
		} else {
			$field = UploadField::create($name, $title ?: GeneralHelper::CamelName($name));
		}

		if($description) {
			$field->setDescription($description);
		}

		$Upload = Upload::create();
		$field->setUpload($Upload);
		if ($baseFolder != null) {
			$field->setFolderName($baseFolder);
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

	public static function ListBox($name, $title, $list, $value = false, $disabledIDs=[]){
		$Listbox = ListboxField::create($name, $title ?: GeneralHelper::CamelName($name), $list, $value);
		if (count($disabledIDs)) {
			$Listbox->setDisabledItems($disabledIDs);
		}
		return $Listbox;
	}

	public static function OptionsetField($name, $title, $list, $value = false){
		return OptionsetField::create($name, $title ?: GeneralHelper::CamelName($name), $list, $value);
	}

	public static function TreeDropdown($name = null, $title = null, $class = null){
		return TreeDropdownField::create($name, $title ?: GeneralHelper::CamelName($name), $class)->setEmptyString('Select an option');
	}

	public static function Checkbox($name = null, $title = null, $value = null){
		return CheckboxField::create($name, $title ?: GeneralHelper::CamelName($name), $value);
	}

	public static function HTMLEditor($name = null, $title = null){
		return HTMLEditorField::create($name, $title ?: GeneralHelper::CamelName($name))->setRows(4);
	}

	public static function Textarea($name = null, $title = null){
		return TextareaField::create($name, $title ?: GeneralHelper::CamelName($name))->setRows(4);
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

	public static function Input($field_type='text', $name = null, $title = null, $description = null, $is_na_enabled = false){
		switch (strtolower($field_type)) {
			case 'email':
			$InputField = EmailField::create($name, $title ?: GeneralHelper::CamelName($name));
			break;

			case 'number':
			$InputField = NumericField::create($name, $title ?: GeneralHelper::CamelName($name))->setHTML5(true);
			break;

			/*case 'currency':
			$InputField = CurrencyFieldOverride::create($name, $title ?: GeneralHelper::CamelName($name), $is_na_enabled);
			break;*/

			case 'readonly':
			$InputField = ReadonlyField::create($name, $title ?: GeneralHelper::CamelName($name));
			break;

			case 'password':
			$InputField = PasswordField::create($name, $title ?: GeneralHelper::CamelName($name));
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

	/*public static function ColorPicker($name = null, $title = null, $description = null){
		$ColorField = ColorField::create($name, $title ?: GeneralHelper::CamelName($name));
		if($description) {
			$ColorField->setDescription($description);
		}
		return $ColorField;
	}*/

	/*public static function Recaptcha() {
		// debug::endshow($Container);
		return RecaptchaField::create('Recaptcha');
	}

	public static function Invisiblecaptcha($formID='', $container='') {
		// debug::endshow($Container);
		return InvisibleRecaptchaField::create('Recaptcha', $formID, $container);
	}*/

	public static function Invisiblecaptcha($name=false, $title=false) {
		$name = $name ?: 'Recaptcha';
		return NocaptchaField::create($name, $title ?: GeneralHelper::CamelName($name));
	}

	public static function InlineFields($name=null, $lists=[], $rows=false){
		if (count($lists)) {
			foreach ($lists as $key => $field) {
				if ($rows == false) {
					$field->addExtraClass('inline-field-'.count($lists));
				} else {
					$field->addExtraClass('inline-field-'.$rows);
				}
			}
			$fields = new FieldList($lists);
			return FieldGroup::create($name, $fields);
		}
	}

	public static function DependentField($type='text', $name = null, $title = null, $data = null, $list=[], $object=false){
		if (is_null($data)) $data = [];
		
		switch (strtolower($type)) {
			case 'dropdown':
			$DependentField = self::Dropdown($name, $title ?: GeneralHelper::CamelName($name), $list);
			$DependentField->setAttribute('data-onload', 1);
			break;

			/*case 'currency':
			$DependentField = CurrencyFieldOverride::create($name, $title ?: GeneralHelper::CamelName($name));
			$DependentField->setAttribute('readonly', 'readonly');
			break;*/

			default: /*text*/
			$DependentField = self::Text($name, $title ?: GeneralHelper::CamelName($name));
			$DependentField->setAttribute('readonly', 'readonly');
			break;
		}

		if (isset($DependentField)) {
			if (!is_null($data) AND (is_array($data) AND count($data))) {
				foreach ($data as $key => $value) {
					$DependentField->setAttribute('data-'.$key, $value);
				}
			}
			return $DependentField;
		}
		return false;
	}

}