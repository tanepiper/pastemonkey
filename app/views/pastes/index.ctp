<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

<div class="pastes">
	<?php pr($pastes);?>
	<h2><?php __('Latest Pastes');?></h2>
	<?php
	$i = 0;
		foreach ($pastes as $paste):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>

	<div<?php echo $class;?>>
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
						<?php //foreach($paste['Tag'] as $tag) {
								//e($html->link($tag['tag'], array('controller'=>'tags', 'action'=>'view', $tag['id'])));
							//} ?>
					</td>
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
		<div class="paste-area">
			<?php echo $paste['Paste']['paste_formatted']?>
		</div>
		<?php echo $html->link('View Full Paste', array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id']), array('class'=>'viewPaste')); ?>
		<hr />
		<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['Paste']['paste'], 'id'=>'PasteCopy' . $paste['Paste']['id'], 'class'=>'PasteCopy')));?>
		<?php e($html->link(__('Select All Text', true), '#', array('id'=>'PasteCopyButton' . $paste['Paste']['id'])));?>
		<?php e($javascript->codeBlock('$pastemonkey("#PasteCopyButton' . $paste['Paste']['id'] . '").bind("click", function(){$pastemonkey("#PasteCopy' . $paste['Paste']['id'] . '").focus();$pastemonkey("#PasteCopy' . $paste['Paste']['id'] . '").select();return false;});'));?>
	</div>
<?php endforeach; ?>
</div>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>