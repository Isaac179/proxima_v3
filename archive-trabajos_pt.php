<?php get_header(); ?> 
<div class="row cuerpo" id="inicio" >
<div class="row seccion-pagina">
        <div class="cuadricula">
            <div class="cuadro grande-1 medio-2 chico-12">
                <span>Vacantes</span>
            </div>
            <div class="cuadro medio-10 grande-11 chico-12 slider-home">
                <?php 
						
				        $trabajos = get_posts( array(
				            'post_type' => 'trabajos_pt',
				            'posts_per_page' => -1,
				            'orderby' => 'post_date', 
				            'order' => 'ASC',
				        ) );
				 			
				            foreach ( $trabajos as $trabajo ):
								$empresa_relacionada = get_post_meta( $trabajo->ID, 'empresa_relacionada_meta', true );
                                 $empresa_relacionada = $empresa_relacionada[0];
                            
						?>

                <div class="cuadro grande-4 chico-12 cuadro-trabajo" style="margin-bottom: 20px;border-bottom: 20px solid 
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
                        <!-- <a href="<?php echo get_post_type_archive_link( 'trabajos_pt' ) ?> ">Ver todas las ofertas de trabajo ></a> -->
                </div>  
            </div>
        </div>    
    </div>
    </div>
    <?php get_footer(); ?>

