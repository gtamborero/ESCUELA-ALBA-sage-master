<div class="iproSidebar iproSidebarUp col-md-3 col-xs-12">

	<?php
	if (is_user_logged_in()){
	$current_user = wp_get_current_user();

    /*
	?>

	<!-- USER FAST ACCESS -->
	<section class="widget_categories"><h3>Hola <?php echo $current_user->display_name; ?>!</h3>
		<ul>

			<?php
			//$groupObject = get_current_user_groups($current_user->ID);
			// LOOP GROUP START
			$groupObject = BP_Groups_Member::get_group_ids( $current_user->ID );
			$group = $groupObject["groups"];
			foreach ((array) $group as $value){
				$group = groups_get_group( array( 'group_id' => $value ) );
				echo '<li class="cat-item"><a href="' . home_url("/grups/" . $group->slug) . '">Grup ' . $group->name . '</a></li>';
			}
			// LOOP END
	?>
			<li class="cat-item"><a href="<?php echo home_url("/grups/"); ?>">TOTS ELS GRUPS</a></li>
			<li class="cat-item"><a href="<?php echo bp_loggedin_user_domain() . "settings/"; ?>">Gestió d'usuari</a></li>
			<li class="cat-item"><a href="<?php echo bp_loggedin_user_domain() . "profile/change-avatar/"; ?>">Canviar foto perfil</a></li>
			<li class="cat-item"><a href="<?php echo wp_logout_url(); ?>">Sortir</a></li>
		</ul>
	</section>

        <?php
    */ }
	if (current_user_can('edit_posts')){ ?>

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
			'cat' 					=> '-27',
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
	// Muestro el sidebar si no estoy en una página normal y si no estoy dentro de buddy press
	// No tiene sentido mostrar agenda y categorias dentro de buddy
	/*if (bp_is_blog_page()) { */
		dynamic_sidebar('sidebar-primary');
	/* }*/
	?>
</div>
