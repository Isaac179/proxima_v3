<?php get_header(); 

/*
Template Name: Search Page
*/

global $query_string;

wp_parse_str($query_string, $search_query);
$search = new WP_Query( $search_query);

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

<div class="row cuerpo" id="inicio" >
<div class="row seccion-pagina">
<div class="cuadricula" style="padding-left: 20px;"><br>
<?php get_search_form(); ?>
<h3>Resultados para la búsqueda:&nbsp;<?php echo '"'.$s.'"'; ?></h3>

<br>
<?php
$id_empresa_get = $s;
if($id_empresa_get == 'null' && $id_ciudad_get == 'null'):
	$trabajos = get_posts( array(
		'post_type' => 'trabajos_pt',
		'posts_per_page' => -1,
		'orderby' => 'post_date', 
		'order' => 'DESC',
	) );

elseif($id_empresa_get != 'null' && $id_ciudad_get == 'null'):
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

elseif($id_empresa_get == 'null' && $id_ciudad_get != 'null'):
	$trabajos_all = get_posts( array(
		'post_type' => 'trabajos_pt',
		'posts_per_page' => -1,
		'orderby' => 'post_date', 
		'order' => 'DESC',
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

							<div class="cuadro medio-6 grande-12 chico-12 slider-home cuadro-trabajo" style="margin-bottom: 20px;border-bottom: 20px solid 
                           <?php echo get_post_meta( $empresa_relacionada, 'color_destacado_meta', true ); ?>;"> <!-- Color Estilo -->
                           
                           <b><?php echo get_the_title( $trabajo->ID ); ?></b><br><br> <!-- Imprime Puesto -->
                           &nbsp;&nbsp;<?php echo get_the_title( $empresa_relacionada); ?><br><br> <!-- Imprime Empresa --> 
                           <p class="fa fa-map-marker"> <?php echo get_the_title ($sucursal_relacionada); ?> </p><br><!-- Imprime Ubicacion-->         
						 
						   <a href="<?php echo get_permalink($trabajo->ID); ?>">Ver mas</a>
                           
                           <!-- echo "<a href='$link' title='$linktitle'>$linkname</a>"; -->     
                          </div>

<?php endforeach; else:echo "No hay vacantes disponibles para esta busqueda!"; endif?>

			<!--FIN FOREACH-->
        </div>    
    </div>
    </div>
	
	<!-- <?php echo $search_query = get_search_query(); ?> -->
	
	<?php
	$args = array(
		'post_type' => 'trabajos_pt',
		// 's' 		=> $s,
	);
	$results = new WP_Query($args);
	foreach ($results->posts as $post) {
			echo $post->post_title;
	}
	wp_reset_postdata();
	?>

</div>
</div>

<?php get_footer(); ?>