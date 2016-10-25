<?php while (have_posts()) : the_post(); ?>
	<!-- SINGLE.PHP ENTRY -->
	<div class="albaContainer col-md-9 col-xs-12 maxpadtop maxpadbottom">
		<div class="pull-right text-right"><?= get_the_date(); ?></div>
		<div class="iproTitle pull-left color1"><?php the_title(); ?></div>
		<div class="color2 clearboth" style="padding:0px 10px 8px 0px"><?php $terms = get_the_term_list($post->ID,'category' , '', ' / ');  echo strip_tags( $terms );?></div>
		<div class="width100 iproLead minpadtop"><?php the_field('lead'); ?></div>
		<div class="width100 textleft minpadtop maxsize">
			<?php
				$destacada = get_field('imatge-destacada');
				$size ="large";
				if( $destacada ){ ?>
					<?php echo wp_get_attachment_image( $destacada, $size ); ?>
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
			<?php endif; ?>

			<!-- DOWNLOADS -->
			<div class="iproDownloads iproTitle color1 minpadbottom">Descàrregues</div>
			<div class="iproDownloads width100 bgwhite minpad minpadtop minpadbottom">
			<!-- Oculto por defecto descargas -->
			<style>div.iproDownloads {display:none;}</style>
			<?php
				while ( have_rows('descarregas') ) {
					the_row();
					$data = get_sub_field('arxiu_de_descarrega');
					echo '
					<a target="_NEW" href="' . $data['url'] . '"><div class="width100 minpadtop minpadbottom">
					<img style="width:30px; margin: 0px 15px;" src="' . get_template_directory_uri() . '/dist/images/download.png">' . $data['title'] . '</div></a>';
					// Muestro descargas si el primer valor es válido
					if ($data['url']!="") { echo "<style>div.iproDownloads {display:block;}</style>"; }
				};
			?>
			</div>
		</div>

	</div>

<?php include get_template_directory() . "/templates/sidebar.php";
endwhile; ?>
