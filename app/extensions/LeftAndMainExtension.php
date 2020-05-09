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
			if (in_array($this->owner->getModelClass(), ['Component\\Models\\FormBlockField', 'Component\\FormSubmissionBlock'])) {
				foreach ($form->Fields() as $key => $Field) {
					if (in_array($Field->getName(), ['Component-Models-FormBlockField','Component-FormSubmissionBlock'])) {
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