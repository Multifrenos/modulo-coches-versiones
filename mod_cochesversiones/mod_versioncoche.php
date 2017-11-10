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

   // Con $svform recuperamos los datos devueltos por helper
    $cocheselecionado = modVersioncocheHelper::preLoadprocess($params);
   // Ahora debería comprobar si tene datos ( es decir coche seleccionado 
   	if  ($cocheselecionado[resultado] !=''){
		// Quiere decir que no es ok 
		$layout = 'default_seleccionado';

	} else {
		// Como no tenemos seleccionado ningún coche cargamos marcas	
		$cargamarcas = modVersioncocheHelper::getListQuery('#__vehiculo_marcas');
	}
	require JModuleHelper::getLayoutPath('mod_versioncoche', $layout);
