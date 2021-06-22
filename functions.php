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


// Eliminar emojis + wp-embed
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

// Eliminar jquery migrate
function dequeue_jquery_migrate( &$scripts){
	if(!is_admin()){
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

// funcion para permitir o no escribir a usuarios predeterminados
// BUDDY FUNCTION to get actual user rol name
function buddyViewerRol() {
	global $current_user;
	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);

	//echo $user_role;
	// casos especiales:
	// en general si el user role es alumno plus o ampa o profesor o admin se puede escribir en el grupo
	// por el contrario si es padre o alumno no puede escribir.
	// el caso complejo es que ampa puede escribir solo si tiene AMPA delante del nombre del grupo.
  //echo "user: " . $current_user->ID;
  $currentGroupId = bp_get_current_group_id();
 //echo groups_is_user_admin( $current_user, bp_get_current_group_id()
 //echo groups_is_user_admin( $current_user->ID, $currentGroupId);

	if (($user_role == 'alumne') || ($user_role == 'mare-pare')){
    if ( !groups_is_user_admin( $current_user->ID, $currentGroupId) && (!groups_is_user_mod( $current_user->ID, $currentGroupId))){
		    echo '<style>.bpfb_form_container, #whats-new-form {display:none;} </style>';
    }
	}

	if ($user_role == 'ampa'){
		$group_name = bp_get_current_group_name();
		//echo $group_name;
		if(stristr($group_name, 'ampa') === FALSE) {
			// No es un grupo del ampa por tanto no puede escribir el usuario
      if ( !groups_is_user_admin( $current_user->ID, $currentGroupId) && (!groups_is_user_mod( $current_user->ID, $currentGroupId))){
			     echo '<style>.bpfb_form_container, #whats-new-form {display:none;} </style>';
      }
		}
	}
}
//add_action( 'get_header', 'buddyViewerRol' );


// EXCERPT LENGHT
function custom_excerpt_length( $length ) {
	return 80;
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
			<div class="color2 strong" style="padding:0px 10px 8px 12px"><?php $terms = get_the_term_list($post->ID,'category' , '', ' / ');  echo strip_tags( $terms );?></div>
				<div class="col-md-5 col-sm-5 col-xs-12 maxsize">
					<?php
          	//$destacada = get_field('imatge-destacada');
            //$size ="medium";
						if( has_post_thumbnail() ){ ?>
							<?php the_post_thumbnail('medium'); ?>
						<?php }else{
							echo '<img src="'. get_template_directory_uri() . '/dist/images/thumb-escola-ciutat-alba.jpg' . '" />';
						}
					?>


				</div>
				<div class="col-md-7 col-sm-5 col-xs-12" style="padding-left:15px;">
						<div class="medpadtop iproTitle darkgrey" style="text-transform:uppercase;"><?php if ( get_post_status ( $post->ID ) == 'private' ) echo '<img style="width:15px; margin-top:-4px;" src="'. get_template_directory_uri() . '/dist/images/locked.png' . '" />'; ?> <?php echo get_the_title($post->ID); ?></div>
						<div class="color1 minpadbottom"><?php echo get_the_date(); ?></div>
						<!--<div class="iproText color1"><?php if (has_excerpt( $post->ID )) echo get_the_excerpt($post->ID); ?><br />&nbsp;</div>-->
						<div class="iproText"><?php echo get_the_excerpt(); ?></div>
						<img class="plusbutton" src="<?php echo get_template_directory_uri() . '/dist/images/plus.png'; ?>" />
				</div>
			</div>
		</div>
<?php
}

function iproRenderNoticiasSidebar($post){
?>
		<div class="width100 bgwhite">

			<div class="iproRenderNoticiasSidebar width100 bgwhite">
			<a class="fullLink" href="<?php echo get_the_permalink(); ?>"></a>
				<div class="darkgrey text-left"><?php if ( get_post_status ( $post->ID ) == 'private' ) echo '<img style="width:15px; margin-top:-4px;" src="'. get_template_directory_uri() . '/dist/images/locked.png' . '" />'; ?> <?php echo get_the_title($post->ID); ?></div>
				<div class="color1 text-right"><?php echo get_the_date(); ?></div>
			</div>
		</div>
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

// Get current user group slug
// Returns group slug + name + integer total groups subscribed by user
function get_current_user_groups( $userId ){
	$group_ids = groups_get_user_groups( $userId );
	$counter = 0;
  //var_dump ($group_ids);
	if ($group_ids['total'] != 0){
    foreach($group_ids["groups"] as $group_id) {
		$slug = groups_get_group(array( 'group_id' => $group_id )) -> slug;
		$name = groups_get_group(array( 'group_id' => $group_id )) -> name;
		$counter++;
	  }
  	$object = array (
  		'slug' => $slug,
  		'name' => $name,
  		'counter' => $counter,
  	);
  return $object;
  }
}

// REDIRECT TO Groups ON LOGIN
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			$groupObject = get_current_user_groups($user->ID);
			if ( $groupObject ['counter'] >1 ) {
				return home_url('/grups/');
			}else{
				return home_url('/grups/' . $groupObject['slug']);
			}
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



//dame todos los ids post_type = post y hago loop con ellos
/*$posts = $wpdb->get_results("
    SELECT ID
    FROM $wpdb->posts
    WHERE post_type = 'post'
");
//var_dump ($posts);
//exit();
$recorre = 0;
while ($posts[$recorre]){
my_acf_save_post($posts[$recorre]->ID);
$recorre++;
}
*/


// Guardo el campo fecha del custom field dentro del post
//add_action('acf/save_post', 'my_acf_save_post', 20);
function my_acf_save_post( $post_id ) {
  $acfDate = get_field('data_dinici', $post_id);
	$acfPrivacitat = get_field('privacitat', $post_id);
  $thumbnail_id = get_field('imatge-destacada', $post_id);
	//echo $acfDate;
	//exit (-1);
	$my_post = array();
	$my_post['ID'] = $post_id;
	$my_post['post_date'] = $acfDate;
	$my_post['post_status'] = $acfPrivacitat;
  set_post_thumbnail( $post_id, $thumbnail_id );
	wp_update_post( $my_post );
}
add_action('acf/save_post', 'my_acf_save_post', 20);

// define the bp_group_has_members callback
function filter_bp_group_has_members( $members_template_has_members, $members_template ) {
	//var_dump ($members_template);
	echo "miembros: ";
	//var_dump ($members_template);

	foreach ($members_template as $thekey => $themember){
		echo "<br />clave: " . $thekey . " valor: " . $themember;
	}
	// $members_template nos devuelve todos los users e información interesante.
	// Tengo que pillar cada user, ver que tipo de usuario es y solo mostrar a los alumnos
	// rehacer el array eliminando usuarios que no quiero ... pero no se como devolver esto con este filtro
	// puedo pintar directamente y listo, solo falta saber pintar el thumb de cada user
	// BP_Groups_Group_Members_Templates

	//$soloelia = array();
	//$soloelia = ["ID"]=> string(2) "28" ["user_login"]=> string(4) "elia" ["user_pass"]=> string(34) "$P$BLK9vlLiWEKfqDA2nGTkyOAjtzVRnu1" ["user_nicename"]=> string(4) "elia" ["user_email"]=> string(17) "elia@iproject.cat" ["user_url"]=> string(0) "" ["user_registered"]=> string(19) "2016-09-06 09:40:43" ["user_activation_key"]=> string(0) "" ["user_status"]=> string(1) "0" ["display_name"]=> string(9) "elia elia" ["id"]=> string(2) "28" ["fullname"]=> string(9) "elia elia" ["user_id"]=> int(28) ["is_admin"]=> int(0) ["is_mod"]=> int(0) "";
	/*$members_template = array (
		'ID' => "28",
	);*/
	?>

	<br />


	<?php
	return 0;
};
//add_filter( 'bp_group_has_members', 'filter_bp_group_has_members', 10, 2 );

// Todas las páginas con error van a login
function private_content_redirect_to_login() {
  global $wp_query,$wpdb;
  if (is_404()) {
    $private = $wpdb->get_row($wp_query->request);
    if ($private){
      $location = wp_login_url($_SERVER["REQUEST_URI"]);
      if( 'private' == $private->post_status  ) {
        wp_safe_redirect($location);
        exit;
      }
    }
  }
}
add_action('template_redirect', 'private_content_redirect_to_login', 9);

// Desactivar lightbox thickbox por defecto WP
function my_scripts_method() {
    wp_deregister_script('thickbox');
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'my_scripts_method');


/**
* Format WordPress User's "Display Name" to Full Name on Login
* ------------------------------------------------------------------------------
*/

add_action( 'wp_login', 'wpse_9326315_format_user_display_name_on_login' );

function wpse_9326315_format_user_display_name_on_login( $username ) {
    $user = get_user_by( 'login', $username );

    $first_name = get_user_meta( $user->ID, 'first_name', true );
    $last_name = get_user_meta( $user->ID, 'last_name', true );

    $full_name = trim( $first_name . ' ' . $last_name );

    if ( ! empty( $full_name ) && ( $user->data->display_name != $full_name ) ) {
        $userdata = array(
            'ID' => $user->ID,
            'display_name' => $full_name,
        );

        wp_update_user( $userdata );
    }
}