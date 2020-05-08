<?php

namespace Submission;

use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;

class Subscriptions extends DataObject {
	
	private static $table_name = 'Subscriptions';

	private static $description = 'Subscription record details.';
	private static $singular_name = 'Subscription';
	private static $plural_name = 'Subscriptions';

	private static $has_many = [];

	private static $db = [
		'FirstName' => 'Varchar(255)',
		'LastName' => 'Varchar(255)',
		'Phone' => 'Varchar(255)',
		'Email' => 'Varchar(255)',
		'KeepMePosted' => 'Boolean',
		'Comments' => 'Text'
	];

	private static $summary_fields = [
		'FirstName' => 'First Name',
		'LastName' => 'Last Name',
		'Phone' => 'Phone',
		'Email' => 'Email',
		'KeepMePosted' => 'Keep me posted',
		'Created' => 'Date Submitted'
	];

	private static $field_labels = [
		'FirstName' => 'First Name',
		'LastName' => 'Last Name',
		'Phone' => 'Phone',
		'Email' => 'Email',
		'KeepMePosted' => 'Keep me posted',
		'Comments' => 'Comments',
	];

	public static $export_fields = [
		'FirstName' => 'First Name',
		'LastName' => 'Last Name',
		'Phone' => 'Phone',
		'Email' => 'Email',
		'Comments' => 'Comments',
		'KeepMePosted' => 'Keep me posted',
		'Created' => 'Date Submitted'
	];

	public function Created() {
		return FieldHelper::HTMLText(date('F j, Y g:i a', strtotime($this->owner->Created)));
	}

	public function KeepMePosted() {
		return FieldHelper::HTMLText($this->owner->KeepMePosted ? 'Yes' : 'No');
	}

	public function canCreate($member = null, $context = array()) {
		return false;
	}

	public function canEdit($member = null) {
		return false;
	}

	public function EmailFieldValues() {
		$arr = array();
		$labels = Config::inst()->get(get_class($this), 'field_labels');
		$db = Config::inst()->get(get_class($this), 'db');

		foreach ($labels as $field => $label) {
			$val = '';
			if (isset($db[$field])) {
				if($db[$field] == 'Boolean') {
					$val = $this->$field ? 'Yes' : 'No';
				} elseif ($this->hasMethod($field)) {
					$val = $this->$field();
				} else {
					$val = $this->$field;
				}
			} elseif ($this->hasMethod($field)) {
				$val = $this->$field();
			}
			if (!empty($val)) {
				$arr[$field] = array('label' => $label, 'value' => $val);
			}
		}

		return new ArrayList($arr);
	}

}