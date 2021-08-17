<?php

/**
 * En este archivo se incluyen los hooks de woscommerce
 *
 */


/** ==============================================================================================================
 *                                                HOOKS
 *  ==============================================================================================================
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

add_filter( 'woocommerce_product_description_heading', '__return_null' );


add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

add_action( 'woocommerce_after_single_product_summary', 'mesas_pale' );
add_action( 'woocommerce_product_meta_start', 'caracteristicas_pastel' );  
add_action( 'woocommerce_product_meta_start', 'diagrama_pastel' );  

/** ==============================================================================================================
 *                                               SCRIPTS
 *  ==============================================================================================================
 */

// incluye el functions.js
function mesas_pale(){
	global $product;
	$id_producto = $product->id; 
	$img_ids = cltvo_todosIdsImgsDelPost($id_producto);
	$img_gal = array( );
	foreach ($img_ids as $img_id ){
		$valor = get_post_meta($img_id, 'daniel_tamano_img_meta', true); 
			if ($valor == 'Mesas Pale'){
				$img_url = wp_get_attachment_image_src($img_id, 'tamano_foto_post', true);	
				$img_gal[] = array( "id" => $img_id , "url" => $img_url[0] );
			}
	} ;
	if(count($img_gal) >= 1):
	?>	
			<div class="row">
				<h2>Mesas Pale con este pastel </h2>
				

				</div>
				<div class="row slider-mesas">
		
					<div class="swiper-container s3">
				    	<div class="swiper-wrapper">
						


				        <?php foreach ($img_gal as $img_gal_in): ?>
				          		<div class="swiper-slide">  
				          			<div class="imagen-mesas" style="background-image: url('<?php echo  $img_gal_in['url']; ?>');"></div>  
									
					            </div>  
				                
				            
				        <?php endforeach; ?>
						 </div>
				        <div class="swiper-pagination"></div>
				    </div>
					
				</div>
				
				
	<?php
	endif;
}
// incluye el functions.js
function diagrama_pastel(){
	global $product;
	$id_producto = $product->id; 
	$img_ids = cltvo_todosIdsImgsDelPost($id_producto);
	$img_gal = array( );
	foreach ($img_ids as $img_id ){
		$valor = get_post_meta($img_id, 'daniel_tamano_img_meta', true); 
			if ($valor == 'Diagrama pastel'){
				$img_url = wp_get_attachment_image_src($img_id, 'tamano_foto_post', true);	
				$img_gal[] = array( "id" => $img_id , "url" => $img_url[0] );
			}
	} ;
	if(count($img_gal) >= 1):
	?>	
			<div >
				<h2>Tamaños</h2>
				

				</div>
				<div class=" diagrama-pastel">
				
				        <?php foreach ($img_gal as $img_gal_in): ?>
				          		
				          			<img src="<?php echo  $img_gal_in['url']; ?>">
							
				                
				            
				        <?php endforeach; ?>
				</div>
				       
				 
				
				
	<?php
	endif;
}
function caracteristicas_pastel(){
	global $product;
	$id_producto = $product->id; 
	$caracteristicas = get_post_meta($id_producto, 'pale_caracteristicas_meta', true); 
	$title = get_the_title();
	$titlewa = preg_replace('/\s+/', '%20', $title);

	?>	
		<div class="pedir-pastel ">
			Pide este pastel:
				
				<div class="centered-links">
					<a href="https://api.whatsapp.com/send?phone=5215527652246&text=¡Hola%20pale!,%20Me%20gustaría%20pedir%20<?php echo  $titlewa; ?>." target="_Blank" class="derecha"><img src="<?php bloginfo('template_url');?>/images/whatsapp-blanco.svg" class="icono-contacto"/>Whatsapp</span></a>
					<a href="tel:333 6417823" target="_Blank" class="izquierda"> <img src="<?php bloginfo('template_url');?>/images/telefono-blanco.svg" class="icono-contacto"/><span>333 6417823</span></a>
				</div>

		</div>
	<?php
	if(count($caracteristicas) >= 1):
	?>	
				
		
				<div class=" caracteristicas-pastel">
					
					<table style="width:100%">
					  
								  
				        <?php foreach ($caracteristicas as $caracteristica ):
				        	$titulo_caracteristica = get_the_title( $caracteristica );
				        	$image_id = get_post_thumbnail_id( $caracteristica );
				        	$image =  wp_get_attachment_image_src( $image_id );

				         ?>		
				         <tr>
						    <td class="imagen-cara"><img src="<?php echo $image[0]?>" class="icono-cara"/></td>
						    <td><?php echo  $titulo_caracteristica; ?></td>
						   
						  </tr>
				            
				        <?php endforeach; ?>
				    </table>
				</div>
				       
				 
				
				
	<?php
	endif;
}

/**
 * En este archivo se incluyen los hooks de woscommerce
 *
 */


/** ==============================================================================================================
 *                                                HOOKS
 *  ==============================================================================================================
 */
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
//  add_action( 'woocommerce_after_single_product_summary', 'despues_sumario' ); // incluye el admin-functions.js. Descomentar para tener JS en admin (no olvidar crear el file [admin-functions.js])

//  add_action( 'woocommerce_before_single_product_summary', 'antes_galeria' ); // incluye el admin-functions.js. Descomentar para tener JS en admin (no olvidar crear el file [admin-functions.js])




add_action( 'after_setup_theme', 'yourtheme_setup' );
 
function yourtheme_setup() {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
     unset( $tabs['reviews'] ); 
    return $tabs;
}
add_action( 'woocommerce_before_add_to_cart_form', 'woocommerce_product_description_tab', 2 );
 

/** ==============================================================================================================
 *                                               Metadatos Categorías
 *  ==============================================================================================================
 */

//Product Cat Create page
function wh_taxonomy_add_new_meta_field() {
    ?>
        
    <div class="form-field">
        <label for="wh_meta_title"><?php _e('Mostrar en Homepage', 'wh'); ?></label>
        <input  type="checkbox" name="wh_meta_title" id="wh_meta_title" value="true" /> Activar como categoría destacada
    </div>
	<div class="form-field">
        <label for="wh_meta_date"><?php _e('Productos destacados', 'wh'); ?></label>
         <input  type="checkbox" name="wh_meta_productos" id="wh_meta_productos" value="true" /> Activar como productos destacados

         Copy superior: <input id="wh_meta_copytop" name="wh_meta_copytop" type="text" value="">

       	 Fecha de expiración: <input id="wh_meta_date" name="wh_meta_date" type="date" value="">

       	 copy inferior: <input id="wh_meta_copybottom" name="wh_meta_copybottom" type="text" value=""> para agregar contador de días [diasrestantes]

    </div>

    <?php
}

//Product Cat Edit page
function wh_taxonomy_edit_meta_field($term) {

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field.
    $wh_meta_title = get_term_meta($term_id, 'wh_meta_title', true);
    $wh_meta_productos = get_term_meta($term_id, 'wh_meta_productos', true);
     $wh_meta_date = get_term_meta($term_id, 'wh_meta_date', true);
     $wh_meta_copytop = get_term_meta($term_id, 'wh_meta_copytop', true);
     $wh_meta_copybottom = get_term_meta($term_id, 'wh_meta_copybottom', true);
    ?>
   <tr class="form-field">
        <th scope="row" valign="top"><label for="wh_meta_title"><?php _e('Mostrar en Homepage', 'wh'); ?></label></th>
        <td>
        	<input  type="checkbox" name="wh_meta_title" id="wh_meta_title" value="true" <?php if (esc_attr($wh_meta_title)== 'true') { echo 'checked="checked"';}  ?> /> Activar como categoría destacada
        </td>
    </tr>
     <tr class="form-field">
 		<th scope="row" valign="top"><label for="wh_meta_date"><?php _e('Productos destacados', 'wh'); ?></label></th>
 		<td>
 			<input  type="checkbox" name="wh_meta_productos" id="wh_meta_productos" value="true" <?php if (esc_attr($wh_meta_productos)== 'true') { echo 'checked="checked"';}  ?> /> Activar como productos destacados
		</td>
        <td>
       	 Copy superior: <input id="wh_meta_copytop" name="wh_meta_copytop" type="text" value="<?php echo $wh_meta_copytop; ?>">
        </td>
        <td>
       	 Fecha de expiración: <input id="wh_meta_date" name="wh_meta_date" type="date" value="<?php echo $wh_meta_date; ?>">
        </td>
        <td>
       	 copy inferior: <input id="wh_meta_copybottom" name="wh_meta_copybottom" type="text" value="<?php echo $wh_meta_copybottom; ?>"> para agregar contador de días [diasrestantes]
        </td>

    </tr>
    <?php
}

add_action('product_cat_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1);
add_action('product_cat_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1);

// Save extra taxonomy fields callback function.
function wh_save_taxonomy_custom_meta($term_id) {

    $wh_meta_title = filter_input(INPUT_POST, 'wh_meta_title');
    $wh_meta_date = filter_input(INPUT_POST, 'wh_meta_date');
	$wh_meta_copytop = filter_input(INPUT_POST, 'wh_meta_copytop');
    $wh_meta_copybottom = filter_input(INPUT_POST, 'wh_meta_copybottom');
    $wh_meta_productos = filter_input(INPUT_POST, 'wh_meta_productos');


    update_term_meta($term_id, 'wh_meta_title', $wh_meta_title);
    update_term_meta($term_id, 'wh_meta_date', $wh_meta_date);
    update_term_meta($term_id, 'wh_meta_copytop', $wh_meta_copytop);
    update_term_meta($term_id, 'wh_meta_copybottom', $wh_meta_copybottom);
    update_term_meta($term_id, 'wh_meta_productos', $wh_meta_productos);

}

add_action('edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);






?>