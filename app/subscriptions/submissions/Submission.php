<?php

namespace App\Subscriptions;

use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;

use ContentBuilder\GeneralBlock;

class Submission extends DataObject
{
	private static $table_name = 'Submission';

	private static $description = 'Contact details and its form type.';
	private static $singular_name = 'Contact subscription';
	private static $plural_name = 'Contact subscriptions';

	private static $db = [
		'Name' => 'Varchar(255)',
		'Email' => 'Varchar(255)',
		'Message' => 'Text',
		'SortOrder' => 'Int',
	];

	private static $default_sort = 'Created DESC';

	private static $has_one = [
		'Block' => GeneralBlock::class,
	];

	private static $summary_fields = [
		'Created' => 'Enquiry Date',
		'Name' => 'Name',
		'Email' => 'Email'
	];

	private static $field_labels = [
		'Created' => 'Enquiry Date',
		'Name' => 'Lame',
		'Email' => 'Email',
		'Message' => 'Message',
	];

	public static $export_fields = [
		'Created' => 'Enquiry Date',
		'Name' => 'Name',
		'Email' => 'Email',
		'Message' => 'Message',
	];
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName(['Link', 'SortOrder', 'BlockID']);
		return $fields;
	}

	public function Created() {
		return FieldHelper::HTMLText(date('F j, Y g:i a', strtotime($this->owner->Created)));
	}

	public function canCreate($member = null, $context = array()) {
		return false;
	}

	public function canEdit($member = null) {
		return false;
	}

	public function RecipientEmailFields() {
		$arr = array();
		$labels = Config::inst()->get(get_class($this), 'field_labels');
		$db = Config::inst()->get(get_class($this), 'db');

		foreach ($labels as $field => $label) {
			$val = '';
			if (isset($db[$field])) {
				if($db[$field] == 'Boolean') {
					$val = $this->$field ? 'Yes' : 'No';
				} elseif ($this->hasMethod($field)) {
					$val = $this->{$field}();
				} else {
					$val = $this->$field;
				}
			} else {
				try {
					$val = $this->$field();
				} catch (Exception $ex) {
					if ($ex->getCode() !== 2175) {
						throw $ex;
					}
				}
			}
			if (!empty($val)) {
				$arr[$field] = array('label' => $label, 'value' => $val);
			}
		}

		return new ArrayList($arr);
	}

}