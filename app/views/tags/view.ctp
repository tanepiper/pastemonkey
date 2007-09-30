<div class="pastesByTags">
	<h2><?php __('Pastes');?> <?php __('For');?> <?php e($tags['Language']['language']);?></h2>
	<?php foreach ($tags['Paste'] as $paste) { ?>

	<div id="paste-<?php e($paste['id']);?>">
		<div class="infoarea">
			<strong><?php e($language['Language']['language']);?> post by <?php e($paste['author']);?> <?php e($pastemonkey->timeAgo($paste['created']));?></strong>
		</div>
		<div class="geshi-output">
			<?php e($geshi->generate($paste['paste'], strtolower($paste['Language']['language'])));?>
		</div>
		<?php echo $html->link(__('View Full Paste', true), array('controller'=> 'pastes', 'action'=>'view', $paste['id']), array('class'=>'ajaxLink')); ?>
	</div>
<?php } ?>
</div>