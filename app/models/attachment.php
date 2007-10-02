<?php 
class Attachment extends AppModel {
	var $name = 'Attachment';

	var $hasMany = array();
	var $hasOne = array();

	var $actsAs = array(
		'ImageUpload' => array(
			'allowedMime' => '*',
			'allowedExt' => '*'	
		)
	);
	var $validate = array (
		'description' => array(
			'required' => VALID_NOT_EMPTY
		)
	);

	function afterFind ($results, $primary = false) {
		if (isset($results[0][$this->name]['class']) && $this->recursive > 0) {
			foreach ($results as $key => $result) {
				$associated = array();
				$class = $result[$this->name]['class'];
				$foreignId = $result[$this->name]['foreign_id'];
				if ($class && $foreignId) {
					$result = $result[$this->name];
					if (!isset($this->$class)) {
						$this->bindModel (array('belongsTo' => array ($class)));
					}
					$associated = $this->$class->find(array($class.'.id'=>$foreignId),array('id', $this->$class->displayField),null,-1);
					$associated[$class]['display_field'] = $associated[$class][$this->$class->displayField];
					$results[$key][$class] = $associated[$class];
				}
			}
		}
		return $results;
	}
}
?>
