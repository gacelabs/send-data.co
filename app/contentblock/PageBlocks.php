<?php

use SilverStripe\ORM\DataExtension;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClassHandler;

use SilverStripe\Control\Director;
use SilverStripe\View\SSViewer;

use SilverStripe\Forms\FieldList;

use SilverStripe\Control\Controller;

use ContentBlocks\ContentBlock;

class PageBlocks extends DataExtension
{

    public $cache;

    private static $db = [
        'EnableContentBlock' => 'Boolean',
    ];

    private static $has_many = array(
        'ContentBlocks' => ContentBlock::class
    );

    private static $casting = array(
        'GetContentBlocks' => 'HTMLText' 
    );

    public $ExtractedBlocks = [];

    public function updateCMSFields(FieldList $fields)
    {
        
        $gridConfig = GridFieldConfig_RelationEditor::create(50)
                        ->removeComponentsByType(GridFieldAddNewButton::class)
                        ->addComponent(new GridFieldSortableRows('SortOrder'))
                        ->addComponent(new GridFieldAddNewMultiClass(), 'GridFieldToolbarHeader');

        $gridField = GridField::create('ContentBlocks','Content Blocks',
            $this->owner->ContentBlocks(), 
            $gridConfig
        );
        
        
        $fields->addFieldToTab('Root.ContentBlocks',
            $gridField
        );
        
    }

    public function GetContentBlocks(){

        $html = $this->CreateBlocksCache();

        return $html;

    }

    public function ExtractBlock($BlockName = false){
        $block = $this->owner->ContentBlocks()->find('Name', $BlockName);

        if($block){
            //$blocks = $block;
            $this->ExtractedBlocks[] = $block->ID;
            $block_template = @$block->html_cache[$block->Template ?: 'Default'] ?: $block->ClassName;
            return $block->renderWith($block_template);
        }
        
    }

    public function isBlockClassExists($BlockClassName = false){
        $block = $this->owner->ContentBlocks()->find('ClassName', $BlockClassName);

        if($block){
            return true;
        }

        return false;

    }

    public function CreateBlocksCache(){

        $blocks = $this->owner->ContentBlocks()->filter(['Published'=>1]);

        SSViewer::add_themes(array(SITE_DEFAULT_THEME)); //add in _config.php  define('SITE_DEFAULT_THEME', 'theme_name');

        $html = '';
        if($blocks){
            foreach($blocks as $block){
                //Check if block is already extracted so it wont us it again
                if(!in_array($block->ID, $this->ExtractedBlocks)){
                    $block_template = @$block->block_templates[$block->Template ?: 'Default'] ?: $block->ClassName;
                    $html .= $block->renderWith($block_template);
                }
            }
        }

        return $html;
    }


    public function ActiveController(){
        return Controller::curr();
    }

    public function GetChilds(){
        return Page::get()->filter('ParentID', $this->owner->ID);
    }

    public function CacheKey(){
        return 'PageBlock.' . md5($this->owner->ID) . '.key';
    }

}
