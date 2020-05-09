<?php

namespace App\LeftModelAdmin;

use SilverStripe\Admin\ModelAdmin;

class DataRecords extends ModelAdmin
{
	private static $menu_title = 'Data Records';

	private static $url_segment = 'app-data-records';

	private static $menu_icon = '';

	private static $managed_models = [];

	private static $menu_priority = 7;
}