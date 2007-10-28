<div class="comments">
<h2><?php __('Comments');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('paste_id');?></th>
	<th><?php echo $paginator->sort('line_position');?></th>
	<th><?php echo $paginator->sort('comment');?></th>
	<th><?php echo $paginator->sort('author');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($comments as $comment):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $comment['Comment']['id']?>
		</td>
		<td>
			<?php echo $html->link($comment['Paste']['id'], array('controller'=> 'pastes', 'action'=>'view', $comment['Paste']['id'])); ?>
		</td>
		<td>
			<?php echo $comment['Comment']['line_position']?>
		</td>
		<td>
			<?php echo $comment['Comment']['comment']?>
		</td>
		<td>
			<?php echo $comment['Comment']['author']?>
		</td>
		<td>
			<?php echo $comment['Comment']['created']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $comment['Comment']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $comment['Comment']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete', true).' #' . $comment['Comment']['id']); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New', true).' '.__('Comment', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('controller'=> 'pastes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Paste', true), array('controller'=> 'pastes', 'action'=>'add')); ?> </li>
	</ul>
</div>