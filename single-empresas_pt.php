<?php get_header(); ?>
<div class="row cuerpo">
    <div class="row seccion-pagina">
        <div class="columns grande-1 medio-2 chico-12">
            <span>Empresa</span>
        </div>
        
        <div class="columns medio-12 grande-11 chico-12"> 
                <?php $empresa = get_page_by_title('empresas_pt');
                    $img_empresa = get_the_post_thumbnail_url($empresa);
                    $image_id = get_post_thumbnail_id($empresa);
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                ?>
                <img style="width: 900px;" alt="<?php echo $image_alt  ?>" src="<?php echo $img_empresa ?>">
                <!-- <?php echo $empresa->post_content ?> -->
            </div>
        </div>

        <div class="row seccion-nosotros">
            <div class="columns grande-1 medio-2 chico-12">
                <span>Descripción</span>
            </div>

            <div class="columns medio-10 grande-11 chico-12 slider-home"> 
              
            </div>
    </div>

    <div class="row seccion-pagina">
        <div class="cuadricula">
            <div class="cuadro grande-1 medio-2 chico-12">
                <span>Vacantes</span>
            </div>
            <div class="cuadro medio-10 grande-11 chico-12 slider-home">
                <?php 
						
				        $trabajos = get_posts( array(
				            'post_type' => 'trabajos_pt',
				            'posts_per_page' => 3,
				            'orderby' => 'post_date', 
				            'order' => 'DESC',
				        ) );
				 			
				            foreach ( $trabajos as $trabajo ):
								$empresa_relacionada = get_post_meta( $trabajo->ID, 'empresa_relacionada_meta', true );
                                 $empresa_relacionada = $empresa_relacionada[0];
                            
						?>

                <div class="cuadro grande-4 chico-12 cuadro-trabajo" style="border-bottom: 20px solid 
                           <?php echo get_post_meta( $empresa_relacionada, 'color_destacado_meta', true ); ?>;"> <!-- Color Estilo -->
                           
                           <?php echo get_the_title( $trabajo->ID ); ?><br><br> <!-- Imprime Puesto -->
                           &nbsp;&nbsp;<?php echo get_the_title( $empresa_relacionada); ?><br><br> <!-- Imprime Empresa -->
                           <p class="fa fa-map-marker"> <?php echo get_post_meta( $empresa_relacionada, 'datos_destacado_meta', true ); ?> </p><br><!-- Imprime Ubicacion-->         
                           <a href="<?php echo get_permalink($trabajo->ID); ?>">Ver mas</a>
                           
                           <!-- echo "<a href='$link' title='$linktitle'>$linkname</a>"; -->
                               
                </div>
                <?php endforeach;?>
                <div class="row">
                    <br><br>
                        <a href="<?php echo get_post_type_archive_link( 'trabajos_pt' ) ?> ">Ver todas las ofertas de trabajo ></a>
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