<?php get_header(); ?>
<div class="row cuerpo" id="inicio" >

<div class="row seccion-pagina">
        <div class="columns grande-1 medio-2 chico-12">
            <span>Noticias</span>
            </div>
            <div class="columns medio-10 grande-11 chico-12">
                <!-- Slider main container -->
                <div class="swiper-container">
                <!-- Additional required wrapper -->
                <?php $nostros = get_page_by_title('nosotros');?>
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <a href="<?php echo get_permalink($nostros->ID) ?>" class="swiper-slide" style="background-image: url(http://www.temporal.sumario.mx/proxima/wp-content/uploads/2021/09/portada-metapath.png);padding: 40px 60px;background-size: cover;"></a>
                    <a href="<?php echo get_permalink($nostros->ID) ?>" class="swiper-slide" style="background-image: url(https://cognicert.com/wp-content/uploads/2021/06/iStock-135018895.jpg);padding: 40px 60px;background-size: cover;"></a>
                    <a href="<?php echo get_permalink($nostros->ID) ?>" class="swiper-slide" style="background-image: url(https://images.squarespace-cdn.com/content/v1/58d24ae4ff7c508a02bdce8a/1610752979680-XFF5CT2LFPFREL0A5WY8/funeral.png?format=750w);padding: 40px 60px;background-size: cover;"></a>
                </div> 
            </div>
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

                            $sucursales= get_posts( array(
								'post_type' => 'sucursales_pt',
								'posts_per_page' => -1,				            
				            	'order' => 'ASC',
				        	) ); 

							$ciudades= array(
								'ciudad'=> 'CIUDAD',
							);

							$j=0;
							foreach ( $sucursales as $sucursal ):

									  $nombre_ciudad = get_post_meta( $sucursal->ID, 'datos_sucursal_meta_ciudad', true ); 
									  if(!in_array($nombre_ciudad,$ciudades)){
										$ciudades[$j] = $nombre_ciudad; //SI NO ESTA LA AGREGA
										$j++;
                                        //  echo $nombre_ciudad.'-';echo get_the_title($sucursal->ID);
									  }
                                      
                            endforeach;
                                    
                            
				 			
				            foreach ( $trabajos as $trabajo):
								 $empresa_relacionada = get_post_meta( $trabajo->ID, 'empresa_relacionada_meta', true );
                                 $empresa_relacionada = $empresa_relacionada[0];
                                 $sucursal_relacionada = get_post_meta( $trabajo->ID, 'sucursal_relacionada_meta', true ); 
								 $sucursal_relacionada = $sucursal_relacionada[0];
                            
                                     
		    ?>

                <div class="cuadro grande-4 chico-12 cuadro-trabajo" style="border-bottom: 20px solid 
                           <?php echo get_post_meta( $empresa_relacionada, 'color_destacado_meta', true ); ?>;"> <!-- Color Estilo -->
                           
                           <b><?php echo get_the_title( $trabajo->ID ); ?></b><br><br> <!-- Imprime Puesto -->
                           &nbsp;&nbsp;<?php echo get_the_title( $empresa_relacionada); ?><br><br> <!-- Imprime Empresa -->
                           <p class="fa fa-map-marker">&nbsp;
                               <?php echo get_the_title ($sucursal_relacionada); ?> </p><br><!-- Imprime Ubicacion--> 
                                
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


	<div class="row seccion-empresa">
        <div class="cuadricula">
            <div class="cuadro grande-1 medio-2 chico-12">
                <span>Empresas</span>
            </div>
			
            <div class="cuadro medio-10 grande-11 chico-12 slider-home">
                <div class="row">
                    <div class="cuadricula">
                    <?php 
				        $empresas = get_posts( array(
				            'post_type' => 'empresas_pt',
				            'posts_per_page' => 4,
				            'orderby' => 'post_date', 
				            'order' => 'ASC',
				        ) );
				 			
				            foreach ( $empresas as $empresa ):
								$logo_empresa = get_post_meta( $empresa->ID, 'logo_destacado_meta', true ); 
                            
						?>
                            <div class="cuadro grande-3 medio-6 chico-12 cuadro-trabajo logo-empresa2">
                                <a href="<?php echo get_permalink($empresa->ID); ?>"><?php echo $logo_empresa; ?></a>
                            </div>
                            <?php endforeach;?>             
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="row seccion-nosotros">
            <div class="columns grande-1 medio-2 chico-12">
                <span>Nosotros</span>
            </div>

            <div class="columns medio-12 grande-11 chico-12"> 
                <?php $nostros = get_page_by_title('nosotros');
                    $img_nosotros = get_the_post_thumbnail_url($nostros->ID);
                    $image_id = get_post_thumbnail_id($nostros->ID);
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                ?>
                <img style="width: 900px;" alt="<?php echo $image_alt  ?>" src="<?php echo $img_nosotros  ?>">
                <?php echo $nostros->post_content ?>
            </div>
    </div>


    <div class="seccion-insta">
        <div class="cuadricula">
            <div class="cuadro grande-1 medio-2 chico-12">
                <span>Instagram</span>
            </div>
            <div class="cuadro medio-10 grande-11 chico-12 slider-home">
                <div class="row">
                    <div class="cuadricula">
                        <div class="cuadro grande-4 chico-12 cuadro-trabajo">
                           <a href="https://www.instagram.com/" target="_Blank"><img class="img-insta" src="<?php bloginfo('template_url'); ?>/images/proxima/proxima-instagram.png"></a>
                        </div>

                        <div class="cuadro grande-4 chico-12 cuadro-trabajo2">
                            <a href="https://www.instagram.com/" target="_Blank"><img class="img-insta" src="<?php bloginfo('template_url'); ?>/images/proxima/proxima-instagram.png"></a>
                        </div>

                        <div class="cuadro grande-4 chico-12 cuadro-trabajo3">
                            <a href="https://www.instagram.com/" target="_Blank"><img class="img-insta" src="<?php bloginfo('template_url'); ?>/images/proxima/proxima-instagram.png"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

						
</div>


<?php get_footer(); ?>