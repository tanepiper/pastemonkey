<div class="pastes">
	<h2><?php __('Pastes for search term');?> <?php e($term);?></h2>
	<?php if($items) { ?>
		<?php foreach ($items as $paste) {	?>
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
	<?php } else { ?>
		<strong>Your search term produced no results.</strong>
	<?php } ?>
</div>