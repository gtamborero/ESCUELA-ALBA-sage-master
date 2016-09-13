<?php
/**
 * Template Name: EDIT POST
 */


?>
<?php acf_form_head(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php acf_form(array(
					'post_id'		=> $_REQUEST['postid'],
					'post_title'	=> true,
					'post_content'	=> true,
					'post_thumbnail'	=> true,
					'new_post'		=> array(
						'post_status'		=> 'publish'
					),
					'submit_value'		=> 'Publicar'
				)); ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->