<?php

namespace ContentBlocks;

use SilverStripe\ORM\DataObject;

use Page;

use App\Helpers\FieldHelper;

class ContentBlock extends DataObject{

	private static $table_name = 'ContentBlock';

	private static $description = 'Flexible Content Block';
    private static $singular_name = 'Content Block';
    private static $plural_name = 'Content Blocks';

	private static $db = array(
		'Name' => 'Varchar(255)',
		'Heading' => ' Varchar(255)',
		'SubHeading' => 'Varchar(255)',
		'HTMLClass' => 'Varchar(255)',
		'Template' => 'Varchar(255)',
		'Anchor' => 'Varchar(100)',
		'Content' => 'HTMLText',
		'SortOrder' => 'Int',
		'ExtraClass' => 'Varchar(255)',
		'BackgroundColour' => 'Varchar(255)',
        'Published' => 'Boolean',
	);

	private static $has_one = array(
		'Parent' => Page::class
	);

	private static $default_sort = 'SortOrder';

	//template_key => Template
	public $block_templates = array(
		//'Default' => 'ContentBlocks/ContentBlock'
	);

    private static $defaults = [
        'Published' => 1,
    ];

	private static $summary_fields = array(
	    'SingularName' => 'Class Name',
		'Name' => 'Name',
		'Heading' => 'Heading',
	);

	public function SingularName(){
		return self::$singular_name;
	}

	public function arrayTemplates(){
		if(!empty($this->block_templates)){
			$list = array();
			foreach($this->block_templates as $index => $template){
				$list[$index] = $index;
			}
			return $list;
		}
		else{
			return false;
		}
	}

	public function getCMSFields(){
        $fields = parent::getCMSFields();

        $fields->removeByName('ParentID');
        $fields->removeByName('SortOrder');
    	$fields->removeByName('Template');

    	$fields->addFieldsToTab('Root.Main', array(
            FieldHelper::Text('Name', 'Name'),
            FieldHelper::Text('Heading', 'Heading'),
            FieldHelper::Text('HTMLClass', 'HTMLClass')
    	));

    	if($this->arrayTemplates()){
    		$fields->addFieldToTab('Root.Main', FieldHelper::Dropdown('Template', null, $this->arrayTemplates(), 'Content'));
    	}

       	return $fields;
    }

   	public function onAfterWrite(){
    	parent::onAfterWrite();
    	$this->owner->Parent()->write();
    }

}