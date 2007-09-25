<?php
class Tag extends AppModel {
	
	var $hasAndBelongsToMany = array(
			'Paste' => array('className' => 'Paste',
						'joinTable' => 'pastes_tags',
						'foreignKey' => 'tag_id',
						'associationForeignKey' => 'paste_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'unique' => true),
	);
}
?>