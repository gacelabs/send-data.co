<?php
namespace App\Extensions;

use SilverStripe\Dev\Debug;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\ClassInfo;

use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

use App\Helpers\GridHelper;

class LeftAndMainExtension extends DataExtension {

	protected static $sortable_classes = [];

	public function updateEditForm(&$form)
	{
		if ($this->owner->hasMethod('getModelClass')) {
			if (in_array($this->owner->getModelClass(), self::$sortable_classes)) {
				$class = $this->owner->getModelClass();
				if (ClassInfo::exists($class)) {

					$field_name = str_replace('\\', '-', $class);

					if (in_array($field_name, $form->Fields()->Column('Name'))) {
						$Field = $form->Fields()->dataFieldByName($field_name);
						$Field->getConfig()->addComponent(new GridFieldSortableRows('SortOrder'))
							->removeComponentsByType(GridFieldPaginator::class)
							->addComponent($pagination = new GridFieldPaginator(50));
						$pagination->setThrowExceptionOnBadDataType(false);
					}
				}
			}
		}
	}
}