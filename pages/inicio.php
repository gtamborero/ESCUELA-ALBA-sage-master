<?php
/**
 * Template Name: INICIO
 */
?>
<?php  layerslider(1); ?>
</div>


	<!-- CATEGORY VIEW -->
	<div class="albaContainer col-md-9 col-xs-12 maxpadtop maxpadbottom">
	<div class="iproTitle color1 pull-left">NOVETATS</div>
	<div class="pull-right " style="margin-top:-5px; margin-bottom:10px;"><?php get_search_form(); ?></div>

		<?php
			wp_reset_query();
			
			// Set post visibility for logged in / out users
			if (is_user_logged_in()) { 
				$showPosts = array('publish','private');
			}else{
				$showPosts = 'publish';
			}
			$args = array(
				'post_type'             => 'post',
				'post_status'           => $showPosts,
				'posts_per_page'        => '8',
				'tax_query' => array(
					array(
						'taxonomy'  => 'category',
						'field'     => 'slug',
						'terms'     => 'festius', // exclude items media items in the news-cat custom taxonomy
						'operator'  => 'NOT IN')
				),
				
				'cache_results' => false, // para mejorar rendimiento en dev o prod
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'no_found_rows' => true, // para mejorar rendimiento si no existe paginacion
			);		
			$productos = new WP_Query($args);
			
			while ( $productos->have_posts() ) { 
				$productos->the_post();
				//var_dump ($productos->the_post());
				iproRenderNoticias ($post);
			}
		?>
	</div>
	<!-- FIN PRODUCTOS -->

<?php include get_template_directory() . "/templates/sidebar.php";