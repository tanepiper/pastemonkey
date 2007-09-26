<?php
/**
 * MitThumbComponent - A CakePHP Component to use with a MIT based Thumbnailer
 * 
 * Copyright (C) 2007-2008 Alex McFadyen aka Drayen
 * acmConsulting <www.acmconsulting.eu>
 *
 * @license MIT
 */

/* SVN FILE: $Id$ */

/**
 * MitThumbComponent - A CakePHP Component to use with PHP Thumbnailer 
 * (http://www.gen-x-design.com/projects/php-thumbnailer-class/)
 * 
 * This component will allow you to create/display thumbnails as well as have them
 * auto generated and cached.
 *
 * PHP versions 4 and 5
 *
 * acmConsulting <www.acmconsulting.eu>
 *
 * Copyright 2006-2008, acmConsulting
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @author 			Alex McFadyen (alex@acmconsulting.eu)
 *
 * @copyright		Copyright 2006-2008, acmConsulting
 * @link				http://www.acmconsulting.eu acmConsulting
 *
 * @package    	app
 * @subpackage		controllers.component
 *
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 *
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class MitThumbComponent extends Component{

	/**
	 * Array of errors
	 */
	var $errors = array();
	
	/**
	 * preset $_GET string varables, also defines what can be passed in the get string
	 */

	var $presets = array(
								'fmt'=>'JPG', 		// Format (JPG,GIF,PNG)
								'w'=>null,     	// Width
								'h'=>null,			// Height
								'q'=>75,				// jpeg output Quality
								'zc'=>0,				// Zoom Crop
								'cx'=>null,			// Crop top-left X position
								'cy'=>null,			// Crop top-left Y position
								'cc'=>null,			// Crop from Center 
								'cw'=>null,			// Crop Width
								'ch'=>null,			// Crop Height
								'far'=>1,			// Fixed Aspect Ratio
								'deg'=>null,		// DEGrees to rotate
								'ar'=>null,			// Auto Rotate X=based on exif data, L=always landscape, P=portrait
								'bc'=>null,			// Border Color
								'bg'=>'FFFFFF',	// Background Colour
								'flp'=>null,			// Flip the image (x or y)
								'mrr'=>null,		// Add mirror effect
								);
	
	/**
	 * The mime types that are allowed for images
	 */
	var $allowed_mime_types = array(IMAGETYPE_JPEG,IMAGETYPE_GIF,IMAGETYPE_PNG);

	/**
	 * File system location to save thumbnails to.  
	 */
	var $cache_location = null;

	/**
	 * How old the cached image can be before old files are over written.
	 */
	var $max_cache_age = 1; #7776000; #90 days in seconds
	

	var $controller;
	var $model;

	function startup( &$controller ) {
		$this->controller = &$controller;
		if(isset($controller->max_cache_age)){
			$this->max_cache_age = $controller->max_cache_age;
		}		
		$this->cache_location = CACHE.'thumbs'.DS;
		
		if(!is_dir($this->cache_location)) {

			if (!class_exists('Folder')) {
				uses ('folder');
			}
				
				//check the folder exsists
			$folder = new Folder( $this->cache_location, true, 764 );
			
			if( !empty( $folder->__errors ) ) die( print_r( $folder->__errors ) );
		}
	}


	
	/**
	 * Will generate a thumbnail as defined by the presets (or by $_GET vars)
	 * and place it in the target. If display = true it will also output the 
	 * thumbnail.
	 * 
	 * @param string $source the location of the source image (may be relative or absolute)
	 * @param string $target the target directory and filename for the generated thumbnail
	 * @param bool $overwrite if the target should be overwritten
	 * @param bool $display if the image should be displayed
	 * @return bool Success?
	 * @author Alex McFadyen (acmConsutling.eu)
	 */
	function generateThumbnail($source = null, $target = null, $overwrite = true, $display = false){
		$target_dir = substr($target, 0, -(strpos(strrev($target),'/')));

		if($source == null OR $target == null){//check correct params are set
			$this->addError("Both source[$source] and target[$target] must be set");
			return false;
		}elseif(!is_file($source)){//check source is a file
			$this->addError("Source[$source] is not a valid file");
			return false;
		}elseif(in_array($this->ImageTypeToMIMEtype($source), $this->allowed_mime_types)){//and is of allowed type
			$this->addError("Source[$source] is not a valid file type");
			return false;
		}elseif(!is_writable($target_dir)){//check if target directory is writeable
			$this->addError("Can not write to target directory [$target_dir]");
			return false;
		}elseif(is_file($target) AND !$overwrite){//check if target is a file already and not ok to be over written
			$this->addError("Target[$target] exsists and overwrite is not true");
			return false;
		}elseif(is_file($target) AND !is_writable($target)){
			$this->addError("Can not overwrite Target[$target]");
			return false;
		}
		
		//work out correct class to use
		$version = 4;
		if(PHP5) { 
			$version = 5;
		}
		
		//check mitThumb exsists !
		if(!is_file(ROOT.'/vendors/mitThumb/php'.$version.'_thumbnail/thumbnail.inc.php')){
			die('ERROR : There is no version of mitThumb apropreate for your install in vendors ('.ROOT.'/vendors/mitThumb/php'.$version.'_thumbnail/thumbnail.inc.php)! <br/> Download a copy from <a href="http://www.gen-x-design.com/projects/php-thumbnailer-class/">http://www.gen-x-design.com/projects/php-thumbnailer-class/</a>');
		}

		//load mitThumb
		vendor('mitThumb/php'.$version.'_thumbnail/thumbnail.inc');
		$mitThumb = new Thumbnail($source);
			
		//set quality if sent
		if(isset($_GET['q'])) {
			$this->presets['q'] = $_GET['q'];
		}
		
		/*
		//set format if sent
		if(isset($_GET['fmt'])) {
			$this->presets['fmt'] = $_GET['fmt'];
		}
		*/

		//resize
		if(isset($_GET['w']) OR isset($_GET['h'])) {
				$mitThumb->resize( $_GET['w'] , $_GET['h'] );
		}
		
		
		
		//create the thumbnail
		if($mitThumb->show($this->presets['q'], $target)){
			$this->addError('Could not render file to: '.$target);
		}elseif($display==true){
			$mitThumb->show($this->presets['q']);
			
			//newfile so clear cache of dead wood
			$this->clearCache();
			
			die();//not perfect, i know but it insures cake doenst add extra code after the image.
		} else {
			$this->addError('could not generate thumbnail');
		}

		// if we have any errors, remove any thumbnail that was generated and return false
		if(count($this->errors)>0){
			if(file_exists($target)){
				unlink($target);
			}
			print_r($this->errors);
			return false;
		} else return true;
	}
	
	
	
	/**
	 * Display and/or generate a auto-named thumbnail, based on presets in $_GET.
	 *
	 * @param string $source the location of the source image (may be relative or absolute)
	 * @param bool $forceUpdate if the thumbnal should be refreashed
	 * @param bool $display if the image should be displayed
	 * @return bool Success?
	 * @author Alex McFadyen (acmConsutling.eu)
	 */
	function displayThumbnail($source, $forceUpdate = false, $display = true){
		if($source == null) $source = $_GET['src'];

		$cache_filename = $this->cache_location . md5(env('REQUEST_URI') + $source + filesize($source) ).'.jpg';
	
		#check the cache'ed image exsists and its new enough and that it needs to be displayed
		if(is_file($cache_filename) //file exsists
				AND (time() < filectime($cache_filename) + $this->max_cache_age) //not too old
				AND (is_file($source) ? ( filectime($cache_filename) > filectime($source) ) : true) //cached image is newer than source
				AND ($display == true) 
				AND !($forceUpdate == true)) 
			{

			header('Content-Type: '.IMAGETYPE_JPEG);
			@readfile($cache_filename);

			exit();//not perfect, i know but it insures cake doenst add extra code after the image.
		}else{
			return $this->generateThumbnail($source, $cache_filename, true, $display);
		}
	}
	
	/**
	 * Function borrowed form phpThumb libs
	 */
	function ImageTypeToMIMEtype($imagetype) {
		if (function_exists('image_type_to_mime_type') && ($imagetype >= 1) && ($imagetype <= 16)) {
			// PHP v4.3.0+
			return image_type_to_mime_type($imagetype);
		}
		static $image_type_to_mime_type = array(
			1  => 'image/gif',                     // IMAGETYPE_GIF
			2  => 'image/jpeg',                    // IMAGETYPE_JPEG
			3  => 'image/png',                     // IMAGETYPE_PNG
			4  => 'application/x-shockwave-flash', // IMAGETYPE_SWF
			5  => 'image/psd',                     // IMAGETYPE_PSD
			6  => 'image/bmp',                     // IMAGETYPE_BMP
			7  => 'image/tiff',                    // IMAGETYPE_TIFF_II (intel byte order)
			8  => 'image/tiff',                    // IMAGETYPE_TIFF_MM (motorola byte order)
			9  => 'application/octet-stream',      // IMAGETYPE_JPC
			10 => 'image/jp2',                     // IMAGETYPE_JP2
			11 => 'application/octet-stream',      // IMAGETYPE_JPX
			12 => 'application/octet-stream',      // IMAGETYPE_JB2
			13 => 'application/x-shockwave-flash', // IMAGETYPE_SWC
			14 => 'image/iff',                     // IMAGETYPE_IFF
			15 => 'image/vnd.wap.wbmp',            // IMAGETYPE_WBMP
			16 => 'image/xbm',                     // IMAGETYPE_XBM
	
			'gif'  => 'image/gif',                 // IMAGETYPE_GIF
			'jpg'  => 'image/jpeg',                // IMAGETYPE_JPEG
			'jpeg' => 'image/jpeg',                // IMAGETYPE_JPEG
			'png'  => 'image/png',                 // IMAGETYPE_PNG
			'bmp'  => 'image/bmp',                 // IMAGETYPE_BMP
			'ico'  => 'image/x-icon',
		);

		return (isset($image_type_to_mime_type[$imagetype]) ? $image_type_to_mime_type[$imagetype] : false);
	}
	
	/**
	 * Clears the current set cache directory of expired files (or all) images
	 *
	 * @param bool $clearAll if set, it will clear all the files in the cache directory
	 * @return bool true
	 * @author Alex McFadyen (acmConsutling.eu)
	 */
	function clearCache($clearAll = false){
		$files = glob($this->cache_location.'*');
		foreach($files as $file) {
			if($clearAll == 'S3tfc32d2s12' OR time() > (filemtime($file) + $this->max_cache_age)) {
				unlink($file);
			}
		}

		return true;
	}

	function addError($msg){
		$this->errors[] = $msg;
	}
	
	function printErrors(){
		echo("<pre>---------------------\n\n");
		echo("mitThumb component - error array : \n\n");
		print_r($this->errors);	
		echo("\n\n---------------------</pre>");
	}
}
?>