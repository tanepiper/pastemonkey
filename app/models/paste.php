<?php
class Paste extends AppModel {

	var $name = 'Paste';
	var $validate = array(
		'paste' => VALID_NOT_EMPTY,
		'language_id' => VALID_NOT_EMPTY,
	);
	
	var $actsAs = array('Geshi', 'Tag'); 
	
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
	
	var $hasMany = array('ImageAttachments' =>
                         array('className'     => 'Attachment',
                               'conditions'    => 'ImageAttachments.model = "Project" AND ImageAttachments.group = "image"',
                               'order'         => 'ImageAttachments.order ASC',
                               'limit'         => '',
                               'foreignKey'    => 'model_id',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                         )
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
	
	/*function afterFind($results) {
		foreach ($results as $key => $val) {
			$tags = $this->Tag->findAll(array('PasteTag.paste_id'=>$val['Paste']['id']));
			pr($tags);
		}
	}
	
	function beforeSave($result) {
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