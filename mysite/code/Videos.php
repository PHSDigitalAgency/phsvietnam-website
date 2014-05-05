<?php
class Videos extends Visual{
	public static $db = array(
		'Type' => 'Enum("Youtube,Kickstarter")',
		'Code' => 'Varchar(255)',
		'List' => 'Varchar',
	);

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

	public static $uploadField;

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('ProjectPageID');
		$fields->removeByName('Image');

		$fields->addFieldToTab('Root.Main', new DropdownField('Type', 'Type', singleton('Videos')->dbObject('Type')->enumValues()));
		$fields->addFieldToTab('Root.Main', new TextField('Code', 'Code'));		

		$type = strtolower($this->Type);
		if($type == "youtube"){
			$fields->addFieldToTab('Root.Main', new TextField('List', 'List'));
		}else{
			$fields->removeByName('List');
		}

		if($this->Code){
			$this->uploadField = new UploadField('Image', 'Image file');
			$this->uploadField->setFolderName('projects');
			$this->uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
			$fields->addFieldToTab('Root.Main', $this->uploadField);
		}

		return $fields;
	}

	public function getLink(){
		$type = strtolower($this->Type);
		if($type == 'youtube'){
			return "http://www.youtube.com/watch?v={$this->Code}&list={$this->List}";
		}else if($type == 'kickstarter'){
			return "http://www.kickstarter.com/projects?v={$this->Code}";
		}
		
	}


	public function onBeforeWrite(){
		parent::onBeforeWrite();
		
		if($this->Code && !$this->ImageID){
			
			$code = $this->Code;
			$type = strtolower($this->Type);
			
			$srcImage = '';

			if($type == 'youtube'){
				$fileName = "assets/videos/{$type}/thumb/{$code}.jpg";
				$srcImage = "http://img.youtube.com/vi/{$code}/0.jpg";
				
			}else if($type == 'kickstarter'){
				$fileName = "assets/videos/{$type}/thumb/kickstarter{$this->ID}.jpg";
				$contentTarget = file_get_contents("http://www.kickstarter.com/projects/" . $code . "/widget/video.html");

				if($contentTarget !== FALSE){
					$substr = substr($contentTarget, strpos($contentTarget, "data-image") + 12 );
					$substr = substr($substr, 0, strpos($substr, '"'));
					$srcImage = $substr;
				}				
			}

			if($srcImage != ''){
				file_put_contents(Controller::join_links(Director::baseFolder(), $fileName), file_get_contents($srcImage));

				$this->Image()->setFilename($fileName);
				$this->Image()->Title = $this->Title ? $this->Title : $code;
				$this->Image()->write();

				$this->ImageID = $this->Image()->ID;				
			}
		}		
	}

	public function MasterTitle(){
		if(Translatable::get_current_locale() != Translatable::default_locale()){
			return $this->getField('Title__' . Translatable::get_current_locale());
		}else{
			return $this->Title;
		}
		
	}

	public function validate() {
		$result = parent::validate();

		if(!$this->Code || $this->Code == ""){
			$result->error("Please enter the field 'Code'.");
		}

		return $result;
	}

	public function extractNodeValue($query, $xPath, $attribute = null) {
		$node = $xPath->query("//{$query}")->item(0);
		if (!$node) {
			return null;
		}
		return $attribute ? $node->getAttribute($attribute) : $node->nodeValue;
	}
}