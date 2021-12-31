<?php

namespace App\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Dev\Debug;
use SilverStripe\CMS\Model\SiteTree;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;
use App\Contacts\Recipient;
use App\Subscriptions\Submission;

class SiteConfigExtension extends DataExtension
{
	private static $db = [
		'PhoneNumber' => 'HTMLText',
		'Email' => 'Varchar',
		'EmailList' => 'HTMLText',
		'Address' => 'Text',
		'Facebook' => 'Varchar',
		'Instagram' => 'Varchar',
		'Pinterest' => 'Varchar',
		'Youtube' => 'Varchar',
	];

	private static $has_one = [
		'TyPage' => SiteTree::class,
		'Privacy' => SiteTree::class,
		'Terms' => SiteTree::class,
	];

	private static $many_many = [
		'Recipients' => Recipient::class,
		'Enquiries' => Submission::class,
	];

	public function updateCMSFields(FieldList $fields)
	{
		$fields->removeByName(['Title']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Text('Title', 'Site Title'),
			FieldHelper::HTMLEditor('PhoneNumber', 'Phone number'),
			FieldHelper::Text('Email', 'Email'),
			FieldHelper::Textarea('Address')->setRows(3),
			FieldHelper::Accordion($fields, 'SocialMediaLinks', 'Social Media Links', [
				FieldHelper::Text('Facebook'),
				FieldHelper::Text('Instagram'),
				FieldHelper::Text('Pinterest'),
				FieldHelper::Text('Youtube'),
			])->setStartClosed(false),
		]);

		$fields->addFieldsToTab('Root.Contacts.Recipients', [
			FieldHelper::TreeDropdown('TyPageID', 'Thank you page', SiteTree::class),
			GridHelper::relational('Recipients', 'Recipients', $this->owner->Recipients())
		]);
		$fields->addFieldsToTab('Root.Contacts.Enquiries', [
			GridHelper::relational('Enquiries', 'Enquiries', $this->owner->Enquiries(), true)
		]);
		
		$fields->addFieldsToTab('Root.LegalMatters', [
			FieldHelper::TreeDropdown('PrivacyID', 'Privacy page', SiteTree::class),
			FieldHelper::TreeDropdown('TermsID', 'Terms page', SiteTree::class),
		]);
	}

	public function FunctionName()
	{
		debug::endshow($this->owner->FooterLinks());
	}
}
