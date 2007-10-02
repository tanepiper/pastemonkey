<?php
class UploadBehavior extends ModelBehavior {
	
	var $__defaultSettings = array(
		'enabled' => true,
		'fileField' => 'filename',
		'dirField' => 'dir',
		'allowedMime' => '*', //array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
		'allowedExt' => '*', //array('jpg','jpeg','gif','png'),
		'allowedSize' => '8', // '*' for no limit (in any event limited by php settings)
		'allowedSizeUnits' => 'MB', 
		'overwriteExisting' => false,
		/* Dynamic path/file names 
		 * The constants DS, APP, WWW_ROOT can be used if wrapped in {}
		 * To use a variable, wrap in {} if the var is not defined during setup it is assumed to be the name
		 * of a field in the submitted data
		 */
		'baseDir' => '{APP}uploads{DS}',
		'dirFormat' => '{$class}{DS}{$foreign_id}', // include {$baseDir} to have absolute paths
		'fileFormat' => '{$filename}_{$description}', // include {$dir} to store the dir & filename in one field
		'pathReplacements' => array(),
		'_setupError' => false
	);

	function setup(&$model, $config=array()) {
		$settings = am ($this->__defaultSettings, $config);
		uses('Folder');
		$this->settings[$model->name] = $settings;
		extract ($this->settings[$model->name]);
		
		$this->addReplace($model, '{WWW_ROOT}', WWW_ROOT);
		$this->addReplace($model, '{APP}' , APP);
		$this->addReplace($model, '{DS}', DS);
		$path = $this->__replacePseudoConstants($model, $baseDir);	
		
		if (!file_exists($path)) {
			new Folder($path, true);
			if (!file_exists($path)) {
				trigger_error('Base directory ' . $path . ' doesn\'t exist and cannot be created. '.__METHOD__, E_USER_WARNING);
				$this->settings[$model->name]['enabled'] = false;
				$this->settings[$model->name]['_setupError'] = true;
			}
		} elseif(!is_writable($path)) {
			trigger_error('Base directory ' . $path . ' is not writable. '.__METHOD__, E_USER_WARNING);
			$this->settings[$model->name]['enabled'] = false;
			$this->settings[$model->name]['_setupError'] = true;
		};
		$this->settings[$model->name]['baseDir'] = $path;
		if (!$enabled) {
			return;
		}
		$this->setupUploadValidations ($model);
	}

	function enableUpload(&$model, $enable = null) {
		if ($enable !== null) {
			$this->settings[$model->name]['enabled'] = $enable;
		}
		return $this->settings[$model->name]['enabled'];
	}
	
	function addReplace(&$model, $find, $replace = '') {
		$this->settings[$model->name]['pathReplacements'][$find] = $replace;
	}
	
	function beforeDelete(&$model) {
		extract ($this->settings[$model->name]);
		if (!$enabled) {
			return true;
		}
		if ($model->hasField($dirField)) {
			$data = $model->read(array($dirField,$fileField));
			$dirField = $data[$model->name]['dir'];
			$filename = $data[$model->name][$fileField];
			$filename = $dirField . DS . $filename;
		} else {
			$filename = $model->field($fileField);
		}
		if (file_exists($baseDir . $filename) && !unlink($baseDir . $filename)) {
			return false;
		}
        	return true;
    	}

	function beforeSave(&$model) {
		extract ($this->settings[$model->name]);
		if (!$enabled) {
			return true;
		}
		return $this->_processUpload($model);
	}

	function checkUploadSetup (&$model, $fieldData) {
		extract ($this->settings[$model->name]);
		if ($_setupError) {
			return false;
		}
		if (!$enabled) {
			return true;
		}
		if (!is_array($fieldData)) {
			trigger_error('The form field (' . $fileField. ') is not an array, check the form has enctype=\'multipart/form-data\'. If you are using the form helper include \'type\' => \'file\' in the second parameter '.__METHOD__, E_USER_WARNING);
			return false;
		}
		return true;
	}

	function checkUploadError (&$model, $fieldData) {
		extract ($this->settings[$model->name]);
		if (!$enabled || $_setupError || !is_array($fieldData)) {
			return true;
		}
		if ($fieldData['size'] && $fieldData['error']) {
			return false;
		}
		return true;
	}

	function checkUploadMime (&$model, $fieldData) {
		extract ($this->settings[$model->name]);
		if (!$enabled || $_setupError || !is_array($fieldData) || $allowedMime == '*') {
			return true;
		}
		if (is_array($allowedMime)) {
			if (in_array($fieldData['type'], $allowedMime)) {
				return true;
			}
		} elseif ($allowedMime == $fieldData['type']) {
			return true;
		}
		return false;
	}

	function checkUploadExt (&$model, $fieldData) {
		extract ($this->settings[$model->name]);
		if (!$enabled || $_setupError || !is_array($fieldData) || $allowedExt == '*') {
			return true;
		}
		$info = pathinfo($fieldData['name']);
		$fileExt = low ($info['extension']);
		if (is_array($allowedExt)) {
			if (in_array($fileExt, $allowedExt)) {
				return true;
			}
		} elseif ($allowedExt == $fileExt) {
			return true;
		}
		return false;
	}

	function checkUploadSize (&$model, $fieldData) {
		extract ($this->settings[$model->name]);
		if (!$enabled || $_setupError || !is_array($fieldData) || !$fieldData['size'] || $allowedSize == '*') {
			return true;
		}
		$factor = 1;
		switch ($allowedSizeUnits) {
			case 'KB':
				$factor = 1024;
			case 'MB':
				$factor = 1024 * 1024;
		}
		if ($fieldData['size'] < ($allowedSize * $factor)) {
			return true;
		}
		return false;
	}

	function absolutePath (&$model, $id = null, $folderOnly = false) {
		if (!$id) {
			$id = $model->id;
		}
		extract ($this->settings[$model->name]);
		$path = $baseDir;
		if ($model->hasField($dirField)) {
			if (isset($model->data[$model->name][$dirField])) {
				$dir = $model->data[$model->name][$dirField];
			} else {
				$dir = $model->field($dirField);
			}
			$path .= $dir . DS;
		}
		if ($folderOnly) {
			return $path;
		}
		if (isset($model->data[$model->name][$dirField])) {
			$path .= $model->data[$model->name][$fileField];
		} else {
			$path .= $model->field($fileField);
		}
		return $path; 
	}	
	
	function processUpload(&$model, $data = array()) {
		return $this->_processUpload($model, $data, true);
	}

	function setupUploadValidations(&$model) {
		extract ($this->settings[$model->name]);
		if (isset($model->validate[$fileField])) {
			$existingValidations = $model->validate[$fileField];
			if (!is_array($existingValidations)) {
				$existingValidations = array($existingValidations);
			}	
		} else {
			$existingValidations = array();
		}

		$validations['uploadSetup'] = array(
				'rule' => 'checkUploadSetup',
				'message' => 'Upload not possible. There is a problem with the setup on the server, more info available in the logs.'	
			);
		$validations['uploadError'] = array(
				'rule' => 'checkUploadError',
				'message' => 'An error was generated during the upload.'	
			);
		if ($allowedMime != '*') {
			if (is_array($allowedMime)) {
				$allowedMimes = implode(',', $allowedMime);
			} else {
				$allowedMimes = $allowedMime;
			}
			$validations['uploadMime'] = array(
				'rule' => 'checkUploadMime',
				'message' => 'The submitted mime type is not permitted, only ' . $allowedMimes . ' permitted.'
				);
		}
		if ($allowedExt != '*') {
			if (is_array($allowedExt)) {
				$allowedExts = implode(',', $allowedExt);
			} else {
				$allowedExts = $allowedExt;
			}
			$validations['uploadExt'] = array(
				'rule' => 'checkUploadExt',
				'message' => 'The submitted file extension is not permitted, only ' . $allowedExts . ' permitted.'
				);
		}
		$validations['uploadSize'] = array(
			'rule' => 'checkUploadSize',
			'message' => 'The file uploaded is too big, only files less than ' . $allowedSize . ' ' . $allowedSizeUnits .' permitted.'	
		);
		$model->validate[$fileField] = am($validations, $existingValidations); //Run the behavior validations first.
	}

	function _afterProcessUpload(&$model, $data, $direct) {
		return true;
	}

	function _beforeProcessUpload(&$model, $data, $direct) {
		return true;
	}

	function _getFilename($model, $string) {
		extract ($this->settings[$model->name]);
		if (strpos($string,'{') === false) {
			return Inflector::underscore(preg_replace('@[^\p{L}0-9]@u', '', $string));
		}
		return $this->__replacePseudoConstants($model, $string);
	}

	function _getPath ($model, $path) {
		extract ($this->settings[$model->name]);
		if (strpos($path,'{') === false) {
			return $path;
		}
		$path = $this->__replacePseudoConstants($model, $path);
		new Folder ($baseDir . $path, true);
		return $path;
	}

	function _processUpload(&$model, $data = array(), $direct = false) {
		if ($data) {
			$model->data = $data;
		}
		// Double check for upload start
		extract ($this->settings[$model->name]);
		if(!isset($model->data[$model->name][$fileField])) {
			if ($direct) {
				trigger_error('The method processUpload has been explicitly called but the filename field (' . $fileField . ') is not present in the submitted data. '.__METHOD__, E_USER_WARNING);
				return false;
			}
			return true; 
		}
		// Double check for upload end
		
		if (!$this->_beforeProcessUpload($model, $data, $direct)) {
			return false;
		}
		extract ($this->settings[$model->name]);
		
		// Get file path
		$info = pathinfo($model->data[$model->name][$fileField]['name']);
		$extension = $info['extension'];
		$filename = $info['filename'];
		$dir = $this->_getPath($model, $dirFormat);

		if (!$dir) {
			trigger_error('Couldn\'t determine or create the directory. '.__METHOD__, E_USER_WARNING);
			return false;
		}
		$this->addReplace($model, '{$dir}', $dir);

		// Get filename
		uses('Sanitize');
		$this->addReplace($model, '{$filename}', Sanitize::paranoid($filename, array(' ', '_', '-')));
		$filename = $this->_getFilename($model, $fileFormat);
		$model->data[$model->name][$fileField]['name'] = $filename.'.'.$extension;
		
		// Create save path
		$saveAs = $dir . DS . $filename . '.' . $extension;
		
		// Check if file exists
       	        if(file_exists($baseDir . $saveAs)) {
			if($overwriteExisting) {
				if(!unlink($saveAs)) {
					trigger_error('The file ' . $saveAs . ' already exists and cannot be deleted. '.__METHOD__, E_USER_WARNING);
					return false;
				}
			} else {
				$count = 2;
				while(file_exists($baseDir . $dir . DS . $filename . '_' . $count . '.' . $extension)) {
					$count++;
				}
				$model->data[$model->name][$fileField]['name'] = $filename . '_' . $count . '.' . $extension;
				$saveAs = $dir . DS . $filename . '_' . $count . '.' . $extension;
			}
               	} 
			
		// Attempt to move uploaded file
		if(!move_uploaded_file($model->data[$model->name][$fileField]['tmp_name'], $baseDir . $saveAs)) {
			trigger_error('Couldn\'t move the uploaded file. '.__METHOD__, E_USER_WARNING);
			return false;
		}
		
		// Update model data
		if (!$model->hasField($dirField)) {
			$model->data[$model->name][$fileField] = $dir . $model->data[$model->name][$fileField];
		}
		$model->data[$model->name][$dirField] = $dir;
		$model->data[$model->name]['mimetype'] =  $model->data[$model->name][$fileField]['type'];				
		$model->data[$model->name]['filesize'] = $model->data[$model->name][$fileField]['size'];
		$model->data[$model->name][$fileField] = $model->data[$model->name][$fileField]['name'];
		$this->_afterProcessUpload($model, $data, $direct);
		return true;
	}

	function __replacePseudoConstants($model, &$string) {
		extract($this->settings[$model->name]);
		$random = uniqid(""); // generate a random var each time called.
		preg_match_all('@{\$([^{}]*)}@', $string, $r);
		foreach ($r[1] as $i => $match) {
			if (!isset($this->settings[$model->name]['pathReplacements'][$r[0][$i]])) { 
				if (isset($$match)) {
					$this->addReplace($model, $r[0][$i], $$match);
				} elseif (isset($model->data[$model->name][$match])) {
					$this->addReplace($model, $r[0][$i], $model->data[$model->name][$match]);
				} else {
					trigger_error('Cannot replace ' . $match . ' as the variable $' . $match . ' cannot be determined '.__METHOD__, E_USER_WARNING);
				}
			}
		}
		$markers = array_keys($this->settings[$model->name]['pathReplacements']);
		$replacements = array_values($this->settings[$model->name]['pathReplacements']);
		return str_replace ($markers, $replacements, $string);
	}
}
?>
