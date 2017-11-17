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
	echo 'Entro primer if ';
	$cargamarcas = modVersioncocheHelper::getListQuery('#__vehiculo_marcas');
	
   // Con $svform recuperamos los datos devueltos por helper
    $id_version = modVersioncocheHelper::preLoadprocess($params);
    $datosversion = getVersion($id_version);
   // Si hay datos de seleccion pues grabamos dato en session
   if (count($datosversion)>0)){
	    // Obtenemos vehiculos seleccionada , ya que la idea es poder seleccionar varios coches.
		$ids_versiones[] = $id_version;
		echo ' Entro en if para añadir a session';
		$ControlSession->set('SusVehiculos'$ids_versiones);
		$SusVehiculos = $ControlSession->get('SusVehiculos');
		
	}
} 
// Si existe vehiculo seleccionamo mostramos esta vista.
if (count($SusVehiculos) >0){
	$layout = 'default_seleccionado';
}


	require JModuleHelper::getLayoutPath('mod_versioncoche', $layout);
