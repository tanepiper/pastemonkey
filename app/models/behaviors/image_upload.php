<?php
require_once('upload.php');
class ImageUploadBehavior extends UploadBehavior {

	function setup (&$model, $config=array()) {
		// Overriding defaults
		$this->__defaultSettings['allowedMime'] = array('image/jpeg', 'image/gif', 'image/png', 'image/bmp');
		$this->__defaultSettings['allowedExt'] = array('jpeg', 'jpg', 'gif', 'png', 'bmp');
		parent::setup($model, $config);
	}

	function _afterProcessUpload(&$model, $data, $direct) {
		list($width, $height) = getimagesize($model->absolutePath());
		$model->data[$model->name]['width'] = $width;
		$model->data[$model->name]['height'] = $height;
		return true;
	}

	function _beforeProcessUpload(&$model, $data, $direct) {
		return true;
	}
	
	function resize(&$model, $id=null, $width = 600, $height = 400, $writeTo = false, $aspect = true) {
		if ($id === null && $model->id) {
			$id = $model->id;
		} elseif (!$id) {
			$id = null;
		}
		extract($this->settings[$model->name]);
		$readResult = $model->read(array($fileField, $dirField), $id);
		extract($readResult[$model->name]);		
		$fullPath = $baseDir . $$dirField . DS . $$fileField;
		return $this->resizeFile($model, $fullPath, $width, $height, $writeTo, $aspect);
	}

	function resizeFile(&$model, $fullpath, $width = 600, $height = 400, $writeTo = false, $aspect = true) {
		if (!$width||!$height) {
			return false;
		}
		extract($this->settings[$model->name]);
		if (!($size = getimagesize($fullpath))) { 
			return false; // image doesn't exist
		}
		list($currentWidth, $currentHeight, $currentType) = $size;

		// adjust to aspect.
		if ($aspect) { 
			if (($currentHeight/$height) > ($currentWidth/$width)) {
				$width = ceil(($currentWidth/$currentHeight) * $height);
			} else { 
				$height = ceil($width / ($currentWidth/$currentHeight));
			}
		}
		$types = array(1 => "gif", "jpeg", "png", "swf", "psd", "wbmp");
		$image = call_user_func('imagecreatefrom'.$types[$currentType], $fullpath);

		if (function_exists("imagecreatetruecolor") && ($temp = imagecreatetruecolor ($width, $height))) {
			imagecopyresampled ($temp, $image, 0, 0, 0, 0, $width, $height, $currentWidth, $currentHeight);
  		} else {
			$temp = imagecreate ($width, $height);
			imagecopyresized ($temp, $image, 0, 0, 0, 0, $width, $height, $currentWidth, $currentHeight);
		}
		
		$return = false;
		if ($writeTo) {
			uses('File');
			new File($writeTo, true);
			if (call_user_func("image".$types[$currentType], $temp, $writeTo)) {
				$return = true;
			}
		} else {
			ob_start();
			call_user_func("image".$types[$currentType], $temp);
			$return = ob_get_clean();		
		}
		imagedestroy ($image);
		imagedestroy ($temp);
		return $return;
	}
}
?>
