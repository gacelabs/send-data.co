<?php

namespace Component\Blocks;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use SilverStripe\Forms\Form;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\ArrayList;

use Component\Block;
use Component\FormBlock;
use Component\FormHandler;
use Component\Models\MembershipItem;
use Component\Blocks\MembershipBlock;

use Submission\Registration;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

class MemberRegistrationBlock extends Block {

	private static $table_name = 'MemberRegistrationBlock';

	private static $description = 'Add membership registration block';
	private static $singular_name = 'Membership registration block';
	private static $plural_name = 'Membership registration blocks';

	private static $db = [
		'FooterContent' => 'HTMLText'
	];

	private static $has_one = [
		'MembershipItem' => MembershipItem::class,
		'FormBlock' => FormBlock::class
	];

	private static $has_many = [];
	private static $many_many = [

	];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];
	private static $summary_fields = [];

	public $page_js = [
		'properties/js/calc.js'
	];

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields = $this->owner->resetFields($fields);
		// debug::endshow(MembershipItem::get());
		// debug::endshow($Memberships);
		$fields->addFieldsToTab('Root.Main', [
			FieldHelper::Dropdown('MembershipItemID', 'Select membership', $this->Memberships()),
			FieldHelper::Dropdown('FormBlockID', 'Select a form', FormBlock::get()),
			FieldHelper::HTMLEditor('FooterContent')
		]);

		return $fields;
	}

	public function GetForm()
	{
		// debug::endshow($this->Page());
		$this->FormBlock()->setDataFormTemplate('Forms\\RegisterForm');
		$this->FormBlock()->setSubmission(Registration::class);
		// debug::endshow($this->FormBlock()->Submissions);
		$Form = new FormHandler($this->getController(), $this->FormBlock());
		/*$Form->getRequestHandler()->config()->update('url_handlers', [
			'$ID' => 'httpSubmission',
		]);*/
		$Form->setFormAction(Controller::curr()->Link() . 'DataForm/?id=' . $this->FormBlock()->ID . '&submissions=' . Registration::class . '&template=Forms\\RegisterForm');
		return $Form;
	}

	public function Memberships()
	{
		$MembershipBlocks = MembershipBlock::get();
		$Memberships = ArrayList::create();
		if ($MembershipBlocks->Count()) {
			foreach ($MembershipBlocks as $key => $Block) {
				if ($Block->MembershipItems()->Count()) {
					foreach ($Block->MembershipItems() as $index => $Member) {
						$Memberships->push($Member);
					}
				}
			}
		}
		// debug::endshow($Memberships);
		return $Memberships;
	}

	public function getController()
	{
		return Controller::curr();
	}
}