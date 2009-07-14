<?php

uses('String');
class Paste extends AppModel {

	var $name = 'Paste';
	var $validate = array(
		'paste' => VALID_NOT_EMPTY,
	//	'language_id' => VALID_NOT_EMPTY,
	);
	
	var $invalid_mine_types = array(
		'application/exe',
		'image/png',
	);
	
	var $actsAs = array('Tag'); 
	
	
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
	
	var $hasMany = array(
			'Comment' => array('className' => 'Comment'
				),
	);

	var $hasAndBelongsToMany = array(
			'Tag' => array('className' => 'Tag',
						'joinTable' => 'pastes_tags',
						'foreignKey' => 'paste_id',
						'associationForeignKey' => 'tag_id',
						'fields' => array('Tag.id', 'Tag.tag'),
						'order' => 'Tag.tag ASC',
						'unique' => true),
	);	

	function beforeSave() {
	
		$output = '';
	
		if (!empty($this->data['Paste']['file'])) {
			$this->__processFile($this->data['Paste']['file']);
		}
		
		$this->data['Paste']['expiry'] = $this->_generateDate($this->data['Paste']['expire_type']);
		
		$process = $this->_highlightLines($this->data['Paste']['paste']);
		
		foreach ($process['lines'] as $key => $val) {
			$output .= $val . ',';
		}
		$this->data['Paste']['highlight_lines'] = $output;
		$this->data['Paste']['paste'] = $process['output'];
		
		if ($this->data['Paste']['private']) {
			$this->data['Paste']['priv_stub'] = String::uuid();
		}
		
		return true;
	}

	function beforeRender() {
	}
	
	function afterSave($created)
	{
		if ($created) {
			$last_insert = $this->read(null, $this->id);
			$last_insert['Language']['weight']++;
			$this->Language->id = $last_insert['Language']['id'];
			$this->Language->saveField('weight', $last_insert['Language']['weight'], false);			
		}
		return true;
		//@unlink(CACHE.'views'.DS.'element__latest');
	}
 	    
	function afterDelete()
	{
		@unlink(CACHE.'views'.DS.'element__latest');
	}
	
	function pasteExpiryTimes() {
	  return array('1 hour'=>'1 Hour', '1 day'=>'1 Day','1 week'=>'1 Week','1 month'=>'1 Month','never'=>'Never');
	}
	
	
	function _purge(){
		$remove = $this->findAll('Paste.expiry < NOW()');
		foreach ($remove as $paste) {
			$this->delete($paste['Paste']['id']);
		}
	}
	
	function _generateDate($expiry_type) {
		if ($expiry_type == 'never') {
			$output = null;
		} else {
			$output = date('Y-m-d H:i:s', strtotime($expiry_type));
		}
		return $output;
	}
	
	function _highlightLines($source) {
	
		$search = '!!!';
		$replace = '';
		
		$each_line = explode("\n",$source);
   		$count=0;
		$lines = array('lines'=>array(), 'output'=>'');
		$output = '';
		 while ($count < count($each_line)) { 
			if(str_replace($search, $replace, $each_line[$count]) != $each_line[$count]) {
				array_push($lines['lines'], $count + 1);	
				$each_line[$count] = str_replace($search, $replace, $each_line[$count]);
			}
			$lines['output'] .= $each_line[$count] . "\n";
			$count++;
		}
		return $lines;
	}
	
	function __processFile($file) {
		if(move_uploaded_file($file['tmp_name'], Configure::read('File.upload_dir') . '/' . $file['name'])) {
			if ($file['size'] > Configure::read('File.maxsize')) {
				return false;
			}
			
			$openfile = fopen(Configure::read('File.upload_dir') . '/' . $file['name'], 'r');
			$contents = fread($openfile, Configure::read('File.maxsize'));
			if (preg_match('/\0/', $contents)) {
				fclose($openfile);
				unlink(Configure::read('File.upload_dir') . '/' . $file['name']);
				return false;
			} else {
				$this->data['Paste']['paste'] = $contents;
				fclose($openfile);
				unlink(Configure::read('File.upload_dir') . '/' . $file['name']);
			}
		}
	}
}
?>
