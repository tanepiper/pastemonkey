<?php
class Paste extends AppModel {

	var $name = 'Paste';
	var $validate = array(
		'paste' => VALID_NOT_EMPTY,
		'language_id' => VALID_NOT_EMPTY,
	);
	
	var $actsAs = array('Tag','ImageUpload'); 
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Parent' => array('className' => 'Paste',
								'foreignKey' => 'parent_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
			'Language' => array('className' => 'Language',
								'foreignKey' => 'language_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
			'User' => array('className'=>'User',
									'foreignKey'=>'author'),
	);

	var $hasAndBelongsToMany = array(
			'Tag' => array('className' => 'Tag',
						'joinTable' => 'pastes_tags',
						'foreignKey' => 'paste_id',
						'associationForeignKey' => 'tag_id',
						'fields' => array('Tag.id', 'Tag.tag'),
						'order' => 'Tag.tag ASC',
						'unique' => true),
	);
	
	var $hasMany = array(
		'Attachment' => array(
			'foreignKey' => 'foreign_id',
			'conditions' => array('Attachment.class' => 'To Be Filled'),
			'dependent' => true
		)
	);
	
	var $hasOne = array(
		'Thumb' => array(
			'className' => 'Attachment',	
			'foreignKey' => 'foreign_id',
			'conditions' => array('Thumb.class' => 'To Be Filled', 'Thumb.thumb' => true),
			'dependent' => true
		)
	);
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct();
		if (isset($this->hasMany['Attachment'])) {
			$this->hasMany['Attachment']['conditions']['Attachment.class'] = $this->name;
		}
		if (isset($this->hasOne['Thumb'])) {
			$this->hasOne['Thumb']['conditions']['Thumb.class'] = $this->name;
		}
	}
	
	function beforeRender() {
	}
	
	function afterSave()
	{
		@unlink(CACHE.'views'.DS.'element__latest');
	}
 	    
	function afterDelete()
	{
		@unlink(CACHE.'views'.DS.'element__latest');
	}
}
?>