<?php
/**
 *	Improved Upload Behaviour
 * 	This behaviour is based on Chris Partridge's upload behaviour (http://bin.cakephp.org/saved/17539)
 * 	@author Tane Piper (digitalspaghetti@gmail.com)
 * 	@link http://www.digitalspaghetti.me.uk
 * 	@filesource http://bakery.cakephp.org/articles/view/improved-upload-behaviour-with-thumbnails-and-name-correction
 * 	@version 1.1
 * 	@modifiedby      $LastChangedBy:$
 * 	@lastmodified    $Date:$
 * 	@svn             $Id:$
 * 
 * 	Version Details
 * 
 * 	1.2
 *	+ Rewritten AD7six
 *	
 * 	1.1
 * 	+ Improved Image scaling code
 * 	+ Fixed check to see if file exists and rename file to unique name
 * 	+ Improved model actsAs to allow more thumbnail sizes
 * 
 * 	1.0
 * 	+ Initial release with thumbnail code.
 */
	

class UploadBehavior extends ModelBehavior {
	
	var $__defaultSettings = array(
		'field' => 'filename',
		'allowedMime' => array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
		'allowedExt' => array('jpg','jpeg','gif','png'),
		'overwriteExisting' => false,
		'createDirectory' => true,
		'randomFilenames' => true,
		'thumbsizes' => array(
			'small'	=> array('width' => 100, 'height' => 100, 'name' => '{$file}.small.{$ext}'),
			'medium' => array('width' => 220, 'height' => 220, 'name' => '{$file}.medium.{$ext}'),
			'large'	=> array('width' => 800, 'height' => 600, 'name' => '{$file}.large.{$ext}')
		),
		'dir' => '{APP}uploads{DS}{$class}{DS}{$foreign_id}',
		'nameCleanups' => array(
			//'/&(.)(tilde);/' => "$1y", // ñs
			//'/&(.)(uml);/' => "$1e", // umlauts but umlauts are not pronounced the same is all languages.
			//'/�/' => 'ss', // German double s
			//'/&(.)elig;/' => '$1e', // ae and oe symbols
			//'/�/' => 'eth' // Icelandic eth symbol
			//'/�/' => 'thorn' // Icelandic thorn
			
			'/&(.)(acute|caron|cedil|circ|elig|grave|horn|ring|slash|th|tilde|uml|zlig);/' => '$1', // strip all
			'decode' => true, // html decode at this point
			'/\&/' => ' and ', // Ampersand
			'/\+/' => ' plus ', // Plus
			'/([^a-z0-9\.]+)/' => '_', // None alphanumeric
			'/\\_+/' => '_' // Duplicate sperators
		)
	);

	function setup(&$model, $config=array()) {
		$settings = am ($this->__defaultSettings, $config);
		uses('folder');
		$this->settings[$model->name] = $settings;	
	}
	
	function beforeSave(&$model) {
		extract ($this->settings[$model->name]);
		// Check for upload
		if(!isset($model->data[$model->name][$field])) {
		 	return true;      
		}
		pr($model->data[$model->name]);
		// Check it's a file submission
		if (!is_array($model->data[$model->name][$field])) {
			pr ('not an array');
			return false;
		}
		// Check error
		if($model->data[$model->name][$field]['error'] > 0) {
			pr ($model->data);
			pr ('error in upload data');
			return false;
		}
		// Check mime
		if(count($allowedMime) > 0 && !in_array($model->data[$model->name][$field]['type'], $allowedMime)) {
			pr ('error in mime type');
			return false;
		}
		// Check extensions
		$parts = explode('.', low($model->data[$model->name][$field]['name'])); 
		$extension = array_pop($parts);
		$filename = implode('.', $parts);
		if(count($allowedExt) > 0 && !in_array($extension, $allowedExt)) {
			pr ('error with extension '. $extension);
			return false;
		}
		// Get filename
		$filename = $this->_getFilename($model, $filename, $extension, $randomFilenames);
		$model->data[$model->name][$field]['name'] = $filename.'.'.$extension;
		// Get file path
		$dir = $this->_getPath($model, $dir);
		if (!$dir) {
			pr ('couldn\'t determine or create directory');
			return false;
		}
		// Create final save path
		$saveAs = $dir . DS . $model->data[$model->name][$field]['name'];
		// Check if file exists
                if(file_exists($saveAs)) {
                	if(!$settings['overwrite_existing'] || !unlink($saveAs)) {
				$model->data[$model->name][$field]['name'] = uniqid("") . $extension;
                		$saveAs = $dir . DS . $model->data[$model->name][$field]['name'];
                    	}
                } 
				
		// Attempt to move uploaded file
		if(!move_uploaded_file($model->data[$model->name][$field]['tmp_name'], $saveAs)) {
			pr ('could not move file');
			return false;
		}
		
		// Create thumbnail of uploaded image
		// This is hard-coded to only support JPEG + PNG at this time
		// Code unable to handle other formats
		if (count($allowedExt) > 0 && in_array($model->data[$model->name][$field]['type'], array('image/jpeg', 'image/pjpeg', 'image/png'))) {
			foreach ($thumbsizes as $key => $value) {
				$thumbName = $this->getThumbname ($model,$key, $filename, $extension);
				$this->createthumb($model, $saveAs, $dir . DS . $thumbName, $value['width'], $value['height']);
			}
		}
		
		// Update model data
		$model->data[$model->name]['dir'] = str_replace(ROOT . DS . APP_DIR . DS, '', $dir);
		$model->data[$model->name]['mimetype'] =  $model->data[$model->name][$field]['type'];				
		$model->data[$model->name]['filesize'] = $model->data[$model->name][$field]['size'];
		$model->data[$model->name][$field] = $model->data[$model->name][$field]['name'];
	}
	
	// FIXME: This currently does not delete images :(
	function beforeDelete(&$model) {
		extract ($this->settings[$model->name]);
		if ($model->hasField('dir')) {
			$data = $model->read(array('dir',$field));
			$dir = ROOT . DS . APP_DIR . DS . $data[$model->name]['dir'];
			$filename = $data[$model->name][$field];
		} else {
			$filename = $model->field($field);
		}
		if (file_exists($dir . DS . $filename) && !unlink($dir . DS . $filename)) {
			return false;
		}

		foreach ($thumbsizes as $size => $_details) {
			$thumbname = $this->getThumbname($model, $size, $filename);
			if (file_exists($dir . DS . $thumbname) && !unlink($dir . DS . $thumbname)) {
				return false;
			}
		}
        	return true;
    	}
	
	// Function to create thumbnail image
	function createthumb(&$model, $name, $filename, $new_w, $new_h) {
		$system = explode(".", $name);
		if (preg_match("/jpg|jpeg/i", $system[3])) {
			$src_img = imagecreatefromjpeg($name);
		}
          
		if (preg_match("/png/i", $system[3])) {
			$src_img = imagecreatefrompng($name);
		}
        
		$old_x = imagesx($src_img);
        	$old_y = imagesy($src_img);
		$model->data[$model->name]['width'] = $old_x;
		$model->data[$model->name]['height'] = $old_y;
		
		if (($old_x < $new_w) || ($old_y < $new_h)) {
			return false;
		}
		if ($old_x >= $old_y) {
			$thumb_w = $new_w;
			$ratio = $old_y / $old_x;
			$thumb_h = $ratio * $new_w;
		} else if ($old_x < $old_y) {
			$thumb_h = $new_h;
			$ratio = $old_x / $old_y;
			$thumb_w = $ratio * $new_h;
		}

        	$dst_img = imagecreatetruecolor($thumb_w, $thumb_h);
        	imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
        
        	if (preg_match("/png/", $system[1])) {
        		imagepng($dst_img, $filename);
        	} else {
            		imagejpeg($dst_img, $filename);
        	}
        	imagedestroy($dst_img);
		imagedestroy($src_img);
	}

	function getThumbname ($model, $thumbsize, $filename, $extension = null) {
		if ($extension == null ) {
			$parts = explode('.', low($filename)); 
			$extension = array_pop($parts);
			$filename = implode('.', $parts);
		}	
		extract ($this->settings[$model->name]['thumbsizes'][$thumbsize]);
		if (strpos($name, '{') === false) {
			return $name.$filename.'.'.$extension;
		}
		$markers = array('{$file}', '{$ext}');
		$replace = array( $filename, $extension);
		return str_replace($markers, $replace, $name);
	}

	function getThumbSizes(&$model, $size = null) {
		extract($this->settings[$model->name]);
		if ($size) {
			return $thumbsizes[$size];
		}
		return $thumbsizes;
	}
	function initDir(&$model, $dirToCheck = null) {
		extract($this->settings[$model->name]);
		if ($dirToCheck) {
			$dir = $dirToCheck;
		}
		// Check if directory exists and create it if required
		if(!is_dir($dir)) {
			if($create_directory && !$this->Folder->mkdirr($dir)) {
				unset($config[$field]);
				unset($model->data[$model->name][$field]);
			}
		}
		// Check if directory is writable
		if(!is_writable($settings['dir'])) {
			unset($config[$field]);
			unset($model->data[$model->name][$field]);
		}
		// Check that the given directory does not have a DS on the end
		if($settings['dir'][strlen($settings['dir'])-1] == DS) {
			$settings['dir'] = substr($settings['dir'],0,strlen($settings['dir'])-2);
		}
	}

	function _getFilename($model, $string) {
		extract ($this->settings[$model->name]);
		if ($randomFilenames) {
			return uniqid(""); 
		}
		$string = htmlentities(low($string), null, 'UTF-8');
		foreach ($nameCleanups as $regex => $replace) {
			if ($regex == 'decode') {
				$string = html_entity_decode($string);			
			} else {
				$string = preg_replace($regex, $replace, $string);
			}
		}
		return $string;
	}

	function _getPath ($model, $path) {
		extract ($this->settings[$model->name]);
		if (strpos($dir,'{') === false) {
			return $dir;
		}
		$markers = array('{APP}', '{DS}','{$class}','{$foreign_id}');
		$replace = array( APP, DS, $model->data[$model->name]['class'], $model->data[$model->name]['foreign_id']);
		$folderPath = str_replace ($markers, $replace, $path);
		new Folder ($folderPath, true);
		return $folderPath;
	}
}
?>