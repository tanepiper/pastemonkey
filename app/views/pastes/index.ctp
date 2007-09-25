<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

<div class="pastes">
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
			<div><?php __('Paste By');?> <?php e($paste['Paste']['author']);?></div>
			<div><?php __('Language');?> <?php echo $html->link($paste['Language']['language'], array('controller'=> 'languages', 'action'=>'view', $paste['Language']['id'])); ?></div>
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