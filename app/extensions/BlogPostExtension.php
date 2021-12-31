<?php

namespace App\Extensions;

use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\View\ArrayData;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Blog\Model\BlogCategory;
use SilverStripe\Blog\Model\BlogPost;
use SilverStripe\Blog\Model\Blog;
use SilverStripe\Control\Director;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;

use App\Helpers\FieldHelper;

class BlogPostExtension extends DataExtension {

	private static $db = [];

	private static $has_one = [
		'Hero' => Image::class,
		'Thumbnail' => Image::class
	];

	public function updateCMSFields(FieldList $fields){
		$fields->removeByName(['Categories', 'Tags', 'AuthorNames', 'FeaturedImage']);

		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::InlineFields('Images', [
				FieldHelper::Upload('Hero'),
				FieldHelper::Upload('Thumbnail')
			])->setDescription('<em>(Hero Dimensions: 1920x1080 | Thumbnail Dimensions: 438x338)</em>'),
		], 'Content');

	}

	public function MoreArticles($limit=2) {
		$BlogPost = BlogPost::get()->Filter(array('ID:not' => $this->owner->ID))->sort('PublishDate')->limit($limit);
		return $BlogPost;
	}

	public function ParseBlogActionURL($Value='', $Action='') {
		$trailing_slash = '/';
		if ($Value == '' AND $Action == '') {
			$trailing_slash = '';
		}
		$Blog = Blog::get();
		$ParentURL = '';
		if ($Blog->Count()) {
			$ParentURL = $Blog->First()->Parent()->URLSegment.'/';
		}
		$BlogURL = $ParentURL.$Blog->First()->URLSegment.'/';
		$URLSegment = strtolower(str_replace(' ', '-', $Value));
		return $BlogURL.$Action.$URLSegment.$trailing_slash;
	}

	public function previousPage()
	{
		return BlogPost::get()->Filter(['ID:not' => $this->owner->ID,'ID:LessThan'=>$this->owner->ID])->sort('ID','Desc')->first();
	}

	public function nextPage()
	{
		return BlogPost::get()->Filter(['ID:not' => $this->owner->ID,'ID:GreaterThan'=>$this->owner->ID])->sort('ID','Asc')->first();
	}

	public function PublishDateFormat() {
		return date('dS F Y', strtotime($this->owner->PublishDate));
	}

	public function GetShareLink($SocialMedia='') {
		switch (strtolower($SocialMedia)) {
			case 'twitter':
				return 'http://twitter.com/share?text='.$this->owner->Title.'&url='.Director::absoluteURL($this->owner->Link());
				break;

			case 'facebook':
				return 'https://www.facebook.com/sharer.php?u='.Director::absoluteURL($this->owner->Link());
				break;

			case 'email':
				$SiteConfig = DataObject::get_one(SiteConfig::class);
				return 'mailto:'.$SiteConfig->SiteEmail.'?subject=Check this out!&body='.Director::absoluteURL($this->owner->Link());
				break;
		}
	}

	public function BlogPageLink()
	{
		$Blog = Blog::get();
		// debug::endshow($Blog->First()->Link());
		return $Blog->Count() ? $Blog->First()->Link() : false;
	}
}

class BlogPostControllerExtenstion extends DataExtension {
}
