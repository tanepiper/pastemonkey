<?php
class Tag extends AppModel {

	var $name = 'Tag';
	var $validate = array(
		'tag' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Paste' => array('className' => 'Paste',
						'joinTable' => 'pastes_tags',
						'foreignKey' => 'tag_id',
						'associationForeignKey' => 'paste_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
	);

}
?>