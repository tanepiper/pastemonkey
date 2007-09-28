<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
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
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>