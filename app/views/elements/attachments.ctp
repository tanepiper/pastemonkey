<div id='thumbs'>
<?php
if (isset($thumbs) && is_array($thumbs)) {
	foreach ($thumbs as $thumb) {
		extract($thumb['Attachment']);
		echo '<div class=\'thumb\'>';
	      	echo $html->image('50x50/' . $dir . '/' . $filename, array('id' => 'thumb-' . $id, 'alt' =>  $description, 'title' =>  $description));
		echo '<ul class=\'menu\'>';
		echo '<li>' . $html->link('x', array('controller' => 'attachments', 'action' => 'delete', $id)) . '</li>';
		if ($thumb) {
			echo '<li>' . $html->link('quit thumb', array('controller' => 'attachments', 'action' => 'set_thumb',  $id, 0)) . '</li>';
		} else {
			echo '<li>' . $html->link('make thumb', array('controller' => 'attachments', 'action' => 'set_thumb',  $id, 1)) . '</li>';
		}
		echo '</ul>';
		echo '</div>';
	}
}
?>
</div>
<?php
if ($data[$modelClass]['id']) {
	echo $html->link('Add Pic', array('controller' => 'attachments', 'action' => 'add', $modelClass, $data[$modelClass]['id']));
} else {
	echo '<p>Save ' . $modelClass . ' to upload files/images.</p>';
}
?>

