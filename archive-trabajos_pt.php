<?php get_header(); ?> 
<div class="row cuerpo" id="inicio" >
<div class="row seccion-pagina">
        <div class="cuadricula">
<!--INICIO SELECT BOX EMPRESA-->
<select name="empresa" id="empresa">
	<option>EMPRESA</option>

                    <?php 				
				        $empresas = get_posts( array(
				            'post_type' => 'empresas_pt',
				            'posts_per_page' => -1,				            
				            'order' => 'ASC',
				        	) );
				        foreach ( $empresas as $empresa ):			 							         
					?>
								<option>
									<?php echo get_the_title( $empresa->ID); ?>
								</option>
                        <?php endforeach;?>
</select>
<!--FIN SELECT BOX EMPRESA-->

<!--INICIO SELECT BOX CIUDAD-->
<select name="ciudad" id="ciudad">
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
									  if(in_array($nombre_ciudad,$ciudades)){
										//SI LA CIUDAD YA EXISTE EN EL ARREGLO NO LA AGREGA
									  }else{
										$ciudades[$j] = $nombre_ciudad; //SI NO ESTA LA AGREGA
										$j++;
									  }				     							  
					?>						    	
							<?php endforeach;?>
							
							<?php foreach ($ciudades as $ciudad):?>
								<option>
									<?php echo $ciudad; ?>
								</option>
							<?php endforeach;?>	
														 							         
</select>
<!--FIN SELECT BOX CIUDAD-->

            <div class="cuadro medio-12 grande-12 chico-12 slider-home">
                <?php 
						
				        $trabajos = get_posts( array(
				            'post_type' => 'trabajos_pt',
				            'posts_per_page' => -1,
				            'orderby' => 'post_date', 
				            'order' => 'DESC',
				        ) );

						$sucursales = get_posts( array(
				            'post_type' => 'sucursales_pt',
				            'posts_per_page' => -1,
				            'orderby' => 'post_date', 
				            'order' => 'DESC',
				        ) );

						echo $sucursal_relacionada = get_post_meta( $sucursal->ID, 'sucursal_relacionada_meta', true );

				        foreach ( $trabajos as $trabajo ):
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
						  
                <?php endforeach;?>
                <div class="row">
                    <br><br>
                </div>  
            </div>
        </div>    
    </div>
    </div>
    <?php get_footer(); ?>

