<?php

namespace Submission;

use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;

class Registration extends DataObject {
	
	private static $table_name = 'Registration';

	private static $description = 'Membership Registration records.';
	private static $singular_name = 'Membership';
	private static $plural_name = 'Memberships';

	private static $has_many = [];

	private static $db = [
		'Organization' => 'Varchar(100)',
		'Email' => 'Varchar(100)',
		'AdminName' => 'Varchar(50)',
		'Protocol' => 'Varchar(20)',
		'WebsiteURL' => 'Varchar(150)',
		'Password' => 'Varchar(50)',
		'RePassword' => 'Varchar(150)',
		'Project_price' => 'Varchar(50)',
		'Project_billed' => 'Varchar(50)',
		'Project_payload' => 'Varchar(50)',
		'Project_origin' => 'Varchar(100)',
		'Project_domain' => 'Varchar(100)',
		'Project_package_type' => 'Varchar(50)'
	];

	private static $summary_fields = [
		'Organization' => 'Organization',
		'Email' => 'Email',
		'AdminName' => 'Admin Name',
		'Protocol' => 'Protocol',
		'WebsiteURL' => 'Website URL',
		'Created' => 'Date Submitted'
	];

	private static $field_labels = [
		'Organization' => 'Organization',
		'Email' => 'Email',
		'AdminName' => 'Admin Name',
		'Protocol' => 'Protocol',
		'WebsiteURL' => 'Website URL',
	];

	public static $export_fields = [
		'Organization' => 'Organization',
		'Email' => 'Email',
		'AdminName' => 'Admin Name',
		'Protocol' => 'Protocol',
		'WebsiteURL' => 'Website URL',
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