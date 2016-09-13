<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/nav-walker.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


// EXCERPT LENGHT
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// DELETE COMMENTS BUTTON ON ADMIN
add_action( 'admin_init', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

// REMOVE POST FORMAT SUPPORT
add_action('after_setup_theme', 'remove_post_formats', 11);
function remove_post_formats() {
    remove_theme_support('post-formats');
} 

function iproRenderNoticias($post){
?>
		<div class="width100">

			<!--<div style="float:right; color:#777;  padding-bottom:8px;"><?php echo get_the_date(); ?></div>-->
			
			<div class="iproRenderNoticias width100">
			<a class="fullLink" href="<?php echo get_the_permalink(); ?>"></a>
			<div class="color2" style="padding:0px 10px 8px 12px"><?php $terms = get_the_term_list($post->ID,'category');  echo strip_tags( $terms );?></div>
				<div class="col-md-5 col-sm-5 col-xs-12 maxsize">
					<?php 
						/*if ( has_post_thumbnail($post->ID) ){ 
							echo get_the_post_thumbnail($post->ID);
						}else{
							// Imagen genérica de ESCOLA ALBA
							echo '<img src="'. get_template_directory_uri() . '/dist/images/thumb-escola-ciutat-alba.jpg' . '" />';
						}*/
						$destacada = get_field('imatge-destacada');
						if( $destacada ){ ?>
							<img src="<?php echo $destacada['url']; ?>" alt="<?php echo $destacada['alt']; ?>" />
						<?php }else{
							echo '<img src="'. get_template_directory_uri() . '/dist/images/thumb-escola-ciutat-alba.jpg' . '" />';
						} 
						?>
					
						
				</div>
				<div class="col-md-7 col-sm-5 col-xs-12" style="padding-left:15px;">
						<div class="medpadtop iproTitle darkgrey" style="text-transform:uppercase;"><?php echo get_the_title($post->ID); ?></div>
						<div class="color1"><?php echo get_the_date(); ?></div>
						<!--<div class="iproText color1"><?php if (has_excerpt( $post->ID )) echo get_the_excerpt($post->ID); ?><br />&nbsp;</div>-->
						<div class="iproText"><?php echo get_the_excerpt(); ?></div>
						<!--<div class="iproDown color1 strong">LEER MÁS ></div>-->
				</div>
			</div>
		</div>
<?php
}

function iproNoticias($categoria = 'destacadas', $excludePostId = ''){ ?>
	<!-- NOTICIAS -->
<div class="text-center bg1container">
	<?php
	
		wp_reset_query();
		$args = array(
			'post_type'             => 'post',
			'post_status'           => 'publish',
			'category_name'         => $categoria,
			'posts_per_page'        => '2',
			'post__not_in'			=> array($excludePostId),
			'cache_results' => false, // para mejorar rendimiento en dev o prod
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'no_found_rows' => true, // para mejorar rendimiento si no existe paginacion
		);		
		$noticias = new WP_Query($args);
		
		while ( $noticias->have_posts() ) { 
			$noticias->the_post();
			iproRenderNoticias ($noticias);
		}
		
	?>
</div>
<!-- FIN NOTICIAS -->
<?php
}

function iproRenderForm1(){
?>
<!-- CONTACT FORM 1 -->
<div class="text-center bg1container iproForm">
	<?php echo do_shortcode('[contact-form-7 id="41" title="Form portada"]'); ?>
</div>

<?php }

// SEARCH FUNCTION
function iProSearchForm( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input type="text" placeholder="Buscar..." value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value=">" />
    </div>
    </form>';
return $form;
}
add_filter( 'get_search_form', 'iProSearchForm' );

// SEARCH FILTER (solo posts)
function searchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}
add_filter('pre_get_posts','searchFilter');

// Allow shortcodes in Contact Form 7
function shortcodes_in_cf7( $form ) { 
	$form = do_shortcode( $form ); 
	return $form; 
} 
add_filter( 'wpcf7_form_elements', 'shortcodes_in_cf7' );

// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

// DISABLE ADMIN BAR ON FRONT USERS
add_filter('show_admin_bar', '__return_false');

// REDIRECT TO Groups ON LOGIN
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url('/groups/');
		}
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

// REDIRECT TO HOME ON LOGOUT
function go_home_on_logout(){
  wp_redirect( home_url() );
  exit();
}
add_action('wp_logout','go_home_on_logout');