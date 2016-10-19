	<!-- PAGE.PHP PAGE -->
	<div class="albaContainer col-md-9 col-xs-12 maxpadtop minpadbottom">
		<div class="iproTitle pull-left color1"><?php the_title(); ?></div>
		<?php if (get_field('lead')){ ?>
			<div class="width100 iproLead minpadtop"><?php the_field('lead'); ?></div>
		<?php } ?>

		<div class="width100 textleft minpadtop">
			<?php
			  if (has_post_thumbnail()) {
				echo get_the_post_thumbnail( '', 'large' );
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

	<?php
	// Mostrar en el sidebar las páginas hijas de la página actual
	//primero cojo el ancestor por si estamos en una subpágina.
	$ancestors = get_post_ancestors( $post->ID );
	//var_dump($ancestors);


	// me voy a la última posición del array puesto que es el padre (ancestor)
	if (count($ancestors)){
		$root = count($ancestors)-1;
		$parentId = $ancestors[$root];
		$ancestorTitle = get_the_title($parentId);
		$printSidebar = 1;
	}else{
		$printSidebar = 0;
		$parentId = 0;
	}
	?>

	<?php
	wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']);

	if ($printSidebar){ ?>
	<div class="iproSidebar iproSidebarUp col-md-3 col-xs-12">
		<section class="widget_categories"><h3><?php echo $ancestorTitle; ?></h3>
		<ul>
		<?php
		//Listo todos los títulos de página de la página padre definida $parentId
		$args = array(
			'post_parent' => $parentId,
			'post_type'   => 'any',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_status' => 'any'
		);

		if ($parentId){
			$childrenPages = get_children( $args );
			foreach ($childrenPages as $child){
				echo '<li><a class="pagechild';
				if ($child->ID == get_the_ID()) echo ' current';
				echo '" href="' . get_permalink($child->ID) . '">';
				echo $child->post_title;
				echo '</a></li>';
			}
			// Caso estrambotico: Si estamos en el apartado de ampa mostramos link a documentos:
			if ($parentId == 160){
				echo '<li><a class="pagechild';
				if (173 == get_the_ID()) echo ' current';
				echo '" href="/doc-privat/assemblees/">Documents</a></li>';
			}
		}

		?>
		</ul>
		</section>
	</div>


	<?php
	}else{
		include get_template_directory() . "/templates/sidebar.php";
	}
