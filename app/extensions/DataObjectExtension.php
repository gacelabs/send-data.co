<?php
/**
 * Created by PhpStorm.
 * User: gczasuncion
 * Date: 10/11/2018
 * Time: 9:31 AM
 */

namespace App\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;

class DataObjectExtension extends DataExtension{

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('LinkTracking');
        $fields->removeByName('FileTracking');
    }

}