<?php
/**
 * Template Name: PAGE FULL WIDTH
 */
while ( have_posts() ): the_post();
?>
</div>
	<div class="albaContainer col-md-12 col-xs-12 maxpadtop minpadbottom">
		<div class="iproTitle pull-left color1"><?php the_title(); ?></div>
		<div class="width100 iproLead minpadtop"><?php the_field('lead'); ?></div>

		<div class="width100 textleft minpadtop maxsize">
			<?php 
			  if (has_post_thumbnail()) { 
				echo get_the_post_thumbnail(); 
			  } 
			?>
			
			<div class="darkgrey minpadtop" ><?php the_content(); ?></div>
		</div>
	</div>
<?php endwhile; ?>