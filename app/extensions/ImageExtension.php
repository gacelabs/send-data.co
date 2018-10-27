<?php
namespace App\Extensions;

use SilverStripe\ORM\DataExtension;


class ImageExtension extends DataExtension{

    public function onBeforeWrite(){
        parent::onBeforeWrite();
    }

    public function onAfterWrite(){
        parent::onAfterWrite();

        $this->owner->doPublish();
    }

    public function CachedKey(){
    	return md5($this->owner->Created);
    }


}