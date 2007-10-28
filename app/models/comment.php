<?php
class Comment extends AppModel {

	var $name = 'Comment';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Paste' => array('className' => 'Paste',
								'foreignKey' => 'paste_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);

}
?>