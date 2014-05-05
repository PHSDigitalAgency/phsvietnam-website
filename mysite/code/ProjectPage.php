<?php
class ProjectPage extends Page{

	public static $db = array(
		'IsFeatured' => 'Boolean',
	);

	public static $has_one = array(
	);

	private static $has_many = array(
		'Images' => 'ProjectImage',
		'Videos' => 'Videos',
	);

	public static $allowed_children = array(
	);

	public static $defaults = array(
		'ShowInSearch' => false,
		'Priority' => '-1',
		'IsFeatured' => false,
	);

	public static $can_be_root = false;

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		// $fields->removeByName('Content');
		// $fields->removeByName('MenuTitle');
		// $fields->removeByName('MetaDescription');
		// $fields->removeByName('ExtraMeta');
		// $fields->removeByName('Metadata');

		$fields->addFieldToTab('Root.Main', new CheckboxField('IsFeatured', 'Featured project'), 'Content');

		$config = GridFieldConfig_RecordEditor::create();
		$config->addComponent(new GridFieldSortableRows('SortOrder'));
		$config->addComponent(new GridFieldBulkImageUpload());
		
		$config->getComponentByType('GridFieldBulkImageUpload')->setConfig('folderName', 'projects' );
		$config->getComponentByType('GridFieldPaginator')->setItemsPerPage(20);

		$f = new GridField('Images', 'Images', $this->Master()->Images(), $config);
		$f->setModelClass('ProjectImage');

		$fields->addFieldToTab('Root.Images', $f);

		$configv = GridFieldConfig_RecordEditor::create();
		$configv->addComponent(new GridFieldSortableRows('SortOrder'));
		$fv = new GridField('Videos', 'Videos', $this->Master()->Videos(), $configv);
		$fv->setModelClass('Videos');

		$fields->addFieldToTab('Root.Videos', $fv);

		return $fields;
	}
}
class ProjectPage_Controller extends Page_Controller{

	private static $allowed_actions = array(
	);

	public function init() {
		parent::init();
	}
}