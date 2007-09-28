<?php
class Pinboard extends AppModel {

	var $name = 'Pinboard';
	var $validate = array(
		'title' => VALID_NOT_EMPTY,
		'body' => VALID_NOT_EMPTY,
		'author' => VALID_NOT_EMPTY,
	);
	
	var $actsAs = array('Tag');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasAndBelongsToMany = array(
			'Tag' => array('className' => 'Tag',
						'joinTable' => 'pinboards_tags',
						'foreignKey' => 'pinboard_id',
						'associationForeignKey' => 'tag_id',
						'fields' => array('Tag.id', 'Tag.tag'),
						'order' => 'Tag.tag ASC',
						'unique' => true),
	);
}
?>