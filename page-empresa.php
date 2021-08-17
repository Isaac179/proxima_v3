<?php get_header(); ?>
<div class="row cuerpo">
    <div class="row seccion-pagina">
        <div class="columns grande-1 medio-2 chico-12">
            <span>Noticias</span>
        </div>
        <div class="columns medio-10 grande-11 chico-12 slider-home">
            <!-- Slider main container -->
			<div class="swiper-container">
			<!-- Additional required wrapper -->
            <?php $nostros = get_page_by_title('nosotros');?>
			<div class="swiper-wrapper">
				<!-- Slides -->
				<img src="https://www.temporal.sumario.mx/proxima/wp-content/themes/proxima-theme/images/lapcit-portada.png" alt="">
			</div> 
		</div>
        </div>
        </div>


        <div class="row seccion-nosotros">
            <div class="columns grande-1 medio-2 chico-12">
                <span>Descripción</span>
            </div>

            <div class="columns medio-10 grande-11 chico-12 slider-home"> 
                <?php $nostros = get_page_by_title('nosotros');
                    $img_nosotros = get_the_post_thumbnail_url($nostros->ID);
                    $image_id = get_post_thumbnail_id($nostros->ID);
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                ?>
                <!--<img alt="<?php echo $image_alt  ?>" src="<?php echo $img_nosotros  ?>">-->
                <?php echo $nostros->post_content ?>
            </div>
    </div>



    <div class="row seccion-pagina">
        <div class="cuadricula">
            <div class="cuadro grande-1 medio-2 chico-12">
                <span>Vacantes</span>
            </div>
            <div class="cuadro medio-10 grande-11 chico-12 slider-home">
                <div class="row">
                    <div class="cuadricula">
                        <div class="cuadro grande-4 chico-12 cuadro-trabajo">
                            <p>Patólogo anátomo</p>
                            <p>&nbsp;&nbsp;Valparaiso</p>
                            &nbsp;&nbsp;<p class="fa fa-map-marker">Tepic Nayarit</p>
                            <br>
                            <a>Ver mas</a>
                        </div>

                        <div class="cuadro grande-4 chico-12 cuadro-trabajo2">
                            <p>Patólogo anátomo</p>
                            <p>&nbsp;&nbsp;Valparaiso</p>
                            &nbsp;&nbsp;<p class="fa fa-map-marker"> Tepic Nayarit</p>
                            <br>
                            <a>Ver mas</a>
                        </div>

                        <div class="cuadro grande-4 chico-12 cuadro-trabajo3">
                            <p>Patólogo anátomo</p>
                            <p>&nbsp;&nbsp;Valparaiso</p>
                            &nbsp;&nbsp;<p class="fa fa-map-marker"> Tepic Nayarit</p>
                            <br>
                            <a>Ver mas</a>
                        </div>
                    </div>
                    <br><br>
                        <a href="">Ver todas las ofertas de trabajo ></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row seccion-pagina">
        <div class="columns grande-1 medio-2 chico-12">
            <span>Galeria</span>
        </div>
        <div class="columns medio-10 grande-11 chico-12 slider-home">
            <!-- Slider main container -->
			<div class="swiper-container-empresa">
			<!-- Additional required wrapper -->
            <?php $nostros = get_page_by_title('nosotros');?>
			<div class="swiper-wrapper">
				<!-- Slides -->
				<a href="<?php echo get_permalink($nostros->ID) ?>" class="swiper-slide" style="background-image: url(https://www.temporal.sumario.mx/proxima/wp-content/themes/proxima-theme/images/galeria-lapcit.png);padding: 40px 60px; background-size:cover;"></a>
			</div> 
		</div>
        </div>
        </div>


<div class="row footer-proxima">
	<div class="row">
    <div class="row pre-footer">
            <p>SIGUENOS EN FACEBOOK @PROXIMA</p>
	</div>
    </div>
</div>
<?php get_footer(); ?>