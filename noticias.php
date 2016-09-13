<?php
/**
 * Template Name: NOTICIAS
 */
?>


<!-- NOTICIAS -->
<div class="noticias clearboth width100">
<?php 
	$contador =1;
	query_posts(array('showposts' => 12, 'post_type' => 'post')); 
	while (have_posts()) { 
		the_post(); ?>
		<div class="medpad minpadtop minpadbottom col-md-6 col-xs-12">
			<div class="">Noticias</div>
			<div class=" underline rmfont minpadbottom h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			<div class="small maxpadbottom"><?php echo the_excerpt(); ?></div>
			<a href="<?php the_permalink(); ?>"><div class="buttonleer small">Leer más »</div></a>
			
		</div>
	<?php 	
	$contador++;
	} 
	?>
</div>
<!-- FIN NOTICIAS -->

