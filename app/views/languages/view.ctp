<div class="language">
<h2><?php  __('Language');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $language['Language']['id']?>
			&nbsp;
		</dd>
		<dt>Language</dt>
		<dd>
			<?php echo $language['Language']['language']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Language', true),   array('action'=>'edit', $language['Language']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Language', true), array('action'=>'delete', $language['Language']['id']), null, __('Are you sure you want to delete', true).' #' . $language['Language']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Languages', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Language', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Pastes', true), array('controller'=> 'pastes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Paste', true), array('controller'=> 'pastes', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php  __('Related');?> <?php __('Pastes');?></h3>
	<?php if (!empty($language['Paste'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>Id</th>
		<th>Paste</th>
		<th>Note</th>
		<th>Tags</th>
		<th>Parent Id</th>
		<th>Language Id</th>
		<th>Created</th>
		<th>Expiry</th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($language['Paste'] as $paste):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $paste['id'];?></td>
			<td><?php echo $paste['paste'];?></td>
			<td><?php echo $paste['note'];?></td>
			<td><?php echo $paste['tags'];?></td>
			<td><?php echo $paste['parent_id'];?></td>
			<td><?php echo $paste['language_id'];?></td>
			<td><?php echo $paste['created'];?></td>
			<td><?php echo $paste['expiry'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'pastes', 'action'=>'view', $paste['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'pastes', 'action'=>'edit', $paste['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'pastes', 'action'=>'delete', $paste['id']), null, __('Are you sure you want to delete', true).' #' . $paste['id'] . '?'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New', true).' '.__('Paste', true), array('controller'=> 'pastes', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
