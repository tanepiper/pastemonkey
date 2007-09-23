<div class="languages">
<h2><?php __('Languages');?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('language');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($languages as $language):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $language['Language']['id']?>
		</td>
		<td>
			<?php echo $language['Language']['language']?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $language['Language']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $language['Language']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $language['Language']['id']), null, __('Are you sure you want to delete', true).' #' . $language['Language']['id']); ?>
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
		<li><?php echo $html->link(__('New', true).' '.__('Language', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('controller'=> 'pastes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Paste', true), array('controller'=> 'pastes', 'action'=>'add')); ?> </li>
	</ul>
</div>