<div class="paging">
	<?php echo $paginator->prev('<< '.__('Previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('Next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

<div class="pastes">
	<h2><?php __('Latest Pastes');?></h2>
	<?php foreach ($pastes as $paste) {	?>
	<div id="paste-<?php e($paste['Paste']['id']);?>">
		<div class="infoarea">
			<strong>Paste by <?php e($paste['Paste']['author']);?> <?php __('in');?> <?php e($paste['Language']['language']);?>, <?php e($pastemonkey->timeAgo($paste['Paste']['created']));?></strong>
		</div>
		<div class="geshi-output">
			<?php e($geshi->generate($paste['Paste']['paste'], strtolower($paste['Language']['language'])));?>
		</div>
		<?php echo $html->link('View Full Paste', array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id']), array('class'=>'ajaxLink')); ?>
	</div>
<?php }; ?>
</div>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>