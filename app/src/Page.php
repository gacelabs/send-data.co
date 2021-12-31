<?php

namespace {

	use SilverStripe\CMS\Model\SiteTree;
	use SilverStripe\Dev\Debug;
	use SilverStripe\ORM\ArrayList;
	use SilverStripe\Core\Convert;
	use SilverStripe\ErrorPage\ErrorPage;

	use App\Models\PackageType;
	use App\Models\PayloadLicense;

	use App\Helpers\FieldHelper;
	use App\Helpers\GridHelper;

	class Page extends SiteTree
	{
		private static $db = [
			'MetaTitle' => 'Text'
		];

		private static $has_one = [];

		public function getCMSFields() {
			$fields = parent::getCMSFields();
			$fields->removeByName(['Dependent', 'ExtraMeta']);

			if ($this->owner->ClassName != ErrorPage::class) {
				$fields->removeByName(['Content']);
			}

			$fields->addFieldsToTab('Root.Main', [
				FieldHelper::Textarea('MetaTitle')
					->setRightTitle('Shown at the top of the browser window and used as the "linked text" by search engines.')
					->addExtraClass('help')
			], 'MetaDescription');

			return $fields;
		}

		public function IsNotLocal() {
			return (bool)strstr($_SERVER['HTTP_HOST'], 'local.') == false;
		}

		public function PackageTypes()
		{
			return PackageType::get();
		}

		public function AppSiteUrl($Uri='')
		{
			return APP_SITE.(rtrim($Uri, '/')).'/';
		}

		public function PayloadLicenses()
		{
			$PayloadLicenses = PayloadLicense::get();
			$Licenses = [];
			if ($PayloadLicenses->Count()) {
				foreach ($PayloadLicenses as $key => $Payload) {
					$Licenses[$Payload->Name] = [
						'active' => $Payload->IsActive,
						'price' => (float)$Payload->Price,
						'percentage' => (float)$Payload->Percentage,
					];
				}
			}
			// debug::endshow($Licenses);
			return Convert::array2json($Licenses);
		}

		public function LoginPage() {
			$LoginPage = LoginPage::get();
			// debug::endshow($LoginPage);
			return $LoginPage->Count() ? $LoginPage->First() : ArrayList::create(['Link' => '/']);
		}
	}
}
