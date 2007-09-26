<?php 
/* SVN FILE: $Id$ */

/**
 * SWF Upload for for uploaded_files.
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
 * @subpackage		views.elements
 *
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 *
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

$uploader_name = 'swf_upload_'.$model.'_'.str_replace('-','',$model_id).'_'.$group;



/*
 * Setting default values
 */
if(!isset($title)) $title = 'Upload';
if(!isset($id)) $id = '';
if(!isset($file_types)) $file_types = '*.*';
if(!isset($file_types_description)) $file_types_description = 'All Files';
if(!isset($file_size_limit)) $file_size_limit = '10240';
if(!isset($file_upload_limit)) $file_upload_limit = 0;
if(!isset($file_queue_limit)) $file_queue_limit = 0;
if(!isset($begin_upload_on_queue)) $begin_upload_on_queue = 'true';
if(!isset($use_server_data_event)) $use_server_data_event = 'true';

$javascript->cacheEvents(false, true);
echo $javascript->codeBlock(); ?>
var <?php echo $uploader_name; ?> = null;

$pastemonkey(document).ready(function() {

	// Check to see if SWFUpload is available
	if (typeof(SWFUpload) === "undefined"){
		alert('Error - SWFobject javascript not loaded');
		return false;
	}

	//check to disable this when its not on Windows. //|| navigator.platform.indexOf("Mac")!=-1
 	if(navigator.platform.indexOf("Win")!=-1 || navigator.platform.indexOf("Mac")!=-1){
		
		<?php echo $uploader_name; ?> = new SWFUpload({
			// Backend Settings
			upload_target_url: "/admin/attachments/upload/?<?php echo session_name() . "=" . session_id(); ?>",	// Relative to the SWF file
			post_params: {	"id" : "<?php echo $id; ?>", 
								"model" : "<?php echo $model; ?>", 
								"model_id" : "<?php echo $model_id; ?>", 
								"group" : "<?php echo $group; ?>"},
			file_post_name: "file",
			
			
			// File Upload Settings
			file_size_limit : "<?php echo $file_size_limit; ?>",	// 25MB
			file_types : "<?php echo $file_types; ?>",
			file_types_description : "<?php echo $file_types_description; ?>",
			file_upload_limit : "<?php echo $file_upload_limit; ?>",
			file_queue_limit : "<?php echo $file_queue_limit; ?>",
			begin_upload_on_queue : <?php echo $begin_upload_on_queue; ?>,
			use_server_data_event : <?php echo $use_server_data_event; ?>,

			// Event Handler Settings
			file_queued_handler : uploadStart,
			file_progress_handler : uploadProgress,
			file_cancelled_handler : uploadCancel,
			file_complete_handler : uploadComplete,
			queue_complete_handler : uploadQueueComplete,
			error_handler : uploadError,

			// Flash Settings
			flash_url : "/files/swfupload.swf",	// Relative to this file

			// UI Settings
			ui_container_id : "<?php echo $uploader_name; ?>_flashUI",
			degraded_container_id : "<?php echo $uploader_name; ?>_degradedUI",

			// Debug Settings
			debug: false
		});
		<?php echo $uploader_name; ?>.addSetting("progress_target", "<?php echo $uploader_name; ?>_fsUploadProgress");	// Add an additional setting that will later be used by the handler.
	}
});
<?php echo $javascript->blockEnd(); ?>

<form id="<?php echo $uploader_name; ?>_form" action="/attachments/upload" method="post" enctype="multipart/form-data">
<div id="<?php echo $uploader_name; ?>_flashUI" style="display: none;">
	<fieldset class="flash" id="<?php echo $uploader_name; ?>_fsUploadProgress">
		<legend><?php echo $title; ?></legend>
	</fieldset>
	<div>
		<input type="button" name='anyfile1' value="Upload file" onclick="<?php echo $uploader_name; ?>.browse()" style="font-size: 8pt;" />
		<input id="btnCancel1" type="button" value="Cancel Uploads" onclick="<?php echo $uploader_name; ?>.cancelQueue();" disabled="disabled" style="font-size: 8pt;" /><br />
	</div>
</div>

<div id="<?php echo $uploader_name; ?>_degradedUI">
	<fieldset>
		<input type='hidden' name='id' value='<?php echo $id; ?>' />
		<input type='hidden' name='model' value='<?php echo $model; ?>' />
		<input type='hidden' name='model_id' value='<?php echo $model_id; ?>' />
		<input type='hidden' name='group' value='<?php echo $group; ?>' />
		<legend><?php echo $title; ?></legend>
		<input type="file" name="file" /><br/><br/>
		<input type="submit" value="Send File" />
	</fieldset>
</div>
</form>