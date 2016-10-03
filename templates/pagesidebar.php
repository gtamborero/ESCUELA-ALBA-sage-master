<div class="iproSidebar iproSidebarUp col-md-3 col-xs-12">
<section class="widget_categories"><h3><?php echo $ancestorTitle; ?></h3>
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
</section>