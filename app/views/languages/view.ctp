<div class="pastes">
	<h2><?php __('Latest Pastes');?></h2>
	<?php
	$i = 0;
		foreach ($language['Paste'] as $paste):
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
					<td><?php e($paste['author']);?></td>
					<td><?php __('Language');?>:</td>
					<td><?php echo $html->link($language['Language']['language'], array('controller'=> 'languages', 'action'=>'view', $language['Language']['id']), array('class'=>'ajaxLink')); ?></td>
				</tr>
				<tr>
					<td><?php __('Date Posted');?>:</td>
					<td><?php echo $paste['created']?></td>
					<td><?php __('Note');?>:</td>
					<td><?php echo $paste['note']?></td>
				</tr>
			</table>
		</div>
		<div class="paste-area">
			<?php e($geshi->generate($paste['paste'], strtolower($paste['Language']['language'])));?>
		</div>
		<?php echo $html->link('View Full Paste', array('controller'=> 'pastes', 'action'=>'view', $paste['id']), array('class'=>'ajaxLink')); ?>
		<hr />
		<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['paste'])));?>
		<?php echo $paste['tags']?>
		<hr />
		<h4><?php __('Expires');?> :<?php echo $paste['expiry']?></h4>
	</div>
<?php endforeach; ?>
</div>