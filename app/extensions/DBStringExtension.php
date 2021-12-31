<?php
namespace App\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Dev\Debug;
use SilverStripe\View\Parsers\URLSegmentFilter;

class DBStringExtension extends DataExtension {

	public function NoSpaces() {
		return preg_replace('/\s/', '', trim($this->owner->Value));
	}

	public function toLowerCase() {
		return strtolower(trim($this->owner->Value));
	}

	public function toUpperCase() {
		return strtoupper(trim($this->owner->Value));
	}

	public function stripTags() {
		return strip_tags(trim($this->owner->Value));
	}

	public function Round($num=1) {
		return round(trim($this->owner->Value), $num);
	}

	public function MoneyFormat() {
		return '$'.number_format(trim($this->owner->Value), 0);
	}

	public function leftTrim() {
		return ltrim(trim($this->owner->Value), '/');
	}

	public function rightTrim() {
		return rtrim(trim($this->owner->Value), '/');
	}

	public function NiceURL() {
        $filter = URLSegmentFilter::create();
        $value = $filter->filter(trim($this->owner->Value));
		return $value;
	}

	public function removeString($string='') {
		return str_replace($string, '', trim($this->owner->Value));
	}
}