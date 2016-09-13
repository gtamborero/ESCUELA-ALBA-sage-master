<?php while (have_posts()) : the_post(); ?>
	<!-- SINGLE.PHP ENTRY -->
	<div class="albaContainer col-md-9 col-xs-12 medpadtop maxpadbottom">
		<div class="pull-right text-right"><?= get_the_date(); ?></div>
		<div class="iproTitle pull-left color1"><?php the_title(); ?></div>
		<div class="width100  color2"><?php $terms = get_the_term_list($post->ID,'category');  echo strip_tags( $terms );?></div>
		<div class="width100 iproLead minpadtop"><?php the_field('lead'); ?></div>
		<div class="width100 textleft minpadtop">
			<?php 
				$destacada = get_field('imatge-destacada');
				if( $destacada ){ ?>
					<img src="<?php echo $destacada['url']; ?>" alt="<?php echo $destacada['alt']; ?>" />
			<?php }	?>
			
			<div class="darkgrey minpadtop" ><?php the_content(); ?></div>
			
			<!-- VIDEO -->
			<?php
			$video = get_field('video');
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
				<div class="iproTitle color1 minpadtop minpadbottom">Galeria de fotos</div>
				<div class="width100 bgwhite minpad minpadtop minpadbottom minspacebottom">
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

<?php include get_template_directory() . "/templates/sidebar.php";
endwhile; ?>


