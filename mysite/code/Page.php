<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

	private static $allowed_children = array(
	);
	
	/**
	 * Metadata
	 */

	public function stripHtmlTags($str){
		return trim(preg_replace('/\s+/', ' ', strip_tags($str)));
	}

	public function onBeforeWrite(){
		if($this->Content && !$this->MetaDescription){
			$content = $this->stripHtmlTags($this->Content);

			if (strlen($content) > 160) {
				//limit hit!
				$string = substr($content, 0, 157);
				
				//stop on a word.
				$string = substr($string, 0, strrpos($string,' ')) . '...';
			
			}else{
				$string = $content;
			}

			$this->MetaDescription = $string;
		}
		parent::onBeforeWrite();
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		HtmlEditorConfig::get('cms')->removeButtons(
			'separator',
			'justifyleft',
			'justifycenter',
			'justifyright',
			'justifyfull',
			'styleselect',
			'tablecontrols',
			'visualaid',
			'ssmedia'
			);

		HtmlEditorConfig::get('cms')->setOptions(array('theme_advanced_blockformats' => "h4,h5,h6,p,address,pre"));

		$fields->addFieldToTab('Root.Main', $editor = new HTMLEditorField('Content', 'Content'));

		return $fields;
	}

	public function getSettingsFields() {
		$fields = parent::getSettingsFields();

		if(!Member::currentUser()->inGroup('administrators')){
			
			$fields = $fields->makeReadonly();	
		}
		
		return $fields;
	}

}
class Page_Controller extends ContentController {

	private static $allowed_actions = array(
	);

	public function init() {
		parent::init();

		if($this->dataRecord->hasExtension('Translatable')) { 
			i18n::set_locale($this->dataRecord->Locale); 
		}

		Requirements::clear();

		Requirements::combine_files('styles.css', array(
			"themes/phs/css/bootstrap.min.css",
			"themes/phs/css/main.css",
			"themes/phs/css/magnific-popup.css",
		));
		
		Requirements::insertHeadTags('<!--[if lt IE 9]><script src="' . Director::baseURL() . 'themes/phs/js/respond.min.js"></script><script src="' . Director::baseURL() . 'themes/phs/js/modernizr.custom.js"></script><![endif]-->');

		Requirements::combine_files('scripts.js', array(
			"themes/phs/js/jquery-1.10.2.min.js",
			FRAMEWORK_DIR . "/javascript/i18n.js",
			"themes/phs/js/validator/jquery.form-validator.min.js",
			"themes/phs/js/jquery-scrollto.js",
			"themes/phs/js/bootstrap.min.js",
			"themes/phs/js/jquery.magnific-popup.min.js",
			"themes/phs/js/jquery.history.uncompress.js",
			"themes/phs/js/ajaxify-html5.js",
			"themes/phs/js/main.js",
		));

		Requirements::javascript("themes/phs/lang/" . $this->get_current_locale() . ".js");
	}

	public function PageByLang($url, $lang) {
		$SQL_url = Convert::raw2sql($url);
		$SQL_lang = Convert::raw2sql($lang);

		$page = Translatable::get_one_by_lang('SiteTree', $SQL_lang, "URLSegment = '$SQL_url'");

		if($page->Locale != Translatable::get_current_locale()){
			$page = $page->getTranslation(Translatable::get_current_locale());
		}
		return $page;
	}
}
