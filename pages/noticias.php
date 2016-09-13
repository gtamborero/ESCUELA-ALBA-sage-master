<?php
/**
 * Template Name: NOTICIAS
 */
?>

<!-- NOTICIAS -->
<div class="text-center bg2container">

	<?php
	catNoticias();
	
		wp_reset_query();
		$posts = get_posts(array(
			'showposts' => 10, 
			'post_type' => 'post',
			'cache_results' => false, // para mejorar rendimiento en dev o prod
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'no_found_rows' => true, // para mejorar rendimiento si no existe paginacion
		));
		
		
		//echo '<pre>' . var_export($posts, true) . '</pre>';
		foreach ( $posts as $post ) {   
			iproRenderNoticiasCat ($post);
		}
	?>
</div>
<!-- FIN NOTICIAS -->
<?php iproInformes(); ?>
