
<?php get_header(); 
 
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
        <div class="cuadricula">
			
			<?php echo $id_empresa_get; ?>
<!--INICIO SELECT BOX EMPRESA-->
<select onChange="window.location.href=this.value" name="empresa" id="empresa">
	<option>EMPRESA</option>

                    <?php 				
				        $empresas = get_posts( array(
				            'post_type' => 'empresas_pt',
				            'posts_per_page' => -1,				            
				            'order' => 'ASC',
				        	) );
				        foreach ( $empresas as $empresa ):			 							         
					?>
								<option value="<?php ( get_page_by_title( 'bolsa-trabajos' ));?>?empresa=<?php echo $empresa->ID;?>&ciudad=<?php echo $id_ciudad_get;?>">
									<?php echo get_the_title( $empresa->ID); ?>
								</option>
                        <?php endforeach;?>
</select>
<!--FIN SELECT BOX EMPRESA-->

<!--INICIO SELECT BOX CIUDAD-->
<select name="ciudad" id="cambio_ciudad_JS">
					<?php 
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
									  }				     							  
					?>						    	
							<?php endforeach;?>
							
							<?php foreach ($ciudades as $ciudad):?>
								<option  value="<?php echo $ciudad;?>">
									<?php echo $ciudad; ?>
								</option>
							<?php endforeach;?>
														 							         
</select>
<!--FIN SELECT BOX CIUDAD-->

<?php 
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
    <?php get_footer(); ?>

