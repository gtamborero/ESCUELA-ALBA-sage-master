<div class="iproSidebar iproSidebarUp col-md-3 col-xs-12">

<?php if (current_user_can('edit_posts')){ ?>

	<!-- User post system -->
	<section class="widget_categories"><h3>Publicar Novetats</h3>		
		<ul>
			<li class="cat-item cat-item-24"><a href="/nova-entrada">Crear Novetat</a></li>
			<li class="cat-item cat-item-22"><a href="/entrades">Editar novetats</a></li>
		</ul>
	</section>
	<br />&nbsp;<br />

<?php }
dynamic_sidebar('sidebar-primary'); 
?>
</div>