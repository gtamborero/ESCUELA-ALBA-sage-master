	<!-- CATEGORY VIEW -->
	<div class="albaContainer col-md-9 col-xs-12 medpadtop maxpadbottom">
	<div class="iproTitle color1 pull-left"><?php echo get_the_archive_title(); ?></div>
	<div class="pull-right " style="margin-top:-5px; margin-bottom:10px;"><?php get_search_form(); ?></div>


		<?php 
		while (have_posts()) : the_post(); 
			iproRenderNoticias ($post);
		endwhile;
		?>
	</div>
	<!-- FIN PRODUCTOS -->

<?php include get_template_directory() . "/templates/sidebar.php";