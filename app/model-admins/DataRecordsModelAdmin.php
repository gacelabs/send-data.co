<?php

namespace App\ModelAdmins;

use SilverStripe\Admin\ModelAdmin;

use App\Models\PackageType;
use App\Models\BillingPeriod;
use App\Models\PayloadLicense;

class DataRecordsModelAdmin extends ModelAdmin
{
	private static $menu_title = 'Data Records';

	private static $url_segment = 'data-records';

	private static $menu_icon_class = 'font-icon-database';

	private static $menu_priority = 4;

	private static $managed_models = [
		PackageType::class => ['title' => 'Package Types'],
		BillingPeriod::class => ['title' => 'Billing Periods'],
		PayloadLicense::class => ['title' => 'Payload Licenses'],
	];
}