<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
		'email' => VALID_NOT_EMPTY,
		'passwd' => VALID_NOT_EMPTY,
		'author' => VALID_NOT_EMPTY,
		'pastes_count' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
				'Paste' => array('classname'=>'Paste',
										'foreignKey'=>'author'),
	);
}
?>