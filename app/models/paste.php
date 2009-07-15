<?php

/**
 * @package pastemonkey.models
 * @author Tane Piper <pastemonkey@ifies.org>
 * @name paste.php
 * @Version 0.6
 * @var Paste
 * The Paste model provides all the validation and additional methods for handling
 * pastes on the site.
 */
class Paste extends AppModel {

	/**
	 * The Paste model, used for autocompletion
	 * @var Paste
	 */
	var $Paste;
	/**
	 * The Name of the model
	 * @var name
	 */
	var $name = 'Paste';

	/**
	 * The validation rules that allow us to successfuly save
	 * @var validate
	 */
	var $validate = array(
		'paste' => VALID_NOT_EMPTY,
	);

	/**
	 * Invalid mine types for uploading
	 * @var invalid_mime_types
	 */
	var $invalid_mime_types = array(
		'application/exe',
		'image/*',
	);

	/**
	 * Additional behaviours that this model inherets
	 * @var actsAs
	 */
	var $actsAs = array('Tag');


	/**
	 * The relationships that the Paste model belongs to
	 * @var belongsTo
	 */
	var $belongsTo = array(
		'Parent' => array(
			'className' => 'Paste',
			'foreignKey' => 'parent_id'
		),
		'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'language_id'
		),
	);

	/**
	 * The relationships that the Paste model has many of
	 * @var hasMany
	 */
	var $hasMany = array(
		'Comment' => array(
			'className' => 'Comment'
		),
	);

	/**
	 * The relationship that the Paste model has and belongs to many of
	 * @var hasAndBelongsToMany
	 */
	var $hasAndBelongsToMany = array(
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'pastes_tags',
			'foreignKey' => 'paste_id',
			'associationForeignKey' => 'tag_id',
			'fields' => array('Tag.id', 'Tag.tag'),
			'order' => 'Tag.tag ASC',
			'unique' => true
		),
	);

	/**
	 * Paste model overides the model beforeSave
	 * In this overide, we check to see if a file is being uploaded and
	 * if so, then we process the file.
	 * The expiry date of the paste is also set based on the selected expiry
	 * drop down.
	 * Processing of highlighted lines and if the paste is private is also
	 * done here, and a stub is created.
	 */
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


	/**
	 * Paste overrides the afterSave method.
	 * After we have saved, we check the last inserted ID and then check the type
	 * of language.  Here we then update the weight of the language, so we can show the most
	 * popular languages
	 * @param created Boolean A boolean value if the item has been created in the save
	 * @return Boolean A boolean value if the afterSave has been successful
	 */
	function afterSave($created) {
		if ($created) {
			$last_insert = $this->read(null, $this->id);
			$last_insert['Language']['weight']++;
			$this->Language->id = $last_insert['Language']['id'];
			$this->Language->saveField('weight', $last_insert['Language']['weight'], false);
		}
		return true;
		//@unlink(CACHE.'views'.DS.'element__latest');
	}
				
	/**
	 * Paste overrides the afterDelete method
	 * After a paste has been deleted, we need to ensure that
	 * the last cached element is deleted so we can update it
	 */
	function afterDelete() {
		@unlink(CACHE.'views'.DS.'element__latest');
	}

	/**
	 * Returns an array of expiry times for a paste
	 * @return Array An array of expiry time objects
	 */
	function pasteExpiryTimes() {
		return array('1 hour'=>'1 Hour', '1 day'=>'1 Day','1 week'=>'1 Week','1 month'=>'1 Month','never'=>'Never');
	}

	/**
	 * Deletes all pastes that have expiry dates passed the current date
	 */
	function _purge(){
		$remove = $this->findAll('Paste.expiry < NOW()');
		foreach ($remove as $paste) {
			$this->delete($paste['Paste']['id']);
		}
	}

	/**
	 * Generate a date string from one of the expiry time options
	 */
	function _generateDate($expiry_type) {
		if ($expiry_type == 'never') {
			$output = null;
		} else {
			$output = date('Y-m-d H:i:s', strtotime($expiry_type));
		}
		return $output;
	}

	/**
	 * Takes the passed source code and extracts the highlighted lines
	 * @param String The text source
	 * @return Array An array containing the values of the highlighted lines and processed lines
	 */
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

	/**
	 * Takes a file handler and processes the file by checking it's valid, then putting
	 * the content into the paste
	 * @param File The File Handler
	 * @return Boolean A boolean value to confirm if the file processing has been successful
	 *
	 */
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
		return true;
	}
	
}
?>