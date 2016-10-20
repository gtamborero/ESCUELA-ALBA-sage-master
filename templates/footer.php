</div></div>

	<div class="width100" style="background-color:#fff;">
		<div class="container darkgrey textcenter minpadtop medpadbottom">
			<div class="col-sm-12 col-xs-12 minpadtop minspacetop">
				<div style="width:70%; margin-left:15%; text-align:center;">
				
				<!-- LOGOS -->
				<div class="logos-md-style">
					<a href="https://www.paidos.cat/serveis/Ciutat-d-Alba/Menjador/Menu-del-mes" target="_new">
					<div class="col-md-6 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/menjador.jpg">
						<br /><br />ESPAI MIGDIA
					</div>
					</a>
					<a href="https://www.paidos.cat/serveis/Ciutat-d-Alba/Extraescolars" target="_new">
					<div class="col-md-6 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/extraescolars.jpg">
						<br /><br />EXTRAESCOLARS
					</div>
					</a>
				</div>
					
					<a href="https://www.facebook.com/Comissi%C3%B3-Groga-Escola-Ciutat-dAlba-245535395598564/" target="_new">
					<div class="col-md-4 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/sos.jpg">
						<br /><br />SOS ENSENYAMENT
					</div>
					</a>
					<a href="http://www.somescola.cat/" target="_new">
					<div class="col-md-4 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/som.jpg">
						<br /><br />SOM ESCOLA
					</div>
					</a>
					<a href="http://www.fapac.cat/sosmenjadors" target="_new">
					<div class="col-md-4 col-sm-6 col-xs-6 text-center maxpadbottom">
						<img style="text-align:center; max-width:100px;" src="<?= get_template_directory_uri(); ?>/dist/images/sos-menjador.jpg">
						<br /><br />SOS MENJADORS
					</div>
					</a>
				</div>
			</div>		
			<div class="col-sm-6 col-xs-12">
				<div style="width:90%; margin-left:5%;">
					<?php dynamic_sidebar('footer'); ?>
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div style="width:90%; margin-left:5%;">
					<?php dynamic_sidebar('footer2'); ?>
				</div>
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
			<a href="/politica-cookies" class="white">Política de Cookies</a> &nbsp; <a href="/avis-legal" class="white">Avis Legal</a>
			
				
			</div>	
			<div class="col-sm-4 col-xs-12 minpadtop textright medline">
			<a href="https://twitter.com/eciutatdalba" target="_new"><img style="max-width:25px; margin-right:15px;" src="<?= get_template_directory_uri(); ?>/dist/images/twitter.png"></a>
			<a href="mailto:a8064118@xtec.cat"><img style="max-width:25px; margin-right:15px;" src="<?= get_template_directory_uri(); ?>/dist/images/mail.png"></a>
		<!--	<a href="https://www.facebook.com/pages/Escola-Ciutat-dAlba/441459199198826" target="_new""><img style="max-width:25px; margin-right:15px;" src="<?= get_template_directory_uri(); ?>/dist/images/facebook.png"></a> -->
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
			//Set expire cookie
			var now = new Date();
			now.setTime(now.getTime() + 1 * 360000000);
			document.cookie = 'lacookie=1; expires=' + now.toUTCString() + '; path=/';
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