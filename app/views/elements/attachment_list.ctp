<?php
/* SVN FILE: $Id$ */

/**
 *	Admin view for uplaoded files.
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

if(!isset($list) AND (isset($model) AND isset($model_id) AND isset($group))){
	$list = $this->requestAction("/attachments/get_index/$model/$model_id/$group");
}

if(!empty($list)){
?>

<ul id="attachments_<?php echo $list[0]['Attachment']['model'] .'_'. $list[0]['Attachment']['model_id'] . '_' .$list[0]['Attachment']['group']; ?>">
<?php 
$count = 0;
foreach($list as $key=>$file){
	echo '<li>';
	echo $html->link($this->renderElement('attachment_thumbnail', array('id_name'=>$file['Attachment']['id'].'_image', 'thumbOptions'=>array('h'=>100,'w'=>100))),
							'/attachments/show/' . $file['Attachment']['id'] . '_' . $file['Attachment']['title'], array( 'title'=>$file['Attachment']['title'] ), null, false);
	echo $html->link(__('Edit', true), array('action'=>'edit', 'controller'=>'attachments', $file['Attachment']['id']));
	echo (' / ');
	echo $html->link(__('Delete', true), array('action'=>'delete', 'controller'=>'attachments',  $file['Attachment']['id']), null, __('Are you sure you want to delete this file', true).'?');
	echo ('<br/>');
	if(count($list) > 1) {
		echo ('<div class="mod_position">Position : ');
		if($count != 0)
			echo $html->link('+',array('action'=>'move_up', 'controller'=>'attachments', $file['Attachment']['id'])) . ' ';
		if($count + 1 != count($list))
			echo $html->link('-',array('action'=>'move_down', 'controller'=>'attachments', $file['Attachment']['id']));
		echo ('</div>');
	}
	
	echo "</li>\n";
	$count += 1;
}
?>


</ul>
<?php
}
?>