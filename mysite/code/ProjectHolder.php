<?php
class ProjectHolder extends Page{

	public static $db = array(
	);

	public static $has_one = array(
	);

	public static $allowed_children = array(
		'ProjectPage'
	);
}
class ProjectHolder_Controller extends Page_Controller{

	private static $allowed_actions = array(
	);

	public function init() {
		parent::init();
	}

	/*public function getFeaturedProjects(){
		return ProjectPage::get()->filter(array('IsFeatured' => true, 'ParentID' => $this->ID));
	}*/
}