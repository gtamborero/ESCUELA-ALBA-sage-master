<div class="iproSidebar iproSidebarUp col-md-3 col-xs-12">

<?php if (current_user_can('edit_posts')){ ?>

	<!-- User post system -->
	<section class="widget_categories"><h3>Publicar Novetats</h3>		
		<ul>
			<li class="cat-item cat-item-24"><a href="/nova-entrada">Crear Novetat</a></li>
			<li class="cat-item cat-item-22"><a href="/entrades">Editar novetats</a></li>
		</ul>
	</section>

<?php }

	if (is_user_logged_in() AND (!is_front_page())){ ?>

	<!-- LAST POSTS -->
	<section class="widget_categories"><h3>Últimes Novetats</h3>		

	
		<?php
			wp_reset_query();
			// Set post visibility for logged in user
			$showPosts = array('publish','private');
			$args = array(
				'post_type'             => 'post',
				'post_status'           => $showPosts,
				'posts_per_page'        => '5',
				'cache_results' => false, // para mejorar rendimiento en dev o prod
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'no_found_rows' => true, // para mejorar rendimiento si no existe paginacion
			);		
			$productos = new WP_Query($args);
			
			while ( $productos->have_posts() ) { 
				$productos->the_post();
				//var_dump ($productos->the_post());
				iproRenderNoticiasSidebar ($post);
			}
		?>
		
	
	</section>
	<br />&nbsp;<br />

<?php } ?>

<br />&nbsp;<br />

<?php
dynamic_sidebar('sidebar-primary'); 
?>
</div>