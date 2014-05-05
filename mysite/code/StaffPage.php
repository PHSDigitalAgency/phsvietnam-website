<?php
class StaffPage extends Page{
	public static $db = array(
	);

	public static $has_one = array(
		'Image' => 'Image',
	);

	public static $allowed_children = array(
	);

	public static $defaults = array(
		'ShowInSearch' => false,
		'Priority' => '-1',
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$uploadField = new UploadField('Image', 'Image');
		$uploadField->setFolderName('staff');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->addFieldToTab('Root.Main', $uploadField);

		return $fields;
	}
}
class StaffPage_Controller extends Page_Controller{

	private static $allowed_actions = array(
	);

	public function init() {
		parent::init();
	}
}