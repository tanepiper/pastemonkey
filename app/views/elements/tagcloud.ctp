<?php $tagcloud = $this->requestAction('/tags/tagcloud');?>
<?php if(isset($tagcloud)):?>
	<div class="box"  id="tagCloud">  
		<h2><?php __('Tag Cloud');?></h2>
		<div class="inner">
			<?php
				$tagList = array();
				foreach($tagcloud as $tag)
				{           
					$size = ($tag[0]['count'] < '8') ? $tag[0]['count']*3 + 9 : '40';
					echo $html->link($tag['Tag']['tag'], '/tags/view/'.$tag['Tag']['id'], array('rel'=>'tag','class'=>'tag','style'=>'font-size:'.$size.'px')).' ';
				}
			?>
		</div>
	</div>		
<?php endif;?>