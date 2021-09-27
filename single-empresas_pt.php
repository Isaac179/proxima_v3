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
            <div class="columns medio-12 grande-11 chico-12"> 
                <?php $nostros = get_page_by_title('empresa');
                    $img_nosotros = get_the_post_thumbnail_url($empresa->ID);
                    $image_id = get_post_thumbnail_id($empresa->ID);
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                ?>

                <?php echo $empresa->post_content ?>
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

if (!isset($_GET['empresa'])) {
    $id_empresa_get = "null";
} else{
        $id_empresa_get = $_GET['empresa'];
};
if (!isset($_GET['ciudad'])) {
    $id_ciudad_get = "null";
} else{
        $id_ciudad_get = $_GET['ciudad'];
};
?>
   
        <!-- <?php echo $id = get_the_ID(); ?> -->
        <?php  $id_empresa_get=$id; ?>
        
<?php 

if($id_empresa_get != 'null' && $id_ciudad_get == 'null'):
$trabajos = get_posts( array(
    'post_type' => 'trabajos_pt',
    'posts_per_page' => -1,
    'orderby' => 'post_date', 
    'meta_key' => 'empresa_relacionada_meta' ,
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'empresa_relacionada_meta',
            'value' => $id_empresa_get,
            'compare' => 'LIKE',
        )
    )
) );

elseif($id_empresa_get != 'null' && $id_ciudad_get != 'null'):

    $trabajos_all = get_posts( array(
        'post_type' => 'trabajos_pt',
        'posts_per_page' => -1,
        'orderby' => 'post_date', 
        'meta_key' => 'empresa_relacionada_meta' ,
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'empresa_relacionada_meta',
                'value' => $id_empresa_get,
                'compare' => 'LIKE',
            )
        )
    ) );

    $trabajos= array();

    foreach($trabajos_all as $trabajo):
        $sucursal_relacionada = get_post_meta( $trabajo->ID, 'sucursal_relacionada_meta', true ); 
        $sucursal_relacionada = $sucursal_relacionada[0];
        
        $nombre_ciudad = get_post_meta( $sucursal_relacionada, 'datos_sucursal_meta_ciudad', true ); 
        if($nombre_ciudad == $id_ciudad_get) {
            array_push($trabajos, $trabajo ); 
        }

    endforeach;

endif;

if(!empty($trabajos)):
foreach($trabajos as $trabajo):

$empresa_relacionada = get_post_meta( $trabajo->ID, 'empresa_relacionada_meta', true );
$empresa_relacionada = $empresa_relacionada[0];
$sucursal_relacionada = get_post_meta( $trabajo->ID, 'sucursal_relacionada_meta', true ); 
$sucursal_relacionada = $sucursal_relacionada[0];
?>

<div class="cuadro grande-4 chico-12 cuadro-trabajo" style="border-bottom: 20px solid 
                           <?php echo get_post_meta( $empresa_relacionada, 'color_destacado_meta', true ); ?>;"> <!-- Color Estilo -->
                           
                           <?php echo get_the_title( $trabajo->ID ); ?><br><br> <!-- Imprime Puesto -->
                           &nbsp;&nbsp;<?php echo get_the_title( $empresa_relacionada); ?><br><br> <!-- Imprime Empresa -->
                           <p class="fa fa-map-marker"> <?php echo get_the_title ($sucursal_relacionada); ?> </p><br><!-- Imprime Ubicacion-->         
                           <a href="<?php echo get_permalink($trabajo->ID); ?>">Ver mas</a>
                           <?php $emp =  get_the_title( $empresa_relacionada); ?>
                           <!-- echo "<a href='$link' title='$linktitle'>$linkname</a>"; -->
                               
                </div>

<?php endforeach; else:echo "No hay vacantes disponibles"; endif?>

                <div class="row">
                    <br><br>
                    
                        <?php
                         
                         $url = $_SERVER["HTTP_HOST"].'/sass-wp/bolsa-trabajos/?empresa='.$id; 
                         
                        ?>
                        <a href="<?php echo "http://" . $host . $url; ?>">Ver todas las ofertas de trabajo para <?php echo get_the_title( $empresa_relacionada); ?> ></a>
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
        
            <!-- <p>SIGUENOS EN FACEBOOK @PROXIMA</p> -->
            <!-- <?php echo '<pre>'; ?>
            <?php print_r($post);  ?>
            <?php echo '</pre>'; ?> -->
	</div>
    </div>
</div>
<?php get_footer(); ?>