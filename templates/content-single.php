<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

	
	<header>
		<div class="width100" style="background-color:#eee;">
			<div class="medpad col-md-12">
			  <h1 class="entry-title rmfont medpadtop"><?php the_title(); ?></h1>
			  <div class="col-xs-12 col-sm-8 medpadbottom"><?php echo types_render_field("lead-noticias", array('raw' => 'true')); ?></div>
			</div>
		</div>
	</header>
	
	<div class="medpad minpadtop minpadbottom col-md-12 clearboth">
		<div class="entry-content textjustify">
		  <div class="width100 floatleft textright colored" style="padding-bottom:0.8%;><?php get_template_part('templates/entry-meta'); ?></div>
		  <?php the_post_thumbnail( 'full', array( 'class' => 'alignright' ) ); ?>
		  <?php the_content(); ?>
		</div>
	</div>
	
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php /* comments_template('/templates/comments.php'); */ ?>
  </article>
<?php endwhile; ?>
<div class="hr bglightgrey" ></div>
<?php get_template_part( 'templates/content', '4products' ); ?>

