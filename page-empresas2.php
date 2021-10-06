<?php get_header(); ?>
<div class="row cuerpo" id="inicio" >
<div class="row seccion-nosotros">
            <div class="columns grande-1 medio-2 chico-12">
                <span></span>
            </div>

            <div class="columns medio-12 grande-11 chico-12"> 
                <?php $nostros = get_page_by_title('nosotros');
                    $img_nosotros = get_the_post_thumbnail_url($nostros->ID);
                    $image_id = get_post_thumbnail_id($nostros->ID);
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                ?>
                <!-- <img style="width: 900px;" alt="<?php echo $image_alt  ?>" src="<?php echo $img_nosotros  ?>">
                 -->
            </div>
    </div>

    	<div class="row seccion-empresa">
        <div class="cuadricula">
            <div class="cuadro grande-1 medio-2 chico-12 titulos">
                <h5>Empresas</h5>
            </div>
			
            <div class="cuadro medio-10 grande-11 chico-12 slider-home">
                <div class="row ">
                    <div class="cuadricula">
                    <?php 
				        $empresas = get_posts( array(
				            'post_type' => 'empresas_pt',
				            'posts_per_page' => -1,
				            'orderby' => 'post_date', 
				            'order' => 'DECS',
				        ) );
				 			
				            foreach ( $empresas as $empresa ):
								$logo_empresa = get_the_post_thumbnail_url( $empresa->ID, 'logo_destacado_meta', true );
                                                                 
						?>
                            <div class="cuadro grande-6  chico-12 cuadro-trabajo logo-empresa2 wrap">
                               <a href="<?php echo get_permalink($empresa->ID); ?>"><img style="width: 450px;" src="<?php echo $logo_empresa; ?>"></a>
                            </div>
                            <?php endforeach;?>             
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php get_footer(); ?>