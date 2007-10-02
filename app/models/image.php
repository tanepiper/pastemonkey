<?php 
include_once('attachment.php');
class Image extends Attachment {
	var $name = 'Image';
	var $useTable = 'attachments';

	var $actsAs = array(
		'ImageUpload'
	);
}
?>
