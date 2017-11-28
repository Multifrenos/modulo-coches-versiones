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
$document = JFactory::getDocument();

$js = <<<JS
		function BorrarSeleccionVehiculo(){
			//~ alert ('Eliminamos seleccion de coche');
			EnviarBorrarSeleccion();
		}
		function EnviarBorrarSeleccion(){
				datos   = ['id','Eliminar'];
				request = {
				'option' : 'com_ajax',
				'module' : 'versioncoche',
				'data'   : datos,
				'format' : 'raw'
				};
				jQuery.ajax({
					type   : 'POST',
					data   : request,
					success: function (response) {
						console.log (' Debería cargar formulario' );
						//~ alert('Debería cargar formulario');
						document.location.href='index.php';

					}
				});
		}
JS;

$document->addScriptDeclaration($js);







//~ $session     = JFactory::getSession();
//~ $idVehiculo = $session->get('SusVehiculos');
// Montamos vehiculos a mostrar.
foreach ($vehiculos as $vehiculo){
	
	$html = '<table class="table"><theader><th></th><th>Cilindrada</th><th>Cv/KW</th><th>NºCilindros</th><th>Inicio Fabricación</th><th>Fin Fabricación</th></theader>'
			.'<tbody><tr>'
			.'<td>'
			.'<span title="'.$vehiculo->id.'" class=" glyphicon glyphicon-info-sign"></span> '
			.$vehiculo->marca.' '.$vehiculo->modelo.' '.$vehiculo->nombre
			
			.'</td>'
			.'<td>'.$vehiculo->cm3.'</td>'
			.'<td>'.$vehiculo->cv.'cv / '.$vehiculo->kw.'Kw</td>'
			.'<td>'.$vehiculo->ncilindros.'</td>'

			.'<td>'.$vehiculo->fecha_inicial.'</td>'
			.'<td>'.$vehiculo->fecha_final.'</td>'
			.'</tr></tbody>'
			.'</table>';
}
?>
    <div class="col-md-12 TusVehiculosSeleccionads">
		  <a href="#" class="close" onclick="BorrarSeleccionVehiculo()" aria-label="close">&times;</a>
			 <h3>Vehículos seleccionados</h3>
				<div class="alert alert-info alert-dismissable">
			  <?php echo $html;?>
				</div>
		<form id="formSeleccionarCoche" method="post" action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" onsubmit="return validar(this)">
		</form>
		<?php
			//~ echo '<pre>';
			//~ print_r($SusVehiculos);
			//~ echo '</pre>';
		
		?>	
    </div>
