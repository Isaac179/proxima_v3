<?php
/** ==============================================================================================================
 *                                       Constantes y variables Globales
 *  ==============================================================================================================
 */
define( 'JSPATH', get_template_directory_uri() . '/js/' );
define( 'BLOGURL', get_home_url('/') );
define( 'THEMEURL', get_bloginfo('template_url').'/' );


if( isset($_GET["filter"]) ){
	define( 'FILTRO', $_GET["filter"] );
}else{
	define( 'FILTRO', 'All' );
}

/**
 * Hook que crea las paginas especificas o especiales de manera automatica
 *
 * Key: slug de la pagina
 * Value: nombre de la pagina especial
 *
 */

add_action('init', function(){

/**
 * Array de paginas especificas o especiales
 * Key: slug de la pagina especial
 * Value: nombre de la pagina especial
 *
 */

 $GLOBALS['special_pages'] = array(
 		'nosotros' => 'Nosotros',
 		'ajax-mail' => 'Ajax para enviar mails'
 	);

 	$special_pages_ids = get_option('special_pages_ids'); // almacena los ids de las paginas especiales

 	if ( !is_array($special_pages_ids) )  { //crea la opccion si aun no esta creada
 		add_option('special_pages_ids');
 		$special_pages_ids=array();
 	}

 	foreach ($GLOBALS['special_pages'] as $slug => $name) {
 		$CreaPost = true;
 		if( isset($special_pages_ids[$slug]) ){ // si aun se ha creado
 			$pagina = get_post( intval($special_pages_ids[$slug]) );
 			if ( $pagina ) { // si borraron permanentemente la pagina
 				$CreaPost = false;

 				if ( $pagina->post_status != 'publish' ){ // evita que las paginas se coloquen en borador o se envien a la papelera.
 					$pagina_args = array(
 						'ID'           => $pagina->ID,
 						'post_status'   => 'publish',
 					);
 					wp_update_post( $pagina_args );
 				}
 			}
 		}

 		if( $CreaPost ){ // si no existe la pagina guarda

 			$page = array(
 			'post_author'  => 1,
 			'post_status'  => 'publish',
 			'post_name' => $slug,
 			'post_title'   => $name,
 			'post_type'    => 'page'
 			);

 			$special_pages_ids[$slug] = wp_insert_post( $page, true );
 		}
 	}

 	update_option('special_pages_ids',$special_pages_ids);

});


/** ==============================================================================================================
 *                                       Inluye los archivos generarles
 *  ==============================================================================================================
 */
// ---------------- scripts
// Contiene la llamada de los archivos functions.js y admin-functions.js asi como inclucion de valiables java

include_once('functions/general-scripts_js.php');

// ---------------- funciones cltvo
// Contiene las funciones generales del cultivo que son independeites de cada proyecto

include_once('functions/general-functions_cltvo.php');

// ---------------- flitros cltvo
// Contiene los filtros generales del cultivo que son independeites de cada proyecto

include_once('functions/general-filters_cltvo.php');




/** ==============================================================================================================
 *                                       Inluye los archivos de admin
 *  ==============================================================================================================
 */

// ---------------- personaizacion del menu
// Contiene las funciones para personalizar el menu del admin

include_once('functions/admin-menu.php');

// ---------------- imagenes de tamaños y opcciones personalizadas
// Contiene la funciones para personalizar los tamaños de la imagenes

include_once('functions/admin-images.php');

// ---------------- post type y taxonimias
// Contiene el registro de tipos de post persializados y configuracion del editor de los mismos

include_once('functions/admin-post_type.php');

// Contiene el registro de taxonomias personalizadas

include_once('functions/admin-taxonomies.php');

// ---------------- meta boxes y save post
// Contiene la inclucion de las metaboxes asi como las funciones del save post

include_once('functions/admin-metabox_savepost.php');


/** ==============================================================================================================
 *                                         Inluye los archivos del tema
 *  ==============================================================================================================
 */

// ---------------- funciones del menu
// Contiene el menú del sitio y sus funciones

include_once('functions/theme-menu.php');

// ---------------- filtros del tema
// Contiene los filtros específicos del tema

include_once('functions/theme-filters.php');

// ---------------- funciones del tema
// Contiene los funciones específicas del tema

include_once('functions/theme-functions.php');



?>



<?php
/**
* WP AJAX Call Frontend
*/

//Load jQuery
wp_enqueue_script('jquery');

//Define AJAX URL
function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');

//The Javascript
function add_this_script_footer(){ ?>
<script>
jQuery(document).ready(function($) {
    // This is the variable we are passing via AJAX
    var fruit = 'Banana';
    // This does the ajax request (The Call).

    $( ".banana" ).click(function() {
      $.ajax({
          url: ajaxurl, // Since WP 2.8 ajaxurl is always defined and points to admin-ajax.php
          data: {
              'action':'example_ajax_request', // This is our PHP function below
              'fruit' : fruit // This is the variable we are sending via AJAX
          },
          success:function(data) {
      // This outputs the result of the ajax request (The Callback)
              $(".banana").text(data);
          },
          error: function(errorThrown){
              window.alert(errorThrown);
          }
      });
    });
});
</script>
<?php }
add_action('wp_footer', 'add_this_script_footer');

//The PHP
function example_ajax_request() {
    // The $_REQUEST contains all the data sent via AJAX from the Javascript call
    if ( isset($_REQUEST) ) {
        $fruit = $_REQUEST['fruit'];
        // This bit is going to process our fruit variable into an Apple
        if ( $fruit == 'Banana' ) {
            $fruit = 'Apple';
        }
        // Now let's return the result to the Javascript function (The Callback)
        echo $fruit;
    }
    // Always die in functions echoing AJAX content
   die();
}
// This bit is a special action hook that works with the WordPress AJAX functionality.
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );
add_action( 'wp_ajax_nopriv_example_ajax_request', 'example_ajax_request' ); 

