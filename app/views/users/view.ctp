<div class="user">
<h2><?php  __('User');?></h2>
	<dl>
		<dt class="altrow">Id</dt>
		<dd class="altrow">
			<?php echo $user['User']['id']?>
			&nbsp;
		</dd>
		<dt>Email</dt>
		<dd>
			<?php echo $user['User']['email']?>
			&nbsp;
		</dd>
		<dt class="altrow">Passwd</dt>
		<dd class="altrow">
			<?php echo $user['User']['passwd']?>
			&nbsp;
		</dd>
		<dt>Author</dt>
		<dd>
			<?php echo $user['User']['author']?>
			&nbsp;
		</dd>
		<dt class="altrow">Pastes Count</dt>
		<dd class="altrow">
			<?php echo $user['User']['pastes_count']?>
			&nbsp;
		</dd>
		<dt>Created</dt>
		<dd>
			<?php echo $user['User']['created']?>
			&nbsp;
		</dd>
		<dt class="altrow">Modified</dt>
		<dd class="altrow">
			<?php echo $user['User']['modified']?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit', true).' '.__('User', true),   array('action'=>'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete', true).' '.__('User', true), array('action'=>'delete', $user['User']['id']), null, __('Are you sure you want to delete', true).' #' . $user['User']['id'] . '?'); ?> </li>
		<li><?php echo $html->link(__('List', true).' '.__('Users', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New', true).' '.__('User', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
