<div class="pinboard">
<h2><?php  __('Pinboard');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $pinboard['Pinboard']['id']?>
			&nbsp;
		</dd>
		<dt>Title</dt>
		<dd>
			<?php echo $pinboard['Pinboard']['title']?>
			&nbsp;
		</dd>
		<dt class="altrow">Body</dt>
		<dd class="altrow">
			<?php echo $pinboard['Pinboard']['body']?>
			&nbsp;
		</dd>
		<dt>Author</dt>
		<dd>
			<?php echo $pinboard['Pinboard']['author']?>
			&nbsp;
		</dd>
		<dt class="altrow">Tags</dt>
		<dd class="altrow">
			<?php echo $pinboard['Pinboard']['tags']?>
			&nbsp;
		</dd>
		<dt>Created</dt>
		<dd>
			<?php echo $pinboard['Pinboard']['created']?>
			&nbsp;
		</dd>
		<dt class="altrow">Modified</dt>
		<dd class="altrow">
			<?php echo $pinboard['Pinboard']['modified']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('Pinboard', true),   array('action'=>'edit', $pinboard['Pinboard']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('Pinboard', true), array('action'=>'delete', $pinboard['Pinboard']['id']), null, __('Are you sure you want to delete', true).' #' . $pinboard['Pinboard']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Pinboards', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('Pinboard', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
