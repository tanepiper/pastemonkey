<?php
class Language extends AppModel {

	var $name = 'Language';
	var $validate = array(
		'language' => VALID_NOT_EMPTY,
	);

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
	
	function afterFind($results) {
		foreach ($results as $key => $val) {
			if (isset($val['Language']['language']) && isset($val['Language']['weight'])) {
				$results[$key]['Language']['dropdown'] = $val['Language']['language'] . ' (' . $val['Language']['weight'] . ')';
			}
		}
		return $results;
	}

}
?>