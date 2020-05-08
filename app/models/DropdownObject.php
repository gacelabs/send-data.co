<?php

namespace Component\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;

class DropdownObject extends DataObject {

	private static $table_name = 'DropdownObject';
}