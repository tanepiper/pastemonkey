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
		<h4><?php __('Language');?> : <?php echo $html->link($paste['Language']['language'], array('controller'=> 'languages', 'action'=>'view', $paste['Language']['id'])); ?></h4>
		<div><?php __('Pasted By');?>  on <?php echo $paste['Paste']['created']?></div>
		
		<div class="paste-area">
			<?php echo $paste['Paste']['paste_formatted']?>
		</div>
		<?php echo $html->link('View Full Paste', array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id'])); ?>
		<hr />
		<?php e($form->input('plain_paste',array('type'=>'textarea','value'=>$paste['Paste']['paste'])));?>
		<hr />
		<?php echo $paste['Paste']['note']?>
		<hr />
		<?php echo $paste['Paste']['tags']?>
		<hr />
		<h4><?php __('Expires');?> :<?php echo $paste['Paste']['expiry']?></h4>
	</div>
<?php endforeach; ?>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>