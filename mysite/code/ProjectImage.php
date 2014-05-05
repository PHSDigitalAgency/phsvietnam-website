<?php
class ProjectImage extends Visual{

    public static $has_one = array(
        'ProjectPage' => 'ProjectPage'
    );

	public static $searchable_fields = array(
	);

	public static $summary_fields = array(
		'ImageThumbnail' => 'Thumbnail',
		'MasterTitle' => 'Title',
		'ImageDimensions' => 'Dimensions',
		'ImageSize' => 'Size',
	);
	
	private static $translatable_fields = array(
		'Title'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('ProjectPageID');

		$uploadField = new UploadField('Image', 'Image file');
		$uploadField->setFolderName('projects');
		$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$fields->addFieldToTab('Root.Main', $uploadField);

		return $fields;
	}

	public function MasterTitle(){
		if(Translatable::get_current_locale() != Translatable::default_locale()){
			return $this->getField('Title__' . Translatable::get_current_locale());
		}else{
			return $this->Title;
		}
	}


	/*public function onBeforeWrite(){
		parent::onBeforeWrite();

		$page = $this->ProjectPage();
		$image = $this->Image();
		$table = 'ProjectPage_Images';

		if($page && $image && $page->ID && $image->ID){
			Debug::log('Page: ' . $page->ID . ' // Image ID: ' . $image->ID);

			$count = DB::query('SELECT COUNT(*) FROM "' . $table . '" WHERE "ProjectPageID" = ' . $page->ID . ' AND "ImageID" = ' . $image->ID)->value();
			
			if(!$count){
				Debug::log('First time we have to create the relation');
				DB::query('INSERT INTO "' . $table . '" ("ProjectPageID", "ImageID") VALUES (' . $page->ID . ', ' . $image->ID . ')');
			}
		}
	}*/
}