	<!-- PAGE.PHP PAGE -->
	<div class="albaContainer col-md-9 col-xs-12 minpadtop minpadbottom">
		<div class="iproTitle pull-left color1"><?php the_title(); ?></div>
		<div class="width100 iproLead minpadtop"><?php the_field('lead'); ?></div>

		<div class="width100 textleft minpadtop">
			<?php 
			  if (has_post_thumbnail()) { 
				echo get_the_post_thumbnail(); 
			  } 
			?>
			
			<div class="darkgrey minpadtop" ><?php the_content(); ?></div>
			
			<!-- VIDEO -->
			<?php $video = get_field('video');
			if( $video ): ?>
			<div class="iproTitle color1 minpadtop minpadbottom">Vídeo</div>
			<div class="width100 bgwhite minpad minpadtop minpadbottom minspacebottom">			
				<div class="embed-container">
				<?php the_field('video'); ?>
				</div>
			</div>
			<?php endif; ?> 			

			<!-- GALLERY -->
			<?php
			$images = get_field('galeria');
			if( $images ): ?>
				<div class="iproTitle  color1 minpadtop minpadbottom">Galeria de fotos</div>
				<div class="gallery width100 bgwhite minpad minpadtop minpadbottom minspacebottom">
				<?php foreach( $images as $image ): ?>
					<div class="col-md-3 col-xs-6">
						<a href="<?php echo $image['url']; ?>">
							 <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
						</a>
						<p><?php echo $image['caption']; ?></p>
					</div>
				<?php endforeach; ?>
				</div>
			<?php endif; 
			
			if( have_rows('descarregas') ): ?>
			<!-- DOWNLOADS -->
				<div class="iproTitle color1 minpadbottom">Descàrregues</div>
				<div class="width100 bgwhite minpad minpadtop minpadbottom">
					
				<?php
					while ( have_rows('descarregas') ) { 
						the_row();
						$data = get_sub_field('arxiu_de_descarrega');
						echo '<div class="width100 minpadtop minpadbottom">
						<a target="_NEW" href="' . $data['url'] . '">' . $data['title'] . '</a>
						</div>';
					};
				?>		
				</div>
			<?php endif; ?>
				
		</div>

	</div>
	
	<?php 
	// Mostrar en el sidebar las páginas hijas de la página actual
	//primero cojo el ancestor
	$ancestors = get_post_ancestors( $post->ID );
	
	// me voy a la última posición del array puesto que es el padre (ancestor)
	if (count($ancestors)){ 
		$root = count($ancestors)-1;
		$parentId = $ancestors[$root];
		$ancestorTitle = get_the_title($parentId);
		$printSidebar = 1;
	}else{
		$printSidebar = 0;
		$ancestorTitle = get_the_title();
		
		// Busco si esta pagina tiene hijos
		$children = get_pages('child_of='.$post->ID);

	}
	?>
	
<?php 
wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); 

if (bp_is_blog_page()) { 
	include get_template_directory() . "/templates/pagesidebar.php"; 
}else{
	include get_template_directory() . "/templates/sidebar.php";
}
