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
			'datos_sucursal_mb',		//id
			'Datos Sucursal',				//título
			'datos_sucursal_mb',		//callback function
			array('trabajos_pt','sucursales_pt'),			//post type
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

		add_meta_box(
			'datos_destacado_mb',		//id
			'Ubicación',				//título
			'datos_destacado_mb',		//callback function
			'empresas_pt',			//post type
			'side'						//posición
		);
	 	
	
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
	echo '<p><label>Coordenadas Latitu:</label></p>';
	echo '<input style="width:100%" name="datos_sucursal_in" placeholder="19.284719816340484" type="text" value="';
	echo get_post_meta($object->ID, 'datos_sucursal_meta', true);
	echo '" />';

	echo '<p><label>Coordenadas Longitud:</label></p>';
	echo '<input style="width:100%" name="datos_sucursal_in" placeholder="99.6411811706151" type="text" value="';
	echo get_post_meta($object->ID, 'datos_sucursal_meta', true);
	echo '" />';

	echo '<p><label>Calle:</label></p>';
	echo '<input style="width:100%" name="datos_sucursal_in" placeholder="Amazonas" type="text" value="';
	echo get_post_meta($object->ID, 'datos_sucursal_meta', true);
	echo '" />';

	echo '<p><label>Codigo postal:</label></p>';
	echo '<input style="width:100%" name="datos_sucursal_in" placeholder="50170" type="text" value="';
	echo get_post_meta($object->ID, 'datos_sucursal_meta', true);
	echo '" />';

	echo '<p><label>Teléfono:</label></p>';
	echo '<input style="width:100%" name="datos_sucursal_in" placeholder="(722) 437-83-88" type="text" value="';
	echo get_post_meta($object->ID, 'datos_sucursal_meta', true);
	echo '" />';

	echo '<p><label>Facebook:</label></p>';
	echo '<input style="width:100%" name="datos_sucursal_in" placeholder="https://www.facebook.com/valparaisofunerales" type="text" value="';
	echo get_post_meta($object->ID, 'datos_sucursal_meta', true);
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

	
	if( isset( $_POST[ 'empresa_relacionada_in' ] ) ) {
	    update_post_meta( $id, 'empresa_relacionada_meta', $_POST[ 'empresa_relacionada_in' ] );
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
	if( isset( $_POST[ 'datos_sucursal_in' ] ) ) {
	    update_post_meta( $id, 'datos_sucursal_meta', $_POST[ 'datos_sucursal_in' ] );
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