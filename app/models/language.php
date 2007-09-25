<?php
class Language extends AppModel {

	var $name = 'Language';
	var $validate = array(
		'language' => VALID_NOT_EMPTY,
	);
	
	var $actsAs = array('Geshi');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Paste' => array('className' => 'Paste',
								'foreignKey' => 'language_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'dependent' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''),
	);

}
?>