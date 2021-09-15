<?php

/**
 * En este archivo se incluyen los meta box y las funciones de save post. 
 *
 */

/** ==============================================================================================================
 *                                                  HOOKS
 *  ==============================================================================================================
 */

add_action( 'add_meta_boxes', 'cltvo_metaboxes' ); // agrega las metabox
add_action( 'save_post', 'cltvo_save_post' ); // guarda el valor de las metabox 

add_filter( 'rwmb_meta_boxes', 'cltvo_metaboxes' );


/** ==============================================================================================================
 *                                                Meta box
 *  ==============================================================================================================
 */



// ---------------------- agrega el meta box ---------------------- 
function cltvo_metaboxes(){

    
	 	 add_meta_box(
			'empresa_relacionada_mb',		//id
			'Empresa relacionada',				//título
			'empresa_relacionada_mb',		//callback function
			array('trabajos_pt','sucursales_pt'),			//post type
			'side'						//posición
		);

		add_meta_box(
			'sucursal_relacionada_mb',		//id
			'Sucursal relacionada',				//título
			'sucursal_relacionada_mb',		//callback function
			array('trabajos_pt'),			//post type
			'side'						//posición
		);
		add_meta_box(
			'datos_sucursal_mb',		//id
			'Datos Sucursal',				//título
			'datos_sucursal_mb',		//callback function
			array('sucursales_pt'),			//post type
			//'side'						//posición
		);
		add_meta_box(
			'color_destacado_mb',		//id
			'Color destacado',				//título
			'color_destacado_mb',		//callback function
			'empresas_pt',			//post type
			'side'						//posición
		);

		add_meta_box(
			'logo_destacado_mb',		//id
			'Logotipo',				//título
			'logo_destacado_mb',		//callback function
			'empresas_pt',			//post type
									//posición
		);

		// add_meta_box(
		// 	'datos_destacado_mb',		//id
		// 	'Ubicación',				//título
		// 	'datos_destacado_mb',		//callback function
		// 	'sucursales_pt',			//post type
		// 	'side'						//posición
		// );
		// add_meta_box(
		// 	'documentos_necesarios_mb',		//id
		// 	'Documentos obligatorios',				//título
		// 	'documentos_necesarios_mb',		//callback function
		// 	'trabajos_pt',			//post type
		// 	'side'						//posición
		// );
		// add_meta_box(
		// 	'experiencia_previa_mb',		//id
		// 	'Experiencia previa',				//título
		// 	'experiencia_previa_mb',		//callback function
		// 	'trabajos_pt',			//post type
		// 	'normal'						//posición
		// );
		// add_meta_box(
		// 	'informacion_puesto_mb',		//id
		// 	'Información del Puesto',				//título
		// 	'info_puesto_fc',		//callback function
		// 	'trabajos_pt',			//post type
		// 	'normal'						//posición
		// );
		// add_meta_box(
		// 	'tareas_puesto_mb',		//id
		// 	'Tareas del Puesto',				//título
		// 	'tareas_puesto_mb',		//callback function
		// 	'trabajos_pt',			//post type
		// 	'normal'						//posición
		// );
		// add_meta_box(
		// 	'preguntas_puesto_mb',		//id
		// 	'Cuestionario',				//título
		// 	'preguntas_puesto_mb',		//callback function
		// 	'trabajos_pt',			//post type
		// 	'normal'						//posición
		// );
	 
		// add_meta_box(
		// 	'configuracion_pregunta_mb',		//id
		// 	'Configuracion pregunta',				//título
		// 	'configuracion_pregunta_mb',		//callback function
		// 	'preguntas_pt',			//post type
		// 	'normal'						//posición
		// );
		// add_meta_box(
		// 	'solicitud_codigo_mb',		//id
		// 	'Codigo de solicitud',				//título
		// 	'solicitud_codigo_mb',		//callback function
		// 	'post',			//post type
		// 	'side'						//posición
		// );
		// add_meta_box(
		// 	'folio_global_mb',		//id
		// 	'Folio de  solicitud',				//título
		// 	'folio_global_mb',		//callback function
		// 	'post',			//post type
		// 	'side'						//posición
		// );
	 	
	
}

// ---------------------- funcion del meta box ---------------------- 









function empresa_relacionada_mb($object) {
	
	$args = array( 
		'post_status' => get_post_stati(),
		'posts_per_page' => -1,
		'post_type'        => 'empresas_pt',
		'order_by' => 'post_title',
		'order'=>'ASC'
	);


	$empresas = get_posts( $args );

	 wp_nonce_field( basename(__FILE__), 'mam_nonce' );

    // How to use 'get_post_meta()' for multiple checkboxes as array?
    $postmeta = maybe_unserialize( get_post_meta( $object->ID, 'empresa_relacionada_meta', true ) );

    // Our associative array here. id = value
    $empresa_relacionada_meta = array();

	foreach ( $empresas as $empresa ) :
		$empresa_relacionada_meta[$empresa->ID] = $empresa->post_title ;
	endforeach; 
    // Loop through array and make a checkbox for each element
    foreach ( $empresa_relacionada_meta as $id => $element) {

        // If the postmeta for checkboxes exist and 
        // this element is part of saved meta check it.
        if ( is_array( $postmeta ) && in_array( $id, $postmeta ) ) {
            $checked = 'checked="checked"';
        } else {
            $checked = null;
        }
        ?>

        <p>
            <input  type="checkbox" name="empresa_relacionada_in[]" value="<?php echo $id;?>" <?php echo $checked; ?> />
            <?php echo $element;?>
        </p>

        <?php
    }
	

}

function sucursal_relacionada_mb($object) {
	
	$args = array( 
		'post_status' => get_post_stati(),
		'posts_per_page' => -1,
		'post_type'        => 'sucursales_pt',
		'order_by' => 'post_title',
		'order'=>'ASC'
	);


	$empresas = get_posts( $args );

	 wp_nonce_field( basename(__FILE__), 'mam_nonce' );

    // How to use 'get_post_meta()' for multiple checkboxes as array?
    $postmeta = maybe_unserialize( get_post_meta( $object->ID, 'sucursal_relacionada_meta', true ) );

    // Our associative array here. id = value
    $empresa_relacionada_meta = array();

	foreach ( $empresas as $empresa ) :
		$empresa_relacionada_meta[$empresa->ID] = $empresa->post_title ;
	endforeach; 
    // Loop through array and make a checkbox for each element
    foreach ( $empresa_relacionada_meta as $id => $element) {

        // If the postmeta for checkboxes exist and 
        // this element is part of saved meta check it.
        if ( is_array( $postmeta ) && in_array( $id, $postmeta ) ) {
            $checked = 'checked="checked"';
        } else {
            $checked = null;
        }
        ?>

        <p>
            <input  type="checkbox" name="sucursal_relacionada_in[]" value="<?php echo $id;?>" <?php echo $checked; ?> />
            <?php echo $element;?>
        </p>

        <?php
    }
	

}

function expo_relacionada_mb($object) {

	$args = array( 
		'post_status' => get_post_stati(),
		'posts_per_page' => -1,
		'post_type'        => 'post',
		'order_by' => 'post_title',
		'order'=>'ASC',
		'category' =>  get_cat_ID( 'exhibitions' ) ,
	);


	$exposiciones = get_posts( $args );

	 wp_nonce_field( basename(__FILE__), 'mam_nonce' );

    // How to use 'get_post_meta()' for multiple checkboxes as array?
    $postmeta = maybe_unserialize( get_post_meta( $object->ID, 'expo_relacionada_meta', true ) );

    // Our associative array here. id = value
    $expo_relacionada_meta = array();

	foreach ( $exposiciones as $exposicion ) :
		$expo_relacionada_meta[$exposicion->ID] = $exposicion->post_title ;
	endforeach; 
    // Loop through array and make a checkbox for each element
    foreach ( $expo_relacionada_meta as $id => $element) {

        // If the postmeta for checkboxes exist and 
        // this element is part of saved meta check it.
        if ( is_array( $postmeta ) && in_array( $id, $postmeta ) ) {
            $checked = 'checked="checked"';
        } else {
            $checked = null;
        }
        ?>

        <p>
            <input  type="checkbox" name="expo_relacionada_in[]" value="<?php echo $id;?>" <?php echo $checked; ?> />
            <?php echo $element;?>
        </p>

        <?php
    }
	

}

function inter_descripcion_fc($object){
	echo '<p><input type="checkbox" name="inter_descripcion_in" ';
	if( get_post_meta($object->ID, 'inter_descripcion_meta') )echo "checked";
	echo '> Descripción de sección</p>';
}

function color_destacado_mb($object){
	echo '<p><label>poner color hexadecimal:</label></p>';
	echo '<input name="color_destacado_in" placeholder="#fffff" type="text" value="';
	echo get_post_meta($object->ID, 'color_destacado_meta', true);
	echo '" />';
}

function logo_destacado_mb($object){
	echo '<p><label>poner logo SVG:</label></p>';
	echo '<textarea name="logo_destacado_in" placeholder="svg xmlns version=1.0 ..."
		   style="width:100% !important; height:150px !important;" >';
	echo get_post_meta($object->ID, 'logo_destacado_meta', true);
	echo '</textarea>'; 
}

function datos_destacado_mb($object){
	echo '<p><label>Zona</label></p>';
	echo '<input name="datos_destacado_in" placeholder="Ciudad" type="text" value="';
	echo get_post_meta($object->ID, 'datos_destacado_meta', true);
	echo '" />';
}

function datos_sucursal_mb($object){

	echo '<p><label>Ciudad:</label></p>';
	echo '<input style="width:100%" name="datos_sucursal_in_ciudad" placeholder="CDMX" type="text" value="';
	echo get_post_meta($object->ID, 'datos_sucursal_meta_ciudad', true);
	echo '" />';

	 echo '<p><label>Coordenadas Latitud:</label></p>';
	 echo '<input style="width:100%" name="datos_sucursal_in_latidud" placeholder="19.284719816340484" type="text" value="';
	 echo get_post_meta($object->ID, 'datos_sucursal_meta_latidud', true);
	 echo '" />';

	 echo '<p><label>Coordenadas Longitud:</label></p>';
	 echo '<input style="width:100%" name="datos_sucursal_in_longitud" placeholder="99.6411811706151" type="text" value="';
	 echo get_post_meta($object->ID, 'datos_sucursal_meta_longitud', true);
	 echo '" />';

	 echo '<p><label>Calle:</label></p>';
	 echo '<input style="width:100%" name="datos_sucursal_in_calle" placeholder="Amazonas" type="text" value="';
	 echo get_post_meta($object->ID, 'datos_sucursal_meta_calle', true);
	 echo '" />';

	 echo '<p><label>Codigo postal:</label></p>';
	 echo '<input style="width:100%" name="datos_sucursal_in_cp" placeholder="50170" type="text" value="';
	 echo get_post_meta($object->ID, 'datos_sucursal_meta_cp', true);
	 echo '" />';

	 echo '<p><label>Teléfono:</label></p>';
	 echo '<input style="width:100%" name="datos_sucursal_in_tel" placeholder="(722) 437-83-88" type="text" value="';
	 echo get_post_meta($object->ID, 'datos_sucursal_meta_tel', true);
	 echo '" />';

}
function crdmn_equipo_fc($object){?>
	<div class="cltvo_multi_mb">
		<div class="cltvo_multi_papa">
			<?php $crdmn_equipo_arr = get_post_meta($object->ID, 'crdmn_equipo_meta', true) ? get_post_meta($object->ID, 'crdmn_equipo_meta', true) : array(''=>'');?>
			<?php $i=1;?>
			<?php foreach ($crdmn_equipo_arr as $nombre => $link):?>
			<div class="cltvo_multi_hijo cltvo_multi_hijo<?php echo $i;?>">
				<p>
					<label>Nombre </label>
					<input name="crdmn_equipo_nom<?php echo $i;?>" type="text" value="<?php echo $nombre;?>" />
				</p>
				<p>
					<label>Link </label>
					<input name="crdmn_equipo_link<?php echo $i;?>" type="text" value="<?php echo $link;?>" />
				</p>
				<hr>
			</div>
			<?php $i++;?>
			<?php endforeach;?>
		</div>
		<a href="#" class="nuevo-equipo-JS">+ agregar otro miembro de equipo</a>
	</div>
<?php
}

// funciones aqui ...


/** ==============================================================================================================
 *                                                Save post
 *  ==============================================================================================================
 */

function cltvo_save_post($id){
	// Permisos
	if( !current_user_can('edit_post', $id) ) return $id;

	// Vs Autosave
	if( defined('DOING_AUTOSAVE') AND DOING_AUTOSAVE ) return $id;
	if( wp_is_post_revision($id) OR wp_is_post_autosave($id) ) return $id;

	// ---------------------- salva el meta box ----------------------  

	// coloca el meta del metabox en el array 

	$meta_data_array = array( 
								'inter_descripcion_meta', 
								'inter_colaborador_meta'
							);

	foreach ( $meta_data_array as $meta_data ) {
		cltvo_save_metabox($id,$meta_data);
	}

	// ---------------------- funciones interiores del save ---------------------- 

// Save the meta value as one multi dimensional array, like below
// $datos_meta_sucursal = array(
// 	array(
// 		'ciudad' => 'Toluca',
// 		'latitud' => '19.284765384185633',
// 		'longitud' => '-99.64113825497749',
// 		'calle' => 'Nezahualcóyotl 503',
// 		'cp' => '50090',
// 		'telefono' => '7224378389',
// 	),
// 	array(
// 		'title' => 'New name here',
// 		'url' => 'http://example.com',
// 		'description' => 'New description here...'
// 	)
//  );
 
//  // Save it using either update_post_meta() or add_post_meta()
//  update_post_meta( $post_id, 'datos_meta_sucursa', $datos_meta_sucursa );

//  // Reference it or get it like below later on:
//  $datos_meta_sucursa = get_post_meta( $post_id, 'photo_data', true );
 
//  // Get the values like below...
//  echo $datos_meta_sucursaa[0]['ciudad'];
//  echo $datos_meta_sucursa[0]['latitud'];
//  echo $datos_meta_sucursa[0]['longitud'];
//  echo $datos_meta_sucursa[0]['calle'];
//  echo $datos_meta_sucursa[0]['cp'];
//  echo $datos_meta_sucursa[0]['telefono'];



// $sucursal_datos = Array(
// 	'datos_sucursal_meta' => $this->ciudad,
// 	'datos_sucursal_meta2' => $this->latitud,
// 	'datos_sucursal_meta3' => $this->longitud,
// 	'datos_sucursal_meta4' => $this->calle,
// 	'datos_sucursal_meta5' => $this->cp,
// 	'datos_sucursal_meta6' =>$this->telefono,
// 	);
	
// //Update inserts a new entry if it doesn't exist, updates otherwise
// update_post_meta($post_ID, 'sucursal_datos', $sucursal_datos);



	
	if( isset( $_POST[ 'empresa_relacionada_in' ] ) ) {
	    update_post_meta( $id, 'empresa_relacionada_meta', $_POST[ 'empresa_relacionada_in' ] );
	}
	if( isset( $_POST[ 'sucursal_relacionada_in' ] ) ) {
	    update_post_meta( $id, 'sucursal_relacionada_meta', $_POST[ 'sucursal_relacionada_in' ] );
	}
	if( isset( $_POST[ 'color_destacado_in' ] ) ) {
	    update_post_meta( $id, 'color_destacado_meta', $_POST[ 'color_destacado_in' ] );
	}
	if( isset( $_POST[ 'logo_destacado_in' ] ) ) {
	    update_post_meta( $id, 'logo_destacado_meta', $_POST[ 'logo_destacado_in' ] );
	}
	if( isset( $_POST[ 'datos_destacado_in' ] ) ) {
	    update_post_meta( $id, 'datos_destacado_meta', $_POST[ 'datos_destacado_in' ] );
	}
	if( isset( $_POST[ 'datos_destacado_in' ] ) ) {
	    update_post_meta( $id, 'datos_destacado_meta', $_POST[ 'datos_destacado_in' ] );
	}
	if( isset( $_POST[ 'datos_sucursal_in_ciudad' ] ) ) {
	    update_post_meta( $id, 'datos_sucursal_meta_ciudad', $_POST[ 'datos_sucursal_in_ciudad' ] );
	}
	if( isset( $_POST[ 'datos_sucursal_in_latitud' ] ) ) {
	    update_post_meta( $id, 'datos_sucursal_meta_latitud', $_POST[ 'datos_sucursal_in_latitud' ] );
	}
	if( isset( $_POST[ 'datos_sucursal_in_longitud' ] ) ) {
	    update_post_meta( $id, 'datos_sucursal_meta_longitud', $_POST[ 'datos_sucursal_in_longitud' ] );
	}
	if( isset( $_POST[ 'datos_sucursal_in_calle' ] ) ) {
	    update_post_meta( $id, 'datos_sucursal_meta_calle', $_POST[ 'datos_sucursal_in_calle' ] );
	}
	if( isset( $_POST[ 'datos_sucursal_in_cp' ] ) ) {
	    update_post_meta( $id, 'datos_sucursal_meta_cp', $_POST[ 'datos_sucursal_in_cp' ] );
	}
	if( isset( $_POST[ 'datos_sucursal_in_tel' ] ) ) {
	    update_post_meta( $id, 'datos_sucursal_meta_tel', $_POST[ 'datos_sucursal_in_tel' ] );
	}
	if( isset( $_POST[ 'pause_last_in' ] ) ) {
	    update_post_meta( $id, 'pause_last_meta', $_POST[ 'pause_last_in' ] );
	}
	if( isset( $_POST[ 'pause_first_in' ] ) ) {
	    update_post_meta( $id, 'pause_first_meta', $_POST[ 'pause_first_in' ] );
	}
	if( isset( $_POST[ 'link_relacionado_in' ] ) ) {
	    update_post_meta( $id, 'link_relacionado_meta', $_POST[ 'link_relacionado_in' ] );
	}
	if( isset( $_POST[ 'backguards_in' ] ) ) {
	    update_post_meta( $id, 'backguards_meta', $_POST[ 'backguards_in' ] );
	}
	if( isset( $_POST[ 'frame_time_in' ] ) ) {
	    update_post_meta( $id, 'frame_time_meta', $_POST[ 'frame_time_in' ] );
	}
	if( isset( $_POST[ 'pale_caracteristicas_in' ] ) ) {
	    update_post_meta( $id, 'pale_caracteristicas_meta', $_POST[ 'pale_caracteristicas_in' ] );
	}
	if ( ! empty( $_POST['expo_relacionada_in'] ) ) {
        update_post_meta( $id, 'expo_relacionada_meta', $_POST['expo_relacionada_in'] );

    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $id, 'expo_relacionada_meta' );
    }
	
}

/** ==============================================================================================================
 *                               funciones adicionales de los metabox o del save post
 *  ==============================================================================================================
 */

/**
 * Guarda o actulaliza el valor de un meta data 
 * 
 * Parametros:
 *
 * @param string $meta_data nombre del meta data 
 *
 */

function cltvo_save_metabox($id,$meta_data){

		if( isset( $_POST[ $meta_data ] ) ) {
	    update_post_meta( $id, $meta_data , $_POST[ $meta_data ] );
	}

}
?>