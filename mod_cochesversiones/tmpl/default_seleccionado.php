<?php

/*------------------------------------------------------------------------
# SV Formulario
# ------------------------------------------------------------------------
# author                Solucionesvigo.es
# copyright             Libre.
# @license -            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites:             http://solucionesvigo.es
# Technical Support:    http://ayuda.svigo.es
* -------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

$session     = JFactory::getSession();
$idVehiculo = $session->get('SusVehiculos')
?>
    <div class="resultado">
		<?php
			echo '<pre>';
			print_r($vehiculos);
			echo '</pre>';
		
		?>	
    </div>
