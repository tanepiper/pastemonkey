<div class="pastes">
	<h2><?php __('View Paste');?></h2>
	<div>
		<div class="infoarea">
			<table>
				<tr>
					<td><?php __('Author');?>:</td>
					<td><?php e($paste['Paste']['author']);?></td>
					<td><?php __('Language');?>:</td>
					<td><?php echo $html->link($paste['Language']['language'], array('controller'=> 'languages', 'action'=>'view', $paste['Language']['id']), array('class'=>'ajaxLink')); ?></td>
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
							e($html->link($tag['tag'], array('controller'=>'tags', 'action'=>'view', $tag['id']), array('class'=>'ajaxLink')) . ' ');
						} ?>
					</td>
				</tr>
				<tr>
					<td><?php __('Permalink');?>:</td>
					<td colspan="3"><?php e($html->link(SITE_URL . '/pastes/view/' . $paste['Paste']['id'],SITE_URL . '/pastes/view/' . $paste['Paste']['id']));?></td>
				</tr>
				<?php if (isset($paste['Paste']['parent_id'])) { ?>
				<tr>
					<td><?php e($html->link(__('View Parent', true),array('controller'=>'pastes', 'action'=>'view', $paste['Paste']['parent_id']), array('class'=>'ajaxLink')));?></td>
					<td colspan="3"><?php e($html->link(__('Download Diff File', true),array('controller'=>'pastes', 'action'=>'view', $paste['Paste']['parent_id'], $paste['Paste']['id'])));?></td>
				</tr>
				<?php } ?>
				<tr>
					<td><?php __('Note');?>:</td>
					<td colspan="3"><?php echo $paste['Paste']['note']?></td>
				</tr>
			</table>
			<div><?php e($form->input('highlight'));?>
		</div>
		<div>
			<div>
				<?php e($html->link(__('Download Code',true), array('controller'=> 'pastes', 'action'=>'download', $paste['Paste']['id']), array('class'=>'download')));?>
				<?php e($html->link(__('Edit Code',true), array('controller'=> 'pastes', 'action'=>'edit', $paste['Paste']['id']), array('class'=>'ajaxLink')));?>
			</div>
			<?php e($geshi->generate($paste['Paste']['paste'], strtolower($paste['Language']['language'])));?>
		</div>
		<hr />
		<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['Paste']['paste'], 'id'=>'PasteCopy' . $paste['Paste']['id'], 'class'=>'PasteCopy')));?>
		<?php e($html->link(__('Select All Text', true), '#', array('id'=>'PasteCopyButton' . $paste['Paste']['id'], 'class'=>'copyButton', 'rel'=>$paste['Paste']['id'])));?>
	</div>
	</div>
</div>