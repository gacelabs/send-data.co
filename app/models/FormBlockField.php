<?php

namespace Component\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\FormField;
use SilverStripe\Core\ClassInfo;

use App\Helpers\FieldHelper;
use App\Helpers\GeneralHelper;
use App\Subscriptions\Registrations;
use Component\FormBlock;
use Component\Models\DropdownObject;

class FormBlockField extends DataObject {

	private static $table_name = 'FormBlockField';
	private static $description = '';
	private static $singular_name = 'Field';
	private static $plural_name = 'Fields';

	private static $db = [
		'GridName'	=> 'Varchar(200)',
		'Name'	=> 'Varchar(200)',
		'ExtraClass' => 'Varchar(200)',
		'Type' => 'Varchar(200)',
		'DataType' => 'Varchar(200)',
		'DropdownObject' => 'Varchar(200)',
		'CustomDropdown' => 'Text',
		'DefaultValue' => 'Varchar(255)',
		'PlaceHolder' => 'Varchar(255)',
		'Required' => 'Boolean',
		'Readonly' => 'Boolean',
		'Disabled' => 'Boolean',
		'Invisible' => 'Boolean',
		'SortOrder' => 'Int'
	];
	private static $default_sort = 'SortOrder';

	private static $has_one = [];
	private static $has_many = [];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];
	private static $summary_fields = [
		'GridName' => 'Title',
		'Type' => 'Type',
		'DataType' => 'DataType'
	];

	public function getCMSValidator(){
		return new RequiredFields(['Name']);
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder','FormBlockID']);
		$FieldTypes = get_class_methods(FieldHelper::class);
		// debug::endshow($FieldTypes);
		foreach ([0,5,8,10,15,16,17,19,20,21] as $index) unset($FieldTypes[$index]); /*these are CMS fields*/
		$Types = [];
		foreach ($FieldTypes as $Value) $Types[$Value] = ucwords(GeneralHelper::CamelNameConcat($Value));
		// debug::endshow($Types);
		ksort($Types);
		$ClassInfo = ClassInfo::dataClassesFor(DropdownObject::class);
		unset($ClassInfo['component\models\dropdownobject']);
		$DropdownObjects = [];
		$DropdownObjects['Custom'] = 'Custom';
		foreach ($ClassInfo as $class => $name) {
			$class = str_replace(['Component\\Models\\'], '', $name);
			$name = str_replace(['Item', 'Component\\Models\\'], '', $name).'s';
			$DropdownObjects[$class] = GeneralHelper::CamelNameConcat($name);
		}
		// debug::endshow($DropdownObjects);

		$fields->addFieldToTab('Root.Main', FieldHelper::HeaderField('FormField')->setHeadingLevel(1), 'GridName');

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Dropdown('Type', 'Field Type', $Types),

			FieldHelper::Text('DefaultValue')->hideIf('Type')->isEqualTo('File')
				->orIf("Type")->isEqualTo("Upload")
				->orIf()
					->group()
						->orIf("DropdownObject")->isNotEqualTo("Custom")
				->end(),

			FieldHelper::Dropdown('DataType', 'Field Data Type', 
				['email'=>'email','number'=>'number','password'=>'password','url'=>'url'])
					->hideIf('Type')->isNotEqualTo('Input')->end(),

			FieldHelper::Dropdown('DropdownObject', 'Select a data object', $DropdownObjects, FALSE)
				->hideIf('Type')->isNotEqualTo('Dropdown')
					->andIf("Type")->isNotEqualTo("ListBox")
					->andIf("Type")->isNotEqualTo("OptionsetField")
				->end(),

			FieldHelper::Checkbox('Invisible')->hideIf('Type')->isEqualTo('Hidden')->end(),
			FieldHelper::Text('PlaceHolder')->hideIf('Type')->isEqualTo('Hidden')->end(),

			FieldHelper::Textarea('CustomDropdown', 'Custom dropdown values')
				->setDescription('<span style="color: red;">Comma separated values only!</span>')
				->hideIf("DropdownObject")->isNotEqualTo("Custom")
					->orIf()
						->group()
							->andIf('Type')->isNotEqualTo('Dropdown')
							->andIf("Type")->isNotEqualTo("ListBox")
							->andIf("Type")->isNotEqualTo("OptionsetField")
				->end(),
		]);

		return $fields;
	}
}
