<?php

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Control\Director;
use SilverStripe\View\SSViewer;
use SilverStripe\Forms\FieldList;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\GroupedList;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Dev\Debug;
use SilverStripe\Core\ClassInfo;
use SilverStripe\ORM\DataObject;
use SilverStripe\Core\Config\Config;
use SilverStripe\View\ArrayData;

use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClassHandler;

use ContentBuilder\GeneralBlock;
use ContentBuilder\Blocks\ColumnedContent;

use App\Helpers\GeneralHelper;
use App\Helpers\CacheHelper;

class PageBlocks extends DataExtension
{
	public $cache;

	private static $db = [];

	private static $has_many = [
		'Blocks' => GeneralBlock::class
	];

	private static $casting = [
		'HTMLBlocks' => 'HTMLText' 
	];

	public $ExtractedBlocks = [];

	public function updateCMSFields(FieldList $fields)
	{
		$GridFieldAddNewMultiClass = new GridFieldAddNewMultiClass();
		$Blocks = ClassInfo::subclassesFor(GeneralBlock::class);
		$Blocks = [];
		foreach ($Blocks as $ClassName) {
			$SingularName = Config::inst()->get(DataObject::get_one($ClassName), 'singular_name');
			if (!$SingularName) {
				$SingularName = GeneralHelper::CamelName(ClassInfo::shortName($ClassName));
			}
			$Blocks[$ClassName] = $SingularName;
		}
		// debug::endshow($Blocks);
		if (count($Blocks)) {
			asort($Blocks);
			$GridFieldAddNewMultiClass->setClasses($Blocks);
		}

		$gridConfig = GridFieldConfig_RelationEditor::create(15)
			->removeComponentsByType(GridFieldAddNewButton::class)
			->removeComponentsByType(GridFieldAddExistingAutocompleter::class)
			->addComponent(new GridFieldSortableRows('SortOrder'))
			->addComponent($GridFieldAddNewMultiClass, 'GridFieldToolbarHeader');

		$gridField = GridField::create('Blocks', 'Content Blocks',
			$this->owner->Blocks(), 
			$gridConfig
		);
		// debug::endshow($gridField->getList());
		
		$fields->addFieldToTab('Root.Blocks', $gridField);
	}

	public function HTMLBlocks()
	{
		// CacheHelper::clear();
		$html = $this->CreateBlocksCache();
		return $html;
	}

	public function ExtractBlock($block) {
		// debug::show($block->ClassName);
		$html = '';
		if($block){
            $this->ExtractedBlocks[] = $block->ID;
            $block_template = $block->ClassName;
            if ((isset($block->block_templates) AND isset($block->block_templates[$block->Template]))) {
            	$block_template = 'ContentBuilder\\Templates\\'.$block->Template;
            }
            $html = $block->renderWith($block_template);
        }
	
		return $html;
	}

	public function isBlockClassExists($BlockClassName = false) {
		$block = $this->owner->Blocks()->find('ClassName', $BlockClassName);

		if ($block) {
			return true;
		}
		return false;
	}

	public function CreateBlocksCache() {
		$blocks = $this->owner->Blocks()->filter(['Published'=>1]);
		// $blocks = GroupedList::create($blocks)->GroupedBy('ClassName');
		SSViewer::add_themes([SITE_DEFAULT_THEME]);

		$html = '';
		if ($blocks) {
			foreach($blocks as $key => $block) {
				if ($blocks->Count() >= 9) { /*Cache if more than 9 blocks*/
					$html .= $this->LoadCachedUI($block);
				} else {
					$html .= $this->ExtractBlock($block);
				}
			}
		}
		// debug::endshow($html);
		/*enclosed all blocks in a div element*/
		return $html;
	}

	public function ActiveController() {
		return Controller::curr();
	}

	public function GetChilds() {
		return Page::get()->filter('ParentID', $this->owner->ID);
	}

	public function CacheKey($ID=0) {
		return 'PageBlock.' . md5(($ID ?: $this->owner->ID)) . '.key';
	}

	public function LoadCachedUI($block) {
		if (CacheHelper::checkExist($this->CacheKey($block->ID))) {
			$html = CacheHelper::load_data($this->CacheKey($block->ID));
		} else {
			$html = $this->ExtractBlock($block->ID);
			CacheHelper::write_data($this->CacheKey($block->ID), $html);
		}
		return $html;
	}

}
