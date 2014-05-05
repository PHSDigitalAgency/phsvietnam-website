<?php
class AboutPage extends Page{
	public static $db = array(
	);

	public static $has_one = array(
	);

	public static $allowed_children = array(
		'StaffPage'
	);
}
class AboutPage_Controller extends Page_Controller{

	private static $allowed_actions = array(
	);

	public function init() {
		parent::init();
	}
}