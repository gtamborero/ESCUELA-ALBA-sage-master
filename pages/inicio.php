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
			//if (is_user_logged_in()) {
				$showPosts = array('publish','private');
			//}else{
				//$showPosts = 'publish';
			//}
			//$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$paged = (get_query_var('page')) ? get_query_var('page') : 1;

			$args = array(
				'post_type'             => 'post',
				'post_status'           => $showPosts,
				'posts_per_page'        => 6,
				'paged' 				=> $paged,
				'tax_query' => array(
					array(
						'taxonomy'  => 'category',
						'field'     => 'ID',
						'terms'     => '27', // exclude items media items in the news-cat custom taxonomy
						'operator'  => 'NOT IN')
				),

				'cache_results' => true, // para mejorar rendimiento en dev o prod
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'no_found_rows' => false, // para mejorar rendimiento si no existe paginacion
			);
			$wp_query = new WP_Query($args);

			if ( have_posts() ){
				while ( $wp_query->have_posts() ) {
					$wp_query->the_post();
					//var_dump ($productos->the_post());
					//var_dump($post);
					//the_title();
					iproRenderNoticias ($post);
				}
			}
		?>
		<div class="width100">
		<?php the_posts_pagination( array(
		    'mid_size' => 3,
		    'prev_text' => 'Anterior',
		    'next_text' => 'Següent',
		) ); ?>
		</div>
	</div>
	<!-- FIN PRODUCTOS -->

<?php include get_template_directory() . "/templates/sidebar.php";
