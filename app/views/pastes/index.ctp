<div class="paging">
	<span class="paging-prev">
		<?php echo $paginator->prev('<< '.__('Previous', true), array(), null, array('class'=>'disabled'));?>
	</span>
	<span class="paging-numbers">
	|	<?php echo $paginator->numbers();?>
	</span>
	<span class="paging-next">
		<?php echo $paginator->next(__('Next', true).' >>', array(), null, array('class'=>'disabled'));?>
	</span>
</div>

<br style="clear:both;" />

<div id="pastesAll" class="paste-area">
	<h2><?php __('Latest Pastes');?></h2>
	<?php foreach ($pastes as $paste) {	?>
		<div id="paste-<?php e($paste['Paste']['id']);?>">
			<div class="infoarea">
				<strong>Paste by <?php e($paste['Paste']['author']);?> <?php __('in');?> <?php e($paste['Language']['language']);?>, <?php e($pastemonkey->timeAgo($paste['Paste']['created']));?></strong>
				<br />
				<?php echo $html->link('View Full Paste', array('controller'=> 'pastes', 'action'=>'view', $paste['Paste']['id']), array('class'=>'ajaxLink')); ?>
			</div>
			<div class="geshi-output">
				<?php e($geshi->generate($paste['Paste']['paste'], $paste['Language']['class']));?>
			</div>
		</div>
	<?php }; ?>
</div>

<br style="clear:both;" />

<div class="paging">
	<span class="paging-prev">
		<?php echo $paginator->prev('<< '.__('Previous', true), array(), null, array('class'=>'disabled'));?>
	</span>
	<span class="paging-numbers">
		<?php echo $paginator->numbers();?>
	</span>
	<span class="paging-next">
		<?php echo $paginator->next(__('Next', true).' >>', array(), null, array('class'=>'disabled'));?>
	</span>
</div>