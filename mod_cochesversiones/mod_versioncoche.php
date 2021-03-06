<?php

/*------------------------------------------------------------------------
# Soluciones Vigo	
# ------------------------------------------------------------------------
# author                Ricardo Carpintero Gil
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites:             http://ayuda.svigo.es
# Technical Support:    info@solucionesvigo.es
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;
require_once __DIR__ . '/helper.php';
$params->def('greeting', 1);
$layout           = $params->get('layout', 'default');
$ControlSession     = JFactory::getSession();
$SusVehiculos = $ControlSession->get('SusVehiculos');
// Si no existe o esta vacio $SusVehiculos damos opcion de mostrar formulario

if (!isset($SusVehiculos) || count($SusVehiculos)===0 ){
	$cargamarcas = modVersioncocheHelper::getListQuery('#__vehiculo_marcas');
	
   // Con $svform recuperamos los datos devueltos por helper
    $id_version = modVersioncocheHelper::preLoadprocess($params);
    if ($id_version !=''){
		$datosversion = modVersioncocheHelper::getVersion($id_version);
	} else {
		$datosversion = array();
	} 
   // Si hay datos de seleccion pues grabamos dato en session
   //~ echo $datosversion;
   
   if (count($datosversion)>0){
	    // Obtenemos vehiculos seleccionada , ya que la idea es poder seleccionar varios coches.
		$ids_versiones[] = $id_version;
		$ControlSession->set('SusVehiculos',$ids_versiones);
		$SusVehiculos = $ControlSession->get('SusVehiculos');
		
	}
} 

// Si existe vehiculo seleccionamo mostramos esta vista.
if (count($SusVehiculos) >0){
	// Consultamos los datos de las versiones que hay $SusVehiculos
	$vehiculos = array();
	foreach ( $SusVehiculos as $key =>$id_version){
		$vehiculos = 	modVersioncocheHelper::getVersion($id_version);

	}
	$layout = 'default_seleccionado';
}


	require JModuleHelper::getLayoutPath('mod_versioncoche', $layout);
