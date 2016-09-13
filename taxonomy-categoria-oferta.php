<?php get_template_part('templates/page', 'header'); ?>

<!-- NOTICIAS -->
<div class="text-center bg2container">
<div class="headTitle">Procesos de selección abiertos en estos momentos:</div>

	<?php
	catOfertas();
	
		/*wp_reset_query();
		$posts = get_posts(array(
			'showposts' => 10, 
			'post_type' => 'oferta-trabajo',
			'cache_results' => false, // para mejorar rendimiento en dev o prod
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'no_found_rows' => true, // para mejorar rendimiento si no existe paginacion
		));
		*/
		
		//echo '<pre>' . var_export($posts, true) . '</pre>';
		foreach ( $posts as $post ) {   
			iproRenderEmpleosCat ($post);
		}
	?>
</div>
<!-- FIN NOTICIAS -->
<?php iproNewsletterCandidatos(); ?>