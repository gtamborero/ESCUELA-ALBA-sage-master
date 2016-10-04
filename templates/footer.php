</div></div>

	<div class="width100" style="background-color:#fff;">
		<div class="container darkgrey textcenter minpadtop medpadbottom">
			<div class="col-sm-8 col-xs-12 minpadtop minspacetop">
				<div style="width:80%; margin-left:10%; text-align:center;">
				
				<!-- LOGOS -->
					<a href="">
					<div class="col-md-6 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/menjador.jpg">
						<br /><br />ESPAI MIGDIA
					</div>
					</a>
					<a href="">
					<div class="col-md-6 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/extraescolars.jpg">
						<br /><br />EXTRAESCOLARS
					</div>
					</a>
					<a href="">
					<div class="col-md-4 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/sos.jpg">
						<br /><br />SOS ENSENYAMENT
					</div>
					</a>
					<a href="">
					<div class="col-md-4 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/som.jpg">
						<br /><br />SOM ESCOLA
					</div>
					</a>
					<a href="">
					<div class="col-md-4 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/sos-menjador.jpg">
						<br /><br />SOS MENJADOR
					</div>
					</a>
				</div>
			</div>		
			<div class="col-sm-4 col-xs-12 pull-right">
				<?php dynamic_sidebar('footer'); ?>
			</div>
		</div>
	</div>
	
	<!-- FOOTER -->
	<a name="contacto"></a>
	<div class="width100 bgcolor1 minpadtop minpadbottom">
		<div class="container white ">
			<div class="col-sm-4 col-xs-12 responsivefootheight">
				<a href="<?= esc_url(home_url('/')); ?>">
					<img style="max-width:240px; width:80%;" src="<?= get_template_directory_uri(); ?>/dist/images/escola-ciutat-alba.png">
				</a>
			</div>
			<div class="col-sm-4 col-xs-12 text-center medline">
			C/Pere Ferrer, 5, 08195 Sant Cugat del Vallès - 93.578.40.33 - a8064118@xtec.cat<br />
			<a href="/politica-cookies" class="white">Política de Cookies</a> &nbsp; <a href="/politica-privacitat" class="white">Avis Legal</a>
			
				
			</div>	
			<div class="col-sm-4 col-xs-12 minpadtop textright medline">
			<a href=""><img style="max-width:25px; margin-right:15px;" src="<?= get_template_directory_uri(); ?>/dist/images/twitter.png"></a>
			<a href=""><img style="max-width:25px; margin-right:15px;" src="<?= get_template_directory_uri(); ?>/dist/images/mail.png"></a>
			<a href=""><img style="max-width:25px; margin-right:15px;" src="<?= get_template_directory_uri(); ?>/dist/images/facebook.png"></a>
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