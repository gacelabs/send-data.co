<?php

use HomeBuilders\Model\HotSpotGalleryImages;
use HomeBuilders\Model\HotSpotGalleryLooks;
use App\Helpers\GridHelper as GridHelper;
use App\Helpers\FieldHelper;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
//use HomeBuilders\Model\DisplayHome;
//use HomeBuilders\Model\FloorPlan;

class HotSpotGalleryPage extends Page{

    private static $table_name    = 'HotSpotGalleryPage';
    private static $description   = 'HotSpot Gallery Page';
    private static $singular_name = 'HotSpot Gallery Page';
    private static $plural_name   = 'HotSpot Gallery Pages';
    private static $can_be_root   =  true;

    private static $db = [
        'ImageSelection'      => 'Varchar(100)',
        'PageLinkLabel'      => 'Varchar(100)',
        'SortOrder'           => 'Int',
        'IntroText'           => 'HTMLText',
    ];

    private static $default_sort = 'SortOrder';

    private static $has_one = [
        'SmallImage' => Image::class,
        'LargeImage' => Image::class,
        'PageLink'   => SiteTree::class,
    ];

    private static $has_many = [
        'HotSpotGalleryImages' => HotSpotGalleryImages::class,
        'HotSpotGalleryLooks' => HotSpotGalleryLooks::class,
    ];

    private static $many_many = [
        //'DisplayHomes' => DisplayHome::class
    ];

    private static $belongs_many_many = [
    ];

    private static $defaults = [
    ];

    private static $field_labels = [
    ];

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->removeByName('ContentBlocks');
        $fields->removeByName('Content');
        $fields->removeByName('SubHeading');
        $fields->removeByName('SortOrder');

//        $displays = DisplayHome::get();
//        $displays_map = array();
//        foreach($displays as $display) {
//            $display_title = '';
//
//            if ($display->DisplayCentreID && $center_title = $display->DisplayCentre()->TitleWithType()) {
//                $display_title .= $center_title . ' -';
//            } else {
//                continue;
//            }
//            if ($display->HomeModelID && $home_title = $display->HomeModel()->Title) {
//                $display_title .= ' ' . $home_title;
//            } else {
//                continue;
//            }
//
//            if ($display->FloorPlan()->Size) {
//                $display_title .= ' ' . $display->FloorPlan()->Size;
//            } else {
//                $display_title .= ' (no size)';
//            }
//
//            if ($display->Facade() && $facade_name =  ($display->Facade()->FacadeDisplayName) ? $display->Facade()->FacadeDisplayName : $display->Facade()->Name) {
//                $display_title .= ' (' . $facade_name . ')';
//            } else {
//                $display_title .= ' (no facade)';
//            }
//
//            $displays_map[$display->ID] = $display_title;
//        };
//
//        asort($displays_map);
//
//        $fields->addFieldToTab('Root.Main',
//            FieldHelper::ListBox('DisplayHomes', 'Display Homes', $displays_map),'Metadata');

        $fields->addFieldsToTab('Root.Main', [
            FieldHelper::Dropdown('ImageSelection','Image to display on index page',['small'=>'Small','large'=>'Large']),
            FieldHelper::Upload('SmallImage', 'Small Image','Image Size 570px * 303px')
                ->setFolderName('HotSpotGalleryPage/Images'),
            FieldHelper::Upload('LargeImage', 'Large Image','Image Size 570px * 530px')
                ->setFolderName('HotSpotGalleryPage/Images'),
            FieldHelper::Text('PageLinkLabel','Page Link Label'),
            FieldHelper::TreeDropdown('PageLinkID','Page Link',SiteTree::class),
            FieldHelper::HTMLEditor('IntroText','IntroText'),
        ],'MenuTitle');

        $fields->addFieldsToTab('Root.Images',[GridHelper::sortable('HotSpotGalleryImages', 'Hot Spot Gallery Images', $this->HotSpotGalleryImages())]);
        $fields->addFieldsToTab('Root.TheLooks',[GridHelper::sortable('HotSpotGalleryLooks', 'The Looks', $this->HotSpotGalleryLooks())]);

        return $fields;
    }

    public function previousPage()
    {
        return SiteTree::get()->filter(['ClassName'=>'InteriorThemePage','Sort:LessThan'=>$this->Sort])->sort('Sort','Desc')->first();
    }

    public function nextPage()
    {
        return SiteTree::get()->filter(['ClassName'=>'InteriorThemePage','Sort:GreaterThan'=>$this->Sort])->sort('Sort','Asc')->first();
    }


}

class HotSpotGalleryPageController extends PageController{

    public function onBeforeInit(){

        $this->js_files_end = [
            //'/static/js/isotope.pkgd.min.js',
            //'/static/js/masonry.pkgd.min.js',
        ];

    }
}