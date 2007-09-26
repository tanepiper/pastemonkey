<?php
/* SVN FILE: $Id$ */

/**
 * Attachments Behaviour
 *
 * [[Detail]]
 *
 * PHP versions 5
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
 * @subpackage		models
 *
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 *
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Attachment extends AppModel {


	var $name = 'Attachment';
	var $validate = array();
	
	var $actsAs = array('List' => array('field'=>'order','position'=>'bottom','groups'=>array('model','model_id','group')));
	
	/**
	 * Base dir where uploaded files are stored
	 */
	var $uploadbase = array(WWW_ROOT, 'files/attachments/');
	
 	/**
	  * Array containing the basic settings for each of the group types. If none set for the group, everything is just allowed.
	  * Copy this var to the owner model and customise to your needs.
	  *
	  * @var $attachment_validation
	  * @access public
	  */
	var $attachment_validation = array(
		'image'=>array(
			/**
			 * Count, validaiton methods for limiting the amount of attachments in this group
			 * 
			 * If not set, unlimited upload allowed
			 * 
			 * TODO: update exsample to use Validation::number when its implmented
			 */
			//'count'=>array( 
			//				'numer_of_uploads' => array(
			//											'rule' => array( 'custom', '/[0-6]/' ), 
			//											'message'=>'Attachment limit reached, no attachment added' )
			//		),
					
			/**
			 * mime_types, validation on mime type. using a custom validatio method and key words
			 * 
			 * If not set, everything is allowed
			 */
			//'mime_type'=>array('mime_type' => array('rule' => array('custom', '/image\/jpeg|image\/gif/'),
			//								'message' => 'The attachment is not of the correct type' )
			//			),
			
			/**
			 * File validation
			 * 
			 * Function will be sent the location of the temp uploaded file. 
			 * 
			 * If not set, all files are valid
			 */
			'file_validation'=>array( 'valid_file'=>array(
										'rule' => array( VALID_NOT_EMPTY ),
										'message' => 'The file was not valid' )		
				),
			/**
			 * Filename validation
			 * 
			 * If not set, all files are valid
			 */
			'filename_validation'=>array( 'valid_filename'=>array(
										'rule' => array( VALID_NOT_EMPTY ),
										'message' => 'The file did not have a valid filename' )		
				),
			/**
			 * Filesize validation
			 * 
			 * If not set, all file sizes are valid. Size is in bytes, max size is restricted by 
			 * both the php.ini's max post size as well as an upper limit of 100mb which is due 
			 * to limitations in the swfupload method.
			 */
			'filesize_validation'=>array( 'valid_filesize'=>array(
										'rule' => array( VALID_NOT_EMPTY ),
										'message' => 'The file was not of a valid size' )		
				),
			
			/**
			 * Code validation
			 * 
			 * If not set, all code is valid
			 */
			'code_validation'=>array( 'valid_code'=>array(
										'rule' => array ( VALID_NOT_EMPTY ),
										'message'=> 'The code snipit was not of a valid type' )		
				),		
				

			
			/**
			 * Post processing.
			 * Funcitons called once the file / code is uploaded, validated and saved to the db, handy for
			 * situations where you want to create custom  thumbnails, watermark images, process video etc.
			 */	
				
			/**
			 * File processing
			 * 
			 * If not set, nothing is called.
			 * Each function name in the array is called  passing the $this->data just before its about to 
			 * be saved. The funciton should return $data which is then used as the new $this->data.
			 * 
			 *  (Functions can be in app_model.php or the model with the attachments) 
			 */
			//'file_beforesave' => array( 'postprocess_file' => 'custom_file_validation' ),
			
			/**
			 * Code processing
			 * 
			 * If not set, nothing is called.
	 		 * Each function name in the array is called  passing the $this->data just before its about to 
			 * be saved. The funciton should return $data which is then used as the new $this->data.
			 * 
			 *  (Functions can be in app_model.php or the model with the attachments) 
			 */
			//'code_beforesave' => array( 'postprocess_code' => 'function_name' ),	

			/**
			 * Other settings.
			 */

			/**
			 * Insert_position.
			 * Where in the list of attachments a new one is placed (top or bottom).
			 */
			'insert_position' => 'top',
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/*var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'counterCache' => ''),
	);*/

	
	/**
	 * Save_upload takes an swfupload or form upload and processes it
	 * 
	 * Returns true or an error message.
	 */
	function save_upload($data = null){
		if( $data == null ) $data = $this->data;
		
		//fast and dirty sainity checks
		if( $data == null ) return __('No data to save',true);
		if(!isset($data['model']) OR $data['model'] == '') return __('No model set',true);
		if(!isset($data['model_id']) OR $data['model_id'] == '') return __('No model_id set',true);
		if(!isset($data['group']) OR $data['group'] == '') return __('No group set',true);
		if(!isset($data['user_id']) OR $data['user_id'] == '') return __('No user_id set',true);
		
		//check if parent model exsists, so we can get model specific validaiton
		if( file_exists( MODELS . strtolower( $data['model'] )  .'.php' ) ){
			
			//setup relation
			$this->bindModel( array( 'belongsTo' => 
										array( $data['model'] 	=> array( 	'className' 	=> $data['model'],
																						'foreignKey' 	=> 'model_id',
																						'conditions'	=> '',
																						'fields' 		=> '',
																						'order' 			=> '',
																						'counterCache' => '')
										)
									)
								);
			
			$parent = $this->$data['model'];
			
			//grab the custom validation arrays
			if( isset( $parent->attachment_validation ) ) {
				$attachment_validation = $parent->attachment_validation;
			}		
		} else {
			return __( '"' . $data['model'] . '" model not found', true);
		}
		
		//check if specific parent model id exsists. 
		if($this->$data['model']->findCount( array( $data['model'] . '.id' => $data['model_id'] ) ) != 1) {
			return __($data['model'] . ' model id '.$data['model_id'].' not found', true); 
		}
		
		//if its an upload check the data uploaded ok
		if( is_array( $data['file'] ) ){
			switch ($data['file']['error']) {
				case UPLOAD_ERR_OK:
					break;
					case UPLOAD_ERR_INI_SIZE:
					return __('The attachement exceeds the upload_max_filesize directive',true) . ' ('.ini_get('upload_max_filesize').') php.ini.';
					break;
				case UPLOAD_ERR_FORM_SIZE:
					return __('The attachement exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',true);
					break;
				case UPLOAD_ERR_PARTIAL:
					return __('The attachement was only partially uploaded',true);
					break;
				case UPLOAD_ERR_NO_FILE:
					return __('No file was uploaded',true);
					break;
				case UPLOAD_ERR_NO_TMP_DIR:
					return __('The remote server has no temporary folder for file uploads',true);
					break;
				case UPLOAD_ERR_CANT_WRITE:
					return __('Failed to write file to disk',true);
					break;
				default:
					return __('Unknown File Error',true);
			} 
		} else if(!isset($data['code']) OR $data['code'] == ''){ //its a code submission, so check there is data to play with
			return __('No file or code data sent');			
		}
		
		//do model specific validaton
		if( isset($attachment_validation) AND isset($attachment_validation[$data['group']]) ) {
			$this->validate = $attachment_validation[$data['group']];
	
			//setup fields
			//count for checking upload limits
			$data['count'] = $this->findCount( array( 'model' => $data['model'], 'model_id' => $data['model_id'], 'group' => $data['group'], ) );
			
			//type for sainity checks and code or file _validation for full checks.
			if( is_array( $data['file'] ) AND isset($data['file']['type']) ){
				
				//slight problem, swfupload always set the mime typep to application/octet-stream, so we need to get it outself
				if($data['file']['type'] == 'application/octet-stream'){
					$data['file']['type'] = mime_content_type($data['file']['tmp_name']);
				} 
				$data['mime_type'] = $data['file']['type'];
				
				$data['file_validation'] = $data['file']['tmp_name'];
				$data['filename_validation'] = $data['file']['name'] ;
				$data['filesize_validation'] = $data['file']['size'] ;
			} else if( isset( $data['code'] ) ) {
				$data['mime_type'] = 'CODE';
				$data['code_validation'] = $data['code'];
			} else {
				return __('Uploaded file is not in the expected format', true);
			}
			
			$this->data = $data;
			
			//do the validation
			if( !$this->validates() ){
				//return first / last error?
				return array_pop($this->validationErrors);
			}			
		}

		//get data ready to save.
		if( !isset($data['id']) OR $data['id'] == '' ) {
			$data['id'] = String::uuid();
		} else {
			$this->id = $data['id'];
		}
		
		//files
		if( is_array( $data['file'] ) ){
				
			if (!class_exists('Folder')) {
				uses ('folder');
			}
			
			//check the folder exsists
			$folder = new Folder(  	implode( '' , $this->uploadbase )
											. $data['model'] . DS
											. $data['model_id'] . DS
											. $data['group'] . DS, true, 764);
												
			if( empty( $folder->__errors ) ){ 
				$filename = $folder->path . $data['id'] . '_'. $data['file']['name'];
				
				if(move_uploaded_file($data['file']['tmp_name'], $filename)){
					$data['body'] = $filename;
					$data['title'] = $data['file']['name'];
				} else {
					return __( 'Unable to move file, please check permissions' , true );
				}
			} else {
				return __( 'Unable to create folder structure, please check permissions ( ' . $folder->__errors[0] . ' )' , true );
			}
																			
		} else { //code snipit
			$data['body'] = $data['code'];
		}
		
		//set position
		if( isset( $attachment_validation ) AND isset( $this->validate['insert_position'] ) ) {
			$this->set_insert_possition($this->validate['insert_position']);
		}
		
		$this->data = null;
		$this->data['Attachment'] = $data;
		
		//message is now used instead of a direct return as we have moved the file out of temp onto the file structure
		$message = ''; 
		
		//do any pre save processing
		if( isset( $attachment_validation ) ) {
			
			if( isset( $this->validate['file_beforesave'] ) AND is_array( $data['file'] )){
				foreach($this->validate['file_beforesave'] as $function) {
					if(method_exists( $parent , $function )){
						$this->data = $parent->$function( $this->data );
					} else {
						$message =  __( 'Unable to find processing function "' . $function . '" in the "' . $parent->name . '" model' ,true );
					}
				}
			}
			
			if( isset( $this->validate['code_beforesave'] ) AND isset($data['code'])){
				foreach($this->validate['code_beforesave'] as $function) {
					if(method_exists( $parent , $function )){
						$this->data = $parent->$function( $this->data );
					} else {
						$message =  __( 'Unable to find processing function "' . $function . '" in the "' . $parent->name . '" model' ,true );
					}
				}
			}
		}
		
		//get saving
		if( !$this->save() ){
			$message = __( 'Unable to save to the database' , true );
			die();
		}
		
		
		if($message != '' AND is_file( $data['body'] )){
					unlink($data['body']);
					return $message;
		} else {
			//check for old uploaded files and remove them.
			$oldFiles = glob( implode( '' , $this->uploadbase )
									. $data['model'] . DS
									. $data . DS
									. $data['group'] . DS . $data['id'] . '_*' );
			
			foreach( array_diff( $oldFiles , array( $data['id'] . '_' . $data['title'] ) ) as $oldFile ) {
				unlink( implode( '' , $this->uploadbase ) 
							. $data['model'] . DS
							. $data . DS
							. $data['group'] . DS . $oldFile);
			}
		}
		
		return true;
	}

	
	/**
	 * afterFind callback
	 * 
	 * Modified version of the work done by AD7six (AD7six.com) on this generic file upload behavior to 
	 * assocate the owning model to the attachent
	 *
	 * @param unknown_type $results
	 * @param unknown_type $primary
	 * @return unknown
	 */
	function afterFind ($results, $primary = false) {
		if (isset($results[0][$this->name]['model']) && $this->recursive > 0) {
			foreach ($results as $key => $result) {
				$associated = array();
				$class = $result[$this->name]['model'];
				$foreignId = $result[$this->name]['model_id'];
				if ($class && $foreignId) {
					$result = $result[$this->name];
					if (!isset($this->$class)) {
						$this->bindModel (array('belongsTo' => array ($class)));
					}
					$associated = $this->$class->find(array($class.'.id'=>$foreignId),null,null,-1);
					$results[$key][$class] = $associated[$class];
				}
			}
		}
		return $results;
	}
	
	
}
?>