<?php
namespace App\Extensions;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Security\Member;
use SilverStripe\ORM\DataObject;
use SilverStripe\Core\Config\Config;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

class SiteConfigExtension extends DataExtension
{
	private static $db = [
		'FacebookLink'  => 'Varchar(255)',
		'TwittertLink'  => 'Varchar(255)',
		'InstagramLink' => 'Varchar(255)',
		'LinkedInLink'  => 'Varchar(255)',
		'YoutubeLink' => 'Varchar(255)',
		'PinterestLink' => 'Varchar(255)',
		'FooterContactDetails' => 'HTMLText',
		'MainJsScripts' => 'Text',
		'reCaptchaAPiKey' => 'Varchar(255)',
		'reCaptchaAPiSecret' => 'Varchar(255)',
	];

	private static $has_one = [
		'SiteFavIcon' => Image::class
	];

	private static $many_many = [];

	public function updateCMSFields(FieldList $fields)
	{
		// $fields->removeByName(['SiteFavIcon']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Upload("SiteFavIcon", "Site Fav Icon"),
			FieldHelper::Accordion($fields, 'SiteSocialMediaLinks', 'Social Media Links', [
				FieldHelper::Text("FacebookLink", "Facebook Link"),
				FieldHelper::Text("TwitterLink", "Twitter Link"),
				FieldHelper::Text("InstagramLink", "Instagram Link"),
				FieldHelper::Text("LinkedInLink", "LinkedIn Link"),
				FieldHelper::Text("YoutubeLink", "Youtube Link"),
				FieldHelper::Text("PinterestLink", "Pinterest Link"),
			])
		]);

		$fields->addFieldsToTab('Root.Footer',[
			FieldHelper::HTMLEditor('FooterContactDetails')
		]);

		$fields->addFieldsToTab('Root.Scripts',[
			FieldHelper::Textarea('MainJsScripts')
		]);

		$fields->addFieldsToTab('Root.Keys',[
			FieldHelper::Text('reCaptchaAPiKey', 'reCAPTCHA API Key'),
			FieldHelper::Text('reCaptchaAPiSecret', 'reCAPTCHA API Secret')
		]);
	}
}
