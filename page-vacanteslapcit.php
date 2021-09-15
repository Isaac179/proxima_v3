<?php get_header(); ?> 



<style type="text/css">

			
			ul, ol {
        z-index:120;
				list-style:none;
			}
			
			.nav > li {
				float:left;
        
			}
			
			.nav li a {
				background-color:#000;
				color:#fff;
				text-decoration:none;
				padding:10px 12px;
				display:block;
			}
			
			.nav li a:hover {
				background-color:#434343;
			}
			
			.nav li ul {
				display:none;
				position:absolute;
				min-width:140px;
			}
			
			.nav li:hover > ul {
				display:block;
			}
			
			.nav li ul li {
				position:relative;
			}
			
			.nav li ul li ul {
				right:-140px;
				top:0px;
			}
			
		</style>






<div class="row cuerpo" id="inicio" >
<div class="row seccion-pagina">
        <div class="cuadricula">
            <!-- <div class="cuadro grande-1 medio-2 chico-12">
                <span>Vacantes</span>
            </div> -->

			<div id="header">
			<ul class="nav">
				<li><a href="">Empresa:</a>
					<ul>
						<li><a href="<?php bloginfo('url'); ?>/vacanteslapcit">Valparaiso</a></li>
						<li><a href="<?php bloginfo('url'); ?>/vacanteslapcit">Metapath</a></li>
						<li><a href="<?php bloginfo('url'); ?>/vacanteslapcit">Lapcit</a></li>
						<li><a href="<?php bloginfo('url'); ?>/vacanteslapcit">Columba</a></li>
            			<li><a href="<?php bloginfo('url'); ?>/vacantescencal">Cencal</a></li>
						<li><a href="<?php echo get_post_type_archive_link( 'trabajos_pt' ); ?>">Todas</a></li>
					</ul>
				</li>

			</ul>
		</div>
  <?php $select='19276' ?>

<!-- <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Search.." name="search2">
  <button type="submit"><i class="fa fa-search"></i></button>
</form> -->


            <div class="cuadro medio-12 grande-12 chico-12 slider-home">
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

            <?php
            if ($empresa_relacionada ==$select):
             ?>

                          <div class="cuadro medio-6 grande-12 chico-12 slider-home cuadro-trabajo" style="margin-bottom: 20px;border-bottom: 20px solid 
                           <?php echo get_post_meta( $empresa_relacionada, 'color_destacado_meta', true ); ?>;"> <!-- Color Estilo -->
                           
                           <b><?php echo get_the_title( $trabajo->ID ); ?></b><br><br> <!-- Imprime Puesto -->
                           &nbsp;&nbsp;<?php echo get_the_title( $empresa_relacionada); ?><br><br> <!-- Imprime Empresa -->
                           <p class="fa fa-map-marker"> <?php echo get_post_meta( $empresa_relacionada, 'datos_destacado_meta', true ); ?> </p><br><!-- Imprime Ubicacion-->         
                           <a href="<?php echo get_permalink($trabajo->ID); ?>">Ver mas</a>
                           
                           <!-- echo "<a href='$link' title='$linktitle'>$linkname</a>"; -->     
                          </div>

     
                <?php endif;?>
                
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

