<?php

namespace {

	use SilverStripe\CMS\Controllers\ContentController;
	use SilverStripe\View\Requirements;
	use SilverStripe\Control\Director;
	use SilverStripe\View\SSViewer;
	use SilverStripe\Dev\Debug;
	use SilverStripe\Control\Controller;
	use SilverStripe\Core\Injector\Injector;

	use Component\FormBlock;
	use Component\FormHandler;

	class PageController extends ContentController
	{
		private static $allowed_actions = [
			'DataForm'
		];

		public $main_css = [
			'properties/css/bootstrap.min.css',
			'properties/css/bootstrap-slider.css',
			'properties/css/font-awesome.min.css',
			'properties/css/default.css',
			'properties/css/style.css'
		];

		public $main_js = [
			'properties/js/jquery.min.js',
			'properties/js/bootstrap.min.js',
			'properties/js/bootstrap-slider.js',
			'properties/js/main.js',
			'properties/js/highlight.pack.js'
		];

		protected function init()
		{
			parent::init();

			$arrayJS  = [];
			$arrayCSS = [];

			if (!empty($this->main_js)) {
				foreach ($this->main_js as $js) {
					if (!isset($arrayJS[md5($js)])) {
						$arrayJS[md5($js)] = $js;
					}
				}
			}

			if (!empty($this->main_css)) {
				foreach ($this->main_css as $css) {
					if (!isset($arrayCSS[md5($css)])) {
						$arrayCSS[md5($css)] = $css;
					}
				}
			}

			$Blocks = $this->Blocks();
			if ($Blocks->Count()) {
				foreach ($Blocks as $key => $Box) {
					if (isset($Box->page_js) AND count($Box->page_js)) {
						foreach ($Box->page_js as $js) {
							if (!isset($arrayJS[md5($js)])) {
								$arrayJS[md5($js)] = $js;
							}
						}
					}
				}
				foreach ($Blocks as $key => $Box) {
					if (isset($Box->page_css) AND count($Box->page_css)) {
						foreach ($Box->page_css as $css) {
							if (!isset($arrayCSS[md5($css)])) {
								$arrayCSS[md5($css)] = $css;
							}
						}
					}
				}
			}
			// debug::endshow($arrayJS);

			Requirements::combine_files('main-page.css', $arrayCSS);
			Requirements::combine_files('main-page.js', $arrayJS);
			Requirements::set_force_js_to_bottom(true);

			if (Director::isDev()) {
				SSViewer::config()->set('source_file_comments', true);
			}
		}

		public function DataForm()
		{
			$getVars = $this->request->getVars();
			if ($getVars) {
				return $this->dataRecord->DataForm($getVars, $this);
			}
			return false;
		}
	}
}
