<?php

namespace {

	use SilverStripe\CMS\Controllers\ContentController;
	use SilverStripe\Control\Director;
	use SilverStripe\View\SSViewer;
	use SilverStripe\View\Requirements;
	use SilverStripe\Dev\Debug;

	use App\Forms\ContactForm;

	class PageController extends ContentController
	{
		private static $allowed_actions = [
			'ContactForm'
		];

		public $main_css = [
			'assets/css/bootstrap.min.css',
			'assets/css/bootstrap-slider.css',
			'assets/css/font-awesome.min.css',
			'assets/css/default.css',
			'assets/css/style.css',
		];

		public $main_js = [
			'assets/js/jquery.min.js',
			'assets/js/bootstrap.min.js',
			'assets/js/bootstrap-slider.js',
			'assets/js/highlight.pack.js',
			'assets/js/main.js',
			'assets/js/calc.js',
		];

		protected function init()
		{
			parent::init();
				
			$requiredJS  = [];
			$requiredCSS = [];
			// debug::endshow($this->ClassName);
			// add main js
			if (!empty($this->main_js)) {
				foreach($this->main_js as $js) {
					if (!isset($requiredJS[md5($js)])) {
						$requiredJS[md5($js)] = $js;
					}
				}
			}
			// add main css
			if (!empty($this->main_css)) {
				foreach($this->main_css as $css) {
					if (!isset($requiredCSS[md5($css)])) {
						$requiredCSS[md5($css)] = $css;
					}
				}
			}
			// add page js
			if (isset($this->page_js) AND !empty($this->page_js)) {
				foreach($this->page_js as $js) {
					if (!isset($requiredJS[md5($js)])) {
						$requiredJS[md5($js)] = $js;
					}
				}
			}
			// add page css
			if (isset($this->page_css) AND !empty($this->page_css)) {
				foreach($this->page_css as $css) {
					if (!isset($requiredCSS[md5($css)])) {
						$requiredCSS[md5($css)] = $css;
					}
				}
			}
			if ($this->hasMethod('Blocks')) {
				if ($this->Blocks()) {
					foreach ($this->Blocks() as $Content) {
						$blocksCss = $Content->block_css;
						foreach ($blocksCss as $css) {
							$requiredCSS[md5($css)] = $css;
						}
					}
				}
				if ($this->Blocks()) {
					foreach ($this->Blocks() as $Content) {
						$blocksJs = $Content->block_js;
						foreach ($blocksJs as $js) {
							$requiredJS[md5($js)] = $js;
						}

					}
				}
			}

			// debug::endshow($requiredJS);
			Requirements::combine_files($this->ClassName . '_' . 'page.css', $requiredCSS);
			Requirements::combine_files($this->ClassName . '_' . 'page.js', $requiredJS);

			if ($this->hasMethod('getExternalJs')) {
				$extraJs = $this->getExternalJs();
				foreach ($extraJs as $key => $js) {
					Requirements::javascript($js);
				}
			}

			if (Director::isDev()) {
				SSViewer::config()->set('source_file_comments', true);
			}
		}

		public function ContactForm()
		{
			$ContactForm = new ContactForm($this, __FUNCTION__);
			// $ContactForm->enableSpamProtection();
			return $ContactForm;
		}
	}
}
