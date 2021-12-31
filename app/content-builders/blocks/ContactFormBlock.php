<?php

namespace ContentBuilder\Blocks;

use ContentBuilder\GeneralBlock;

use SilverStripe\Dev\Debug;
use SilverStripe\Control\Controller;

use App\Helpers\FieldHelper;
use App\Helpers\GridHelper;

use App\Forms\ContactForm;

class ContactFormBlock extends GeneralBlock {

	private static $table_name    = 'ContactFormBlock';
	private static $singular_name = 'Contact Form Block';
	private static $plural_name   = 'Contact Form Blocks';

	private static $db = [];

	public $block_css = [];

	public $block_js = [
		'required/js/jquery.validate.min.js',
		'required/js/validate-forms.js',
	];

	public $block_templates = [];
	private static $has_many = [];

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		parent::resetFields($fields);
		// debug::endshow($this->Template);
		return $fields;
	}

	public function ContactForm()
	{
		// debug::endshow();
		$ContactForm = new ContactForm(Controller::curr(), __FUNCTION__);
		$ContactForm->setFormAction(Controller::curr()->Link() . 'ContactForm/?blockid='.$this->owner->ID)
					/*->enableSpamProtection()*/;
		return $ContactForm;
	}

}
