</div></div>

	<div class="width100" style="background-color:#f8f9fb;">
		<div class="container darkgrey textcenter minpadtop medpadbottom">
			<div class="col-sm-8 col-xs-12">
				5 logos
			</div>		
			<div class="col-sm-4 col-xs-12 pull-right">
				<?php dynamic_sidebar('footer'); ?>
			</div>
		</div>
	</div>
	
	<!-- FOOTER -->
	<a name="contacto"></a>
	<div class="width100 bgcolor1">
		<div class="container white ">
			<div class="col-sm-4 col-xs-12 responsivefootheight">
			<a href="/politica-cookies" class="white">Política de Cookies</a> &nbsp; <a href="/politica-privacitat" class="white">Avis Legal</a>
			</div>
			<div class="col-sm-4 col-xs-12 text-center minpadtop" style="padding-bottom:1%;>
				<a href="<?= esc_url(home_url('/')); ?>">
					<!--<img src="<?= get_template_directory_uri(); ?>/dist/images/logo-escola-ciutat-alba.png">-->
				</a>
			</div>	
			<div class="col-sm-4 col-xs-12 textright">
			Contacte
			</div>		
		</div>
	</div>

<script type='text/javascript' src='<?= get_template_directory_uri(); ?>/dist/scripts/grids.js'></script>

<script>
// COOKIES JQUERY
// VARIABLES
linkPoliticaCookies = "<?php echo get_site_url(); ?>/politica-cookies";
colorBoton = "#fff"
fondoBoton = "#00B7E0";
fondoOverBoton = "#20D7FF";
colorCookies = "#00B7E0";
colorOverCookies = "#20D7FF";

// COOKIES PREPARE
jQuery( document ).ready(function() {

	//eq heights
	var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
	if (!isSafari){
	jQuery('.iproRenderProductos').responsiveEqualHeightGrid();
	//jQuery('.iproRenderNoticias').responsiveEqualHeightGrid();
	}
	
    //MOSTRAR UNA SOLA VEZ
    function getCookieData( name ) {
        var pairs = document.cookie.split("; "),
            count = pairs.length, parts;
        while ( count-- ) {
            parts = pairs[count].split("=");
            if ( parts[0] === name )
                return parts[1];
        }
        return false;
    }
	
    var lacookie = getCookieData("lacookie");
    if ( lacookie == '') {

        //General CSS
        jQuery("body").prepend('<div id=cookieAlert></div>');
        jQuery("#cookieAlert").css("background-color", "#000");
        jQuery("#cookieAlert").css("color", "#eee");
        jQuery("#cookieAlert").css("text-align", "center");
        jQuery("#cookieAlert").css("padding", "15px");
		jQuery("#cookieAlert").css("line-height", "24px");

        // TEXTO
        jQuery("#cookieAlert").html("Utilizamos cookies propias y de terceros para mejorar nuestros servicios, mediante el análisis de su navegación por nuestro website. Si continua navegando, consideramos que acepta su uso. Puede cambiar la configuración u obtener más información <a id=cookies href="+ linkPoliticaCookies +">aquí</a>. &nbsp; <a id=acepto>Acepto</a> ");
    
        jQuery("#cookieAlert a").css("cursor", "pointer");

        jQuery("#cookieAlert #acepto").css("padding", "5px 9px");
        jQuery("#cookieAlert #acepto").css("background-color", fondoBoton);
		
        jQuery("#cookieAlert #acepto").mouseenter(function(){
            jQuery("#cookieAlert #acepto").css("background-color", fondoOverBoton);
        }).mouseleave(function(){
            jQuery("#cookieAlert #acepto").css("background-color", fondoBoton);
        });
        jQuery("#cookieAlert #acepto").css("color", colorBoton);
        jQuery("#cookieAlert #acepto").click(function(){
            jQuery("#cookieAlert").hide("fast");
            document.cookie = 'lacookie=1; path=/';
            //console.log(document.cookie);
        });

        // Link politica cookies
        jQuery("#cookieAlert #cookies").css("color", colorCookies);
        jQuery("#cookieAlert #cookies").mouseenter(function(){
        jQuery("#cookieAlert #cookies").css("color", colorOverCookies);
        }).mouseleave(function(){
        jQuery("#cookieAlert #cookies").css("color", colorCookies);
        });
    };
    
    jQuery('.wpcf7-submit').prop('title', 'Recuerde aceptar la política de cookies');
});
// COOKIES FIN

</script>