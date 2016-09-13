	<!-- CATEGORY VIEW -->
	<div class="albaContainer col-md-9 col-xs-12 medpadtop maxpadbottom">
	<div class="iproTitle color1 pull-left">Resultats de la cerca:</div>
	<div class="pull-right " style="margin-top:-5px; margin-bottom:10px;"><?php get_search_form(); ?></div>

	<?php 
	if (!have_posts()){ ?>
		<div class="width100 medpadtop medpadbottom">Llàstima! No hem trobat cap paraula relacionada amb la teva cerca</div>
	<?php 
	}else{
		while (have_posts()) : the_post(); 
			iproRenderNoticias ($post);
		endwhile;
	} ?>
	
		</div>
	<!-- FIN PRODUCTOS -->

<?php include get_template_directory() . "/templates/sidebar.php";

the_posts_navigation();
		

