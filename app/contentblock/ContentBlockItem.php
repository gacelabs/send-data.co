<?php

namespace App\Model;
use SilverStripe\ORM\DataObject;

class ContentBlockItem extends DataObject{
    
    private static $table_name = 'ContentBlockItem';

    private static $db = array(
        'Name' => ' Varchar(255)',
        'SortOrder' => 'Int',
        'Published' => 'Boolean'
    );

    private static $default_sort = 'SortOrder';

    private static $defaults = [
        'Published' => 1
    ];

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->removeByName('SortOrder');

        return $fields;
    }

    public function onAfterWrite(){
        parent::onAfterWrite();

        if(isset($this->ContentBlockID) && $this->ContentBlockID > 0){
            $this->ContentBlock()->HTMLCachedTime = time();
            $this->ContentBlock()->write();
        }
    }

}