<?php

/**
 * En este archivo se incluyen las funciones del tema 
 *
 */


/** ==============================================================================================================
 *                                              FUNCIONES DEL TEMA
 *  ==============================================================================================================
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
   add_theme_support( 'woocommerce' );
}
function post_remove ()      //creating functions post_remove for removing menu item
{ 
   remove_menu_page('edit.php');
}

add_action('admin_menu', 'post_remove'); 

 function cltvo_imagen_titular($parent_id, $tipo_de_imagen, $tamano_de_imagen ) { 
 	//imageb con meta value: imagen_titular
	$img_tam_compl_args = array(
		'posts_per_page' => 1,
		'post_parent' => $parent_id,
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'post_mime_type' => 'image',
		'meta_key' => 'daniel_tamano_img_meta',
		'meta_value' => $tipo_de_imagen,
	);

	$img_tam_compls = get_posts($img_tam_compl_args);

	if (!is_array($img_tam_compls)) //Si no existe regresa falso
		return false;

	$img_tam_compl = reset($img_tam_compls);
	$src = wp_get_attachment_image_src($img_tam_compl->ID, $tamano_de_imagen, true);
	$alt = get_post_meta($img_tam_compl->ID, '_wp_attachment_image_alt', true);
	$respuesta = array(
		'src' => $src[0], 
		'alt' => $alt
	);
	return $respuesta;//regresa un arreglo con src la direccion de la imagen
   };

   

// funciones aqui ...
   function dnl_imagenes_dailywork($parent_id, $tipo_de_imagen ) { 
 	//imageb con meta value: imagen_titular
	$img_tam_compl_args = array(
		'posts_per_page' => -1,
		'post_parent' => $parent_id,
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'post_mime_type' => 'image',
		'meta_key' => 'daniel_tamano_img_meta',
		'meta_value' => $tipo_de_imagen,
	);

	$img_tam_compls = get_posts($img_tam_compl_args);

	return $img_tam_compls;//regresa un arreglo con src la direccion de la imagen
   };

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        
        <?php printf( __( '<span class="fn">%s</span> ' ), get_comment_author_link() ); ?> <?php comment_text(); ?>
    </div>
    

    


    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}
remove_filter('comment_text','wpautop',30);

function bac_PostViews($post_ID) {
 
    //Set the name of the Posts Custom Field.
    $count_key = 'post_views_count'; 
     
    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);
     
    //If the the Post Custom Field value is empty. 
    if($count == ''){
        $count = 0; // set the counter to zero.
         
        //Delete all custom fields with the specified key from the specified post. 
        delete_post_meta($post_ID, $count_key);
         
        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
        return $count . ' Visitas';
     
    //If the the Post Custom Field value is NOT empty.
    }else{
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta($post_ID, $count_key, $count);
         
        //If statement, is just to have the singular form 'View' for the value '1'
        if($count == '1'){
        return $count . ' Visita';
        }
        //In all other cases return (count) Views
        else {
        return $count . ' Visitas';
        }
    }
}

if (!is_admin()) {
function wpb_search_filter($query) {
if ($query->is_search) {
$query->set('post_type', 'lapcit_estudios_pt');
}
return $query;
}
add_filter('pre_get_posts','wpb_search_filter');
}


// add_filter('next_post_link', 'post_link_attributes');
// add_filter('previous_post_link', 'post_link_attributes');

// function post_link_attributes($output) {
//     $code = 'href="#"';
//     $linkpost = str_replace('<a href=', '<a '.$code.' linksingle=', $output);
//     $linkpost = str_replace('rel="prev">', '>', $linkpost);
//     $linkpost = str_replace('rel="next">', '>', $linkpost);

//     return $linkpost;
// }
?>