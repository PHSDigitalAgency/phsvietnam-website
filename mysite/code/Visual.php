<?php
class Visual extends DataObject implements PermissionProvider{
	public static $db = array(
		'Title' => 'Varchar',
		'SortOrder'=>'Int'
	);

	public static $has_one = array(
		'Image' => 'Image',
	);

	public static $searchable_fields = array(
		'Title',
	);

	public static $summary_fields = array(
		'ImageThumbnail' => 'Thumbnail',
		'Title' => 'Title',
		'ImageDimensions' => 'Dimensions',
		'ImageSize' => 'Size',
	);

	public static $default_sort = 'SortOrder';

	public function ImageThumbnail(){
		if($this->Image()){
			return $this->Image()->SetHeight(30);
		}
		return NULL;
	}

	public function ImageDimensions(){
		if($this->Image()){
			return $this->Image()->getDimensions();
		}
		return NULL;
	}

	public function ImageSize(){
		if($this->Image()){
			return $this->Image()->getSize();
		}
		return NULL;
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('SortOrder');

		return $fields;
	}

	public function onBeforeWrite(){
		parent::onBeforeWrite();

		if(!$this->Title && $this->Image()->ID){
			$this->Title = $this->Image()->Title;
		}
	}

	public function onBeforeDelete(){
		parent::onBeforeDelete();

		$image = $this->Image();
		if($image->ID){
			$image->delete();
		}
	}

	/**
	 * Permissions
	 */
	public static $api_access = true;

	public function canView($member = false) {
		if(!$member) $member = Member::currentUser();

		return Permission::check('VISUAL_VIEW');
	}
	public function canEdit($member = false) {
		if(!$member) $member = Member::currentUser();

		return Permission::check('VISUAL_EDIT');
	}
	public function canDelete($member = false) {
		if(!$member) $member = Member::currentUser();

		return Permission::check('VISUAL_DELETE');
	}
	public function canCreate($member = false) {
		if(!$member) $member = Member::currentUser();

		return Permission::check('VISUAL_CREATE');
	}
	public function providePermissions() {
		return array(
			'VISUAL_VIEW' => 'Read a visual',
			'VISUAL_EDIT' => 'Edit a visual',
			'VISUAL_DELETE' => 'Delete a visual',
			'VISUAL_CREATE' => 'Create a visual',
		);
	}
}