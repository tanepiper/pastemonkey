<?php
class Paste extends AppModel {

	var $name = 'Paste';
	var $validate = array(
		'paste' => VALID_NOT_EMPTY,
		'language_id' => VALID_NOT_EMPTY,
	);
	
	var $actsAs = array('Geshi', 'Tag'=>array('table_label'=>'tags', 'tags_label'=>'tag', 'separator'=>',')); 
	
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
	);

	var $hasAndBelongsToMany = array(
			'Tag' => array('className' => 'Tag',
						'joinTable' => 'pastes_tags',
						'foreignKey' => 'paste_id',
						'associationForeignKey' => 'tag_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => true,
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''),
	);
	
	/*function beforeSave($result) {
		pr($result);
		foreach ($result as $key => $val) {
			if(!isset($val['Paste']['author'])) {
				$result[$key]['Paste']['author'] == 'Anonymous';
			}
		}
		return $result;
	}*/
}
?>