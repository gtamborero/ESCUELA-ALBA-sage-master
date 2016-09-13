<div class="iproSidebar col-md-3 col-xs-12 bgwhite">
<div class="iproTitle underline maxspacetop maxpadtop color1 strong"><strong><?php echo $ancestorTitle; ?></strong></div>
<?php
	
	//el array es cero pinto el $post->ID, sino el que me devuelva el resultado (que es lo mismo)
	if ( is_page() && $post->post_parent )
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $parentId . '&echo=0' );
	else
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	if ( $childpages ) {
		$string = '<ul>' . $childpages . '</ul>';
	}
	echo $string;
?>

</div>