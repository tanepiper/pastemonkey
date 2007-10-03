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

<div class="pinboards">
<h2><?php __('Lastest');?> <?php __('Pinboards');?></h2>
<?php
$i = 0;
foreach ($pinboards as $pinboard):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<div class="pinboardEntry" id="entry-<?php echo $pinboard['Pinboard']['id']?>">
		<div class="pinboardHeader">
			<?php __('Added by');?> <?php echo $pinboard['Pinboard']['author']?>
			<?php __('on');?> <?php echo $pinboard['Pinboard']['created']?>
		</div>

		<h2><?php echo $pinboard['Pinboard']['title']?></h2>
		<div>
			<?php echo $pinboard['Pinboard']['body']?>
		</div>
		<div class="pinboardTags">
			Tags: <?php echo $pinboard['Pinboard']['tags']?>
		</div>		
	</div>
<?php endforeach; ?>
</div>

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