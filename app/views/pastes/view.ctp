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
					<td colspan="3"><?php echo $paste['Paste']['tags']?></td>
				</tr>
				<tr>
					<td><?php __('Permalink');?>:</td>
					<td colspan="3"><?php e(SITE_URL . '/pastes/view/' . $paste['Paste']['id']);?></td>
				</tr>
				<tr>
					<td><?php __('Note');?>:</td>
					<td colspan="3"><?php echo $paste['Paste']['note']?></td>
				</tr>
			</table>
		</div>
		<div>
			<div><?php e($html->link(__('Download Code',true), array('controller'=> 'pastes', 'action'=>'download', $paste['Paste']['id']), array('class'=>'download')));?></div>
			<?php echo $paste['Paste']['paste_formatted']?>
		</div>
		<hr />
		<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['Paste']['paste'], 'id'=>'PasteCopy' . $paste['Paste']['id'], 'class'=>'PasteCopy')));?>
		<?php e($html->link(__('Select All Text', true), '#', array('id'=>'PasteCopyButton' . $paste['Paste']['id'])));?>
		<?php e($javascript->codeBlock('$pastemonkey("#PasteCopyButton' . $paste['Paste']['id'] . '").bind("click", function(){$pastemonkey("#PasteCopy' . $paste['Paste']['id'] . '").focus();$pastemonkey("#PasteCopy' . $paste['Paste']['id'] . '").select();return false;});'));?>
	</div>
	</div>
</div>