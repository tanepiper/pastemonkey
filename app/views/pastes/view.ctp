<div class="pastes">
	<h2><?php __('View Paste');?></h2>
	<div>
		<div class="infoarea">
			<table>
				<tr>
					<td><?php __('Author');?>:</td>
					<td><?php e($paste['Paste']['author']);?></td>
					<td><?php __('Language');?>:</td>
					<td><?php echo $html->link($paste['Language']['language'], array('controller'=> 'languages', 'action'=>'view', $paste['Language']['id'])); ?></td>
				</tr>
				<tr>
					<td><?php __('Date Posted');?>:</td>
					<td><?php echo $paste['Paste']['created']?></td>
					<td><?php __('Expires');?>:</td>
					<td><?php echo $paste['Paste']['expiry']?></td>
				</tr>
				<tr>
					<td><?php __('Tags');?>:</td>
					<td colspan="3">
						<?php foreach($paste['Tag'] as $tag) {
							e($html->link($tag['tag'], array('controller'=>'tags', 'action'=>'view', $tag['id'])) . ' ');
						} ?>
					</td>
				</tr>
				<tr>
					<td><?php __('Permalink');?>:</td>
					<td colspan="3"><?php e($html->link(SITE_URL . '/pastes/view/' . $paste['Paste']['id'],SITE_URL . '/pastes/view/' . $paste['Paste']['id']));?></td>
				</tr>
				<?php if (isset($paste['Paste']['parent_id'])) { ?>
				<tr>
					<td><?php e($html->link(__('View Parent', true),SITE_URL . '/pastes/view/' . $paste['Paste']['parent_id']));?></td>
					<td colspan="3"><?php e($html->link(__('Download Diff File', true),SITE_URL . '/pastes/diff/' . $paste['Paste']['parent_id'] . '/' . $paste['Paste']['id']));?></td>
				</tr>
				<?php } ?>
				<tr>
					<td><?php __('Note');?>:</td>
					<td colspan="3"><?php echo $paste['Paste']['note']?></td>
				</tr>
			</table>
		</div>
		<div>
			<div>
				<?php e($html->link(__('Download Code',true), array('controller'=> 'pastes', 'action'=>'download', $paste['Paste']['id']), array('class'=>'download')));?>
				<?php if ($paste['Language']['id'] == 33) {?>
					<?php e($html->link(__('Run Code in Firebug',true), '#', array('class'=>'eval-' . $paste['Paste']['id'])));?>
					<?php e($javascript->codeBlock('$pastemonkey(".eval-' . $paste['Paste']['id'] . '").bind("click", function(){var runeval = confirm("' . __('Warning<br />Running unknown scripts in your browser can be dangerous.  Please note that this site takes NO responibility for damage or loss of data that occurs through you running a bad script.', true) . '"); if (runeval == true) { console.log(eval($pastemonkey("#PasteCopy' . $paste['Paste']['id'] . '").text())); } return false;});'));?>
				<?php } ?>
			</div>
			<?php echo $paste['Paste']['paste_formatted']?>
		</div>
		<hr />
		<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['Paste']['paste'], 'id'=>'PasteCopy' . $paste['Paste']['id'], 'class'=>'PasteCopy')));?>
		<?php e($html->link(__('Select All Text', true), '#', array('id'=>'PasteCopyButton' . $paste['Paste']['id'])));?>
		<?php e($javascript->codeBlock('$pastemonkey("#PasteCopyButton' . $paste['Paste']['id'] . '").bind("click", function(){$pastemonkey("#PasteCopy' . $paste['Paste']['id'] . '").focus();$pastemonkey("#PasteCopy' . $paste['Paste']['id'] . '").select();return false;});'));?>
	</div>
	</div>
	<div class='attach_this'>
	<fieldset>
		<legend><?php __('Attachment');?></legend>
		
			<?php 
				$html->css('swf_upload', null, null, false);
				$javascript->link('swfobject', false);
				$javascript->link('swf_upload', false); 
				$javascript->link('swf_upload_functions', false); 
		
				echo $this->renderElement('attachment_form', array('model'=>'Paste','model_id'=>$paste['Paste']['id'],'group'=>'image', 'title'=>'Upload image'));
		
				echo $this->renderElement('attachment_list', array('model'=>'Paste','model_id'=>$paste['Paste']['id'],'group'=>'image'));
		?>	
	</fieldset>
	</div>
</div>