<?php
namespace App\Extensions;

use SilverStripe\Dev\Debug;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\GridField\GridFieldPaginator;

use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

use App\Helpers\GridHelper;

class LeftAndMainExtension extends DataExtension {

	/*public function accessedCMS()
	{
	}*/

	public function updateEditForm(&$form)
	{
		// debug::endshow($form);
		if ($this->owner->hasMethod('getModelClass')) {
			// debug::endshow($this->owner->getModelClass());
			if ($this->owner->getModelClass() == 'Component\\Models\\FormBlockField') {
				foreach ($form->Fields() as $key => $Field) {
					if ($Field->getName() == 'Component-Models-FormBlockField') {
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