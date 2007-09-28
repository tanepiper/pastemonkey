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
			'Pinboard' => array('className' => 'Pinboard',
						'joinTable' => 'pinboards_tags',
						'foreignKey' => 'tag_id',
						'associationForeignKey' => 'pinboard_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'unique' => true),
	);
}
?>