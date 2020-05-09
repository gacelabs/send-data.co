<?php

namespace {

	use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
	use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
	use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClassHandler;

	use SilverStripe\CMS\Model\SiteTree;
	use SilverStripe\Forms\GridField\GridField;
	use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
	use SilverStripe\Forms\GridField\GridFieldAddNewButton;
	use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
	use SilverStripe\Dev\Debug;
	use SilverStripe\Control\Director;
	use SilverStripe\View\SSViewer;
	use SilverStripe\Forms\FieldList;
	use SilverStripe\Control\Controller;
	use SilverStripe\Core\Injector\Injector;

	use App\Helpers\FieldHelper;
	use App\Helpers\GridHelper;
	use App\Helpers\GeneralHelper;
	
	use Component\Block;
	use Component\FormBlock;
	use Component\FormHandler;

	class Page extends SiteTree
	{
		private static $db = [];

		private static $has_one = [
			'TyPage' => SiteTree::class
		];

		private static $has_many = [
			'Blocks' => Block::class
		];

		private static $casting = array(
			'GetComponentBlocks' => 'HTMLText' 
		);

		public $main_css = [];
		public $main_js = [];
		public $page_css = [];
		public $page_js = [];
		public $FormBlockID = 0;

		public function getCMSFields() {
			$fields = parent::getCMSFields();
			// debug::endshow($this->ClassName);
			if ($this->ClassName != 'SilverStripe\Blog\Model\BlogPost') {
				$fields->removeByName(['Content']);
				$fields->addFieldToTab('Root.Main', FieldHelper::TreeDropdown('TyPageID', 'Thank you page', SiteTree::class), 'Metadata');
			}

			$gridConfig = GridFieldConfig_RelationEditor::create(50)
				->removeComponentsByType(GridFieldAddNewButton::class)
				->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
				->addComponent(new GridFieldSortableRows('SortOrder'))
				->addComponent(new GridFieldAddNewMultiClass(), 'GridFieldToolbarHeader');

			$gridField = GridField::create('Block', 'Component Blocks',
				$this->Blocks(), 
				$gridConfig
			);
			
			$fields->addFieldToTab('Root.ComponentBlocks',
				$gridField
			);

			foreach ($this->Blocks() as $key => $Block) {
				if (isset($Block->page_js) AND count($Block->page_js)) {
					foreach ($Block->page_js as $js) {
						$this->page_js[md5($js)] = $js;
					}
				}
			}
			// debug::endshow($this->page_js);
			foreach ($this->Blocks() as $key => $Block) {
				if (isset($Block->page_css) AND count($Block->page_css)) {
					foreach ($Block->page_css as $css) {
						$this->page_css[md5($css)] = $css;
					}
				}
			}

			return $fields;
		}

		public function GetHomeComponentBlock($ClassName) {
			$Blocks = $this->owner->Blocks()->Filter(['Published'=>1, 'ClassName' => $ClassName]);
			$HTML = '';
			if ($Blocks) {
				foreach ($Blocks as $Block) {
					// debug::endshow($Block);
					$Template = $Block->ClassName ?: 'Component\\Default';
					$HTML .= $Block->renderWith($Template);
				}
			}
			return FieldHelper::HTMLText($HTML);
		}

		public function GetComponentBlocks() {
			$Blocks = $this->owner->Blocks()->Filter(['Published'=>1]);
			SSViewer::add_themes([SITE_DEFAULT_THEME]);

			$HTML = '';
			if ($Blocks) {
				foreach ($Blocks as $Block) {
					// debug::endshow($Block);
					$Template = $Block->ClassName ?: 'Component\\Default';
					$HTML .= $Block->renderWith($Template);
				}
			}

			return $HTML;
		}

		public function DataForm($vars=false, $Controller=false)
		{
			if ($vars) {
				$ID = $vars['id']; $Template = isset($vars['template']) ? $vars['template'] : 'Forms\\DataForm';
				$FormBlock = FormBlock::get()->byID($ID);
				if ($FormBlock) {
					$FormBlock->setDataFormTemplate($Template);
					// debug::endshow($FormBlock->FormTemplate);
					$Controller = $Controller ?: Controller::curr();
					$Form = Injector::inst()->createWithArgs(FormHandler::class, [$Controller, $FormBlock]);
					return $Form;
				}
			}
			return false;
		}
	}
}
