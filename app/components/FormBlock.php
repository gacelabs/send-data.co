<?php

namespace Component;

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

use Component\Block;
use Component\Models\SelectFormField;
use Component\Models\SelectRecipient;
use Submission\Subscriptions;

class FormBlock extends DataObject {

	private static $table_name = 'FormBlock';
	private static $description = '';
	private static $singular_name = 'Form';
	private static $plural_name = 'Forms';

	private static $db = [
		'Name' => 'Varchar(100)',
		'ActionName' => 'Varchar(100)',
		'SortOrder' => 'Int'
	];
	private static $default_sort = 'SortOrder';

	private static $has_one = [];
	private static $has_many = [
		'Recipients' => SelectRecipient::class,
		'FormBlockFields' => SelectFormField::class
	];
	private static $many_many = [];
	private static $belongs_many_many = [];
	private static $defaults = [];
	private static $field_labels = [];
	private static $summary_fields = [
		'Name' => 'Name',
		'ActionName' => 'Action'
	];

	public $FormTemplate = 'Forms\\DataForm';
	public $Submissions = Subscriptions::class;

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields->removeByName(['SortOrder', 'FormBlockFields']);

		$fields->addFieldToTab('Root.Main', FieldHelper::HeaderField('Data Form')->setHeadingLevel(1), 'Name');

		$fields->addFieldsToTab('Root.Main', [
			GridHelper::sortable('FormBlockFields', 'Form Fields', $this->FormBlockFields())
		]);

		$fields->addFieldsToTab('Root.Recipients', [
			GridHelper::relational('Recipients', 'Recipients', $this->Recipients())
		]);
		/*$fields->addFieldsToTab('Root.Subscriptions', [
			GridHelper::relational('Subscriptions', 'Recipients', $this->Subscriptions())
		]);*/

		return $fields;
	}

	public function setDataFormTemplate($template='Forms\\DataForm')
	{
		$this->FormTemplate = $template;
		return $this->FormTemplate;
	}

	public function setSubmission($submission=Subscriptions::class)
	{
		$this->Submissions = $submission;
		return $this->Submissions;
	}

	public function getRecipients()
	{
		return $this->Recipients();
	}

	public function getSubmissions()
	{
		return $this->Submissions;
	}
}
