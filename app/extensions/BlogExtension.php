<?php

namespace App\Extensions;

use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\ORM\DataExtension;

use SilverStripe\Forms\FieldList;
use SilverStripe\Blog\Model\BlogCategory;
use SilverStripe\Blog\Model\BlogPost;

use SilverStripe\Blog\Model\Blog;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CompositeField;
use App\Helpers\FieldHelper;

class BlogExtension extends DataExtension {

	private static $db = [];

	private static $has_one = [];

	public function updateCMSFields(FieldList $fields){
		$fields->removeByName(['Content', 'Heading', 'Categorisation']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::HTMLEditor('Content', 'Introduction'),
		], 'Metadata');
	}
}

class BlogControllerExtenstion extends DataExtension {
}
