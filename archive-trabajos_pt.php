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


<div class="row cuerpo"><br>
<div class="row seccion-pagina" style="padding-bottom:0px">
<div class="cuadricula" style="padding-left: 20px;">
			
<!-- <?php echo $id_empresa_get; ?> -->

<?php get_search_form(); ?>

<!-- <div><a class="banana">Banana</a></div> -->

<!--INICIO SELECT BOX EMPRESA-->
<select class="cambio_selector_JS valor_empresa" name="empresa" >
	<option value="null">EMPRESA</option>

                    <?php 				
				        $empresas = get_posts( array(
				            'post_type' => 'empresas_pt',
				            'posts_per_page' => -1,				            
				            'order' => 'ASC',
				        	) );
				        foreach ( $empresas as $empresa ):			 							         
					?>
								<option value="<?php echo $empresa->ID;?>">
									<?php echo get_the_title( $empresa->ID); ?> 
								</option>
                        <?php endforeach;?>
</select>
<!--FIN SELECT BOX EMPRESA-->

			
<!--INICIO SELECT BOX CIUDAD-->
<select class="cambio_selector_JS valor_ciudad" name="ciudad">
<option value="null">CIUDAD</option>
					<?php 
							$sucursales= get_posts( array(
								'post_type' => 'sucursales_pt',
								'posts_per_page' => -1,				            
				            	'order' => 'ASC',
				        	) ); 

							$ciudades= array();

							$j=0;
							foreach ( $sucursales as $sucursal ):

									  $nombre_ciudad = get_post_meta( $sucursal->ID, 'datos_sucursal_meta_ciudad', true ); 
									  if(!in_array($nombre_ciudad,$ciudades)){
										$ciudades[$j] = $nombre_ciudad; //SI NO ESTA LA AGREGA EL ELEMENTO AL ARRAY
										$j++;
									  }
							endforeach				     							  
					?>						    	
														
							<?php foreach ($ciudades as $ciudad):?>
								<option  value="<?php echo $ciudad;?>">
									<?php echo $ciudad; ?>
								</option>
							<?php endforeach;?>
														 							         
</select> <br><br>
<!--FIN SELECT BOX CIUDAD-->
</div>
</div>
</div>

<div class="row cuerpo" id="inicio" style="padding-top:0px">
<div class="row seccion-pagina">
<div class="cuadricula" style="padding-left: 20px;">
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
                           <p class="fa fa-map-marker">&nbsp;</p> <?php echo get_the_title ($sucursal_relacionada); ?>
                           <!-- <p><?php echo get_the_title ($sucursal_relacionada); ?> </p><br>Imprime Ubicacion  -->
                           </b><br> 
                           <a style="text-decoration:none; color: black" href="<?php echo get_permalink($trabajo->ID); ?>">Ver más</a> 
                          </div>

<?php endforeach; else:echo "No hay vacantes disponibles para esta busqueda!"; endif?>

			<!--FIN FOREACH-->
        </div>    
    </div>
    </div>
    <?php get_footer(); ?>

