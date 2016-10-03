<?php
  // For use with Sagextras (https://github.com/storm2k/sagextras)
?>
<header class="banner navbar navbar-default navbar-static-top" role="banner">
 
	<div class="width100">
		<div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a href="<?= esc_url(home_url('/')); ?>"><img src="<?= get_template_directory_uri(); 
		?>/dist/images/logo-escola-ciutat-alba.jpg"></a>
			</div>
			
			<div class="pull-right"><?php 
			/* MOSTRAR UNA U OTRA COSA EN EL BOTÓN DE LOGIN SI ADMIN / USER / ANONIMO */
			if (is_user_logged_in() AND (!is_super_admin())){ 
				$current_user = wp_get_current_user(); 
				echo '<a href="' . home_url('/grups/') . '"><div class="loginbutton">Hola ' . $current_user->display_name . '</div></a>';
			}
			if (is_user_logged_in() AND (is_super_admin())){ 
				$current_user = wp_get_current_user(); 
				echo '<a href="' . home_url('/wp-admin/') . '"><div class="loginbutton">Hola ' . $current_user->display_name . '</div></a>';
			}
			if (!is_user_logged_in()) echo'<a href="/wp-admin"><div class="loginbutton">Accés usuaris</div></a>'; 
			//if (is_user_logged_in()) echo'<br /><a href="' . wp_logout_url() . '">Logout</a>'; 
			?>
			<a href="/canco-amunt/"><div class="albaMusica"><img style="width:25px;" src="<?= get_template_directory_uri(); 
		?>/dist/images/musica.png"> &nbsp;Cancó amunt</div></a>
			</div>	
		</div>
	</div>	
	
	<!-- NAV BAR -->
	<div class="width100 bgcolor1" >
		<div class="container">	
			<nav class="collapse navbar-collapse navbar-left" role="navigation">

			  <?php
			  if (has_nav_menu('primary_navigation')) :
				wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
			  endif;
			  ?>
			</nav>
		</div>
	</div>
		
</header>