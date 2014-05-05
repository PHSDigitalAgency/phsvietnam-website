<?php
class SiteConfigExtras extends DataExtension {
	public static $db = array(
		'Email' => 'Varchar',
		'Phone1' => 'Varchar',
		'Phone2' => 'Varchar',
		'FacebookPage' => 'Varchar',
		'LinkedInPage' => 'Varchar',
		'Copyright' => 'Varchar',
	);

	public static $has_one = array(
		'Logo' => 'Image',
	);

	public function updateCMSFields(FieldList $fields){
		
		$fields->addFieldToTab('Root.Main', new EmailField('Email', 'Email'));
		$fields->addFieldToTab('Root.Main', new TextField('Phone1', 'Phone 1'));
		$fields->addFieldToTab('Root.Main', new TextField('Phone2', 'Phone 2'));
		$fields->addFieldToTab('Root.Main', new TextField('Copyright', 'Copyright'));
		$fields->addFieldToTab('Root.Main', new UploadField('Logo', 'Logo'));

		$fields->addFieldToTab('Root.Facebook', new TextField('FacebookPage', 'Facebook Page'));
		$fields->addFieldToTab('Root.LinkedIn', new TextField('LinkedInPage', 'LinkedIn Page'));

		if(!Member::currentUser()->inGroup('administrators')){
			$fields->removeByName('Title');
			$fields->removeByName('Logo');
			$fields->removeByName('Theme');
			$fields->removeByName('Access');
		}
	}
}