<?php

/*------------------------------------------------------------------------
# J DContact
# ------------------------------------------------------------------------
# author                Md. Shaon Bahadur
# copyright             Copyright (C) 2013 j-download.com. All Rights Reserved.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites:             http://www.j-download.com
# Technical Support:    http://www.j-download.com/request-for-quotation.html
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
		$cargamarcas = modVersioncocheHelper::getListQuery('#__coche_marcas');
	}
	require JModuleHelper::getLayoutPath('mod_versioncoche', $layout);
