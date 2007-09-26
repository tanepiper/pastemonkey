<?php
/* SVN FILE: $Id$ */

/**
 * AttachmentsController
 *
 * Handels the upload, thumbnailing and validation of attachments
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
 *
 *
 *
 *
 *
 *
 *
 * @todo Update to work with jquery UI uploader
 * @todo Update to use cake Configure Class
 */
class AttachmentsController extends AppController {

	var $name = 'Attachments';
	var $helpers = array( 'Html' , 'Form' , 'Javascript' );
	var $components  = array( 'RequestHandler' , 'Session' , 'MitThumb');


	var $max_cache_age = 7776000; #90 days in seconds

	/**
	 * Renders the appropreate thumbnail for an attachement
	 * 
	 * If the attachment is an image, it generates a thumbnail.
	 * ELSE
	 * If the attachment is of a expected mimetype it will use an appropreate image from WWW_ROOT/files/attachments/
	 * ELSE
	 * If there is a image matching the mime type image/jpeg -> image_jpeg.png in WWW_ROOT/files/attachments/ that will be used
	 * ELSE
	 * It will display WWW_ROOT/files/attachments/default.png
	 *
	 * @param  	string 	$id_and_name	attachement id
	 * @param	bool		$force_update	force updateing of the cached image
	 */
	function thumbnail( $id_and_name , $force_update = false ){
		Configure::write( 'debug', 0 );
		$image = false;

		list( $id , $name ) = explode( '_' , $id_and_name , 2 );

		$attachment = $this->Attachment->read( null , $id);

		if( !empty( $attachment ) ){
			$mime_type = $attachment['Attachment']['mime_type'];
			switch( $mime_type ){
				case ( preg_match( "/image/", $mime_type ) ? $mime_type : !$mime_type ) :
					$image =  $this->MitThumb->displayThumbnail( $attachment['Attachment']['body'] , $force_update );
					break;
				case ( preg_match( "/video/" , $mime_type ) ? $mime_type: !$mime_type ) :
					$this->MitThumb->displayThumbnail( 'files/attachments/video.png' , $force_update );
					break;
				case ( preg_match( "/audio/" , $mime_type ) ? $mime_type: !$mime_type ) :
					$this->MitThumb->displayThumbnail( 'files/attachments/audio.png' , $force_update );
					break;
				case ( preg_match( "/msword|vnd.oasis.opendocument.text|vnd.sun.xml.writer/" , $mime_type ) ? $mime_type: !$mime_type ) :
					$this->MitThumb->displayThumbnail( 'files/attachments/document.png' , $force_update );
					break;
				case ( preg_match( "/excel|vnd.oasis.opendocument.spreadsheet|vnd.sun.xml.calc/" , $mime_type ) ? $mime_type: !$mime_type ) :
					$this->MitThumb->displayThumbnail( 'files/attachments/spreadsheet.png' , $force_update );
					break;
				case ( preg_match( "/compressed|zip/" , $mime_type ) ? $mime_type: !$mime_type ) :
					$this->MitThumb->displayThumbnail( 'files/attachments/package.png' , $force_update );
					break; 
				case ( preg_match( "/text/" , $mime_type ) ? $mime_type: !$mime_type ) :
					$this->MitThumb->displayThumbnail( 'files/attachments/text.png' , $force_update );
					break;
				default:
					if( is_file( WWW_ROOT . 'files/attachments/' . str_replace('/','_', $mime_type) . '.png' ) ){
						echo $this->MitThumb->displayThumbnail( 'files/attachments/' . str_replace('/','_', $mime_type) . '.png' , $force_update );
					} else {
						echo $this->MitThumb->displayThumbnail( 'files/attachments/default.png' , $force_update );
					}
			}
		} else {
			echo 'UNKNOWN ATTACHMENT';
		}

		if($image == false) {
			$this->MitThumb->printErrors();
		}

		die();
	}


	/**
	 * Shows the uploaded file
	 * 
	 * Displays the attachment based on its mime type.
	 * 
	 * 
	 * @param  	string 	$id_and_name	attachement id 
	 */
	function show( $id_and_name = null){
		$this->layout = 'ajax';
		
		list( $id , $name ) = explode( '_' , $id_and_name , 2 );

		$attachment = $this->Attachment->read( null , $id);

		if( !empty( $attachment ) ){
			
			$ext = str_replace('/','_', $attachment['Attachment']['mime_type']);
			$view = Inflector::pluralize(low($attachment['Attachment']['model']));
			$group = low($attachment['Attachment']['group']);
			
			$this->set('attachment', $attachment);
			
			if( is_file( VIEWS . '/attachments/' . $group . '/' . $ext . '.ctp' ) ){
				//show using group / type from owner controller
				$this->render( '../' . $view . '/attachments/' . $group . '/' . $ext );
				
			} else if( is_file( VIEWS . $view . '/attachments/' . $ext . '.ctp' ) ){
				//show using type from owner controller
				$this->render( '../' . $view . '/attachments/' . $ext);
				
			} else if( is_file( VIEWS . $view . '/attachments/' . $group . '.ctp' ) ){
				//show using group  owner controller
				$this->render( '../' . $view . '/attachments/' . $group );

			} else if( is_file( VIEWS . 'attachments/' . $ext . '.ctp' ) ){
				//show using type from attachments controlle
				$this->render( $ext );
				
			} else {
				//show using generic
				//$this->layout = 'show'
			}
		} else {
			echo 'UNKNOWN ATTACHMENT';
		}

	}



	/**
	 * This is an upload processor for the SWFupload system,
	 * but it falls back to normal HTML upload.
	 *
	 * @return  true or error message
	 */
	function upload() {
		Configure::write( 'debug' , 0 );
		$this->cleanUpFields();

		//set user who uploaded the file
		$this->params[ 'form' ][ 'user_id' ] = -1;

		$uploaded = $this->Attachment->save_upload( $this->params[ 'form' ] );

		//check if its flash doing the uploading
		if( $this->Session->__isFlashAgent() ) {

			if( $uploaded === true ) {
				echo( 'true' );
			} else {
				echo( $uploaded );
			}

			//hack but its quick and easy way to not need a layout or view
			die();
		} else {
			if( $uploaded !== TRUE ) {
				$this->Session->setFlash( $uploaded );
			}else{
				$this->Session->setFlash( __( 'The attachement has been saved' , true ) );
			}
			$this->redirect( $this->referer() , null , true );
		}
	}


	/*	Update Index gets a new list of the linked files, mainly used
	 * for ajax
	 *
	 * @param	$model		Linked model
	 * @param	$model_id	Id of linked model
	 * @param	$type			Assocation type
	 */
	function get_index( $model = null , $model_id = null , $group = 'file' ){
		if( $model == null OR $model_id == null ){
			return null;
		}

		//set conditions
		$conditions[ 'Attachment.model' ] = $model;
		$conditions[ 'Attachment.model_id' ] = $model_id;
		$conditions[ 'Attachment.group' ] = $group;

		$this->Attachment->recursive = 1;
		$this->data = $this->Attachment->findAll( $conditions , '*' , 'Attachment.order ASC' );

		if( isset( $this->params[ 'requested' ] ) ) {
			return $this->data;
		}
	}

	function edit( $id = null ) {
		if ( !$id && empty( $this->data ) ) {
			$this->Session->setFlash( __('Invalid attachement' , true ) );
			$this->redirect( array( 'action'=>'index' ) , null , true );
		}
		if ( !empty( $this->data ) ) {
			$this->cleanUpFields();

			if( $this->data['Attachment']['referer'] == $this->referer() ) {
				$this->data['Attachment']['referer'] = '/';
			}

			if ( $this->Attachment->save( $this->data ) ) {
				$this->Session->setFlash( __( 'The attachement saved' , true ) );
				$this->redirect( $this->data[ 'Attachment' ][ 'referer' ] , null , true );
			} else {
				$this->Session->setFlash( __( 'The attachement could not be saved. Please, try again.' , true ) );
			}
		}
		if ( empty( $this->data ) ) {
			$this->data = $this->Attachment->read( null , $id );
		}
		if( !isset( $this->data[ 'Attachment' ][ 'referer' ] ) OR  $this->data[ 'Attachment' ][ 'referer' ] = '' ){
			$this->data[ 'Attachment' ][ 'referer' ] = $this->referer();
		}
	}

	function delete($id = null, $referer = null) {
		if( $referer == null ) $referer = $this->referer();

		if ( !$id ) {
			$this->Session->setFlash( __('Invalid id for' , true ) . ' ' .  __( 'attachement' , true ) );
			$this->redirect( $this->referer() , null , true );
		}
		$file = $this->Attachment->read( null , $id );
		if ($this->Attachment->del( $id , true ) ) {
			unlink( $file[ 'Attachment' ][ 'body' ] );
			$this->Session->setFlash( __( 'Attachement' , true ) . ' ' . __( 'deleted' , true ) );
			$this->redirect( $this->referer() , null , true );
		}
	}

	function clearCache(){
		die( $this->MitThumb->clearCache() );
	}
}
?>