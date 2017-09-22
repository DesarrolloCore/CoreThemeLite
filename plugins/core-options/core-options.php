<?php
/*
Plugin Name: Opciones del tema core
Plugin URI: http://core.gmkweb.com/
Description: Plugin para administrar las configuraciones del tema core
Author: Angel Posada y Emanuelle Portillo
Author URI: http://core.gmkweb.com/
Version: 1.0
License: GPLv2
*/

add_action( 'admin_menu', 'opciones_menu' );

add_shortcode( 'opciones', 'short_opciones');
function short_opciones($atts){
	/*Hacer shortcode para que imprima la información del submenú*/
	extract(shortcode_atts(array("tipo"=>"1"),$atts));
	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}opciones` WHERE activo = 'activo' ORDER BY orden", OBJECT );
	include(dirname(__FILE__) . '/templates/page.php');
	if($tipo == "3"){
		return serialize($results);
	}
}

function opciones_menu(){ 
    add_menu_page( 'Core Options', 'Core Options', 'manage_options', 'opciones', 'opciones_menu_opciones',plugins_url('/corefavicon.png', __FILE__),8 );
}

global $wpdb;
$sql = "
	CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}opciones` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `opcion` varchar(9000) NOT NULL,
	  `valor` varchar(9000) NOT NULL,
	  `activo` enum('activo','no_activo') NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
	";
$wpdb->get_results($sql);

$sql = "
	CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}opciones_log` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `usuario` varchar(9000) NOT NULL,
	  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `info` MEDIUMTEXT NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
	";
$wpdb->get_results($sql);



function opciones_menu_opciones(){
	 global $wpdb;
	 if(isset($_POST['action'])){
		 if($_POST['action'] == "Guardar"){
			 foreach($_POST as $key => $campo){
				 if($key != 'action'){
					$id = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}opciones WHERE opcion = '{$key}'");
					if(!$id){
						$wpdb->insert("{$wpdb->prefix}opciones",
							array("opcion" => $key, "valor" => $campo),
							array("%s","%s")
						);
					}else{
						$wpdb->update("{$wpdb->prefix}opciones",
							array("opcion" => $key, "valor" => $campo),
							array('id' => $id),
							array("%s","%s"),
							array("%d")
						);
					}
				 }
			 }
			 if(!is_array($path)){
				 $cuser = wp_get_current_user();
				 $wpdb->insert("{$wpdb->prefix}opciones_log",
								array("usuario" => $cuser->display_name, "info" => serialize($_POST)),
								array("%s","%s")
							);
				 echo("<div class='updated message' style='padding: 10px'>Se ha guardado correctamente la información.</div>");
			 }else{
				 echo("<div class='error message' style='padding: 10px'>{$path['error']}</div>");			 
			 }
		 }else if($_POST['action'] == "Actualizar"){
			 if(!is_array($path)){
				 $data = array(
					'url'=>$_POST["url"], //1
					//'path'=>$path, //2
					'orden'=>$name, //3
					'id_usuario' => get_current_user_id(), //4
					'titulo'	=> $_POST["titulo"],//6
					'subtitulo'	=> $_POST["subtitulo"],//7
				 );
				 $format= array(
					'%s', //1
					//'%s', //2
					'%d', //3
					'%d', //4
					'%s', //5
					'%s', //6
					'%s', //7
				 );
				 $wpdb->update( "{$wpdb->prefix}opciones", $data,array('id'=>$_POST["id"]), $format,array('%d') );
				 echo("<div class='updated message' style='padding: 10px'>Actualización correcta del trabajador {$_POST['nombre']}.</div>");
			 }else{
				 echo("<div class='error message' style='padding: 10px'>{$path['error']}</div>");			 
			 }
		 }else if($_POST['action'] == "Eliminar"){
			 $id = $_POST["id"];
			 $wpdb->update("{$wpdb->prefix}opciones", 
			 	array( 
					'activo' => 'no_activo',	// string
				), 
				array( 'id' => $id ), 
				array( 
					'%s',	// value1
				), 
				array( '%d' ) 
			);
		 }else if($_POST["action"] == "Aplicar"){
			 foreach($_POST["orden"] as $row){
				 $rowArr = split("-",$row);
				 $wpdb->update("{$wpdb->prefix}opciones", 
					array( 
						'orden' => $rowArr[1],	// string
					), 
					array( 'id' => $rowArr[0] ), 
					array( 
						'%s',	// value1
					), 
					array( '%d' ) 
				);
			 }
			 echo("<div class='updated message' style='padding: 10px'>Actualización correcta del orden.</div>");
		 }
	}
	load_page_opcion($wpdb);
}

function load_page_opcion($wpdb){
	wp_register_script('opcion_script', "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js");
	wp_enqueue_script('opcion_script');
	wp_register_script('opcion_script3', "//cdn.datatables.net/s/bs-3.3.5/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,b-1.1.0,b-colvis-1.1.0,b-flash-1.1.0,b-html5-1.1.0,b-print-1.1.0,cr-1.3.0,fc-3.2.0,fh-3.1.0,kt-2.1.0,r-2.0.0/datatables.min.js");
	wp_enqueue_script('opcion_script3');
	wp_register_style('opcion_style2', "//cdn.datatables.net/s/bs-3.3.5/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,b-1.1.0,b-colvis-1.1.0,b-flash-1.1.0,b-html5-1.1.0,b-print-1.1.0,cr-1.3.0,fc-3.2.0,fh-3.1.0,kt-2.1.0,r-2.0.0/datatables.min.css");
	wp_enqueue_style('opcion_style2');	
	wp_register_style('opcion_style4', plugins_url('/css/style.css', __FILE__));
	wp_enqueue_style('opcion_style4');
	wp_register_style('opcion_style3', "//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css");
	wp_enqueue_style('opcion_style3');
	wp_register_style('opcion_style4', "//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
	wp_enqueue_style('opcion_style4');
	include_once(dirname(__FILE__) . '/templates/template.php');
}

?>