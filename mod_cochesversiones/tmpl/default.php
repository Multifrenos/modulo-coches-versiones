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
// Datos sescion 
$session     = JFactory::getSession();
//~ $sessionData = $session->get($node);
// No funciona get
// Si funcion $session ya que crear objecto donde podemos obtener datos de la session...
// Este punto continuamos cuando funcione la carga en Ajax

	// Creamos variables de parametros de modulo
	// Aqui deberíamos cargar un array con los datos de 
	$marca                    =     $cocheselecionado[marca];
	// Los demas debería ser una carga simultanea es decir cargar al seleccionar , con un javascript...como se hizo en parte administradora del componente.
    $nodelo                   =     $cocheselecionado[nomelo];
  	// Los demas debería ser una carga simultanea es decir cargar al seleccionar , con un javascript...como se hizo en parte administradora del componente.
    $version                  =     $cocheselecionado[version];
$document = JFactory::getDocument();
$document->addScript(JUri::base().'modules/mod_versioncoche/roe.js'); // Para llamar a la funcion change
$js = <<<JS
(function ($) {
	$(document).ready(function(){
	$('select[name=Minodelo]').change(function(){
		// Creamos array para enviar...
		
		var value   = $('select[name=Minodelo]').val(),
			datos   = [value,'modelo'],
		
			request = {
					'option' : 'com_ajax',
					'module' : 'versioncoche',
					'data'   : datos,
					'format' : 'raw'
				};
		$.ajax({
			type   : 'POST',
			data   : request,
			success: function (response) {
				$('.status').html(response);
			}
		});
		return false;
	});
	});
})(jQuery)
JS;

$document->addScriptDeclaration($js);
	
	
?>
    <link rel="stylesheet" href="modules/mod_versioncoche/tmpl/lib/svformulario.css" media="screen" />
  
    <div id="SeleccionarVersion">
		<?php
		//$app = JFactory::getDocument();
		/*echo '<pre>';
		print_r ($module->title);
		echo '</pre>';
		* los campos del formulario si le ponemos disabled quedan dehabilitados, 
		* por lo que si el formulario ya fue envía entonces deberíamos sustituir
		* required por disabled
		* Y hay campos que no se deberían mostrar, como
		* copia y control spam 
		* */
		?>
		
		<form>
            <!-- Presentacion de marca -->
            <div class="marca">
            <label class="marca"><?php echo JText::_('MOD_VERSIONCOCHE_MARCA'); ?></label>
            <!-- Cargamos select con marcas -->
            <select id="mySelect"  onchange="myFunction()">
				<option value="0">Seleccione una marca</option>
            <?php
					foreach ($cargamarcas as $id => $marca) {
						?>
						<option value= "<?php echo $id; ?>"><?php echo $marca; ?></option>
					
			<?php 	}
			?>
			</select>
            </div>
			<!-- Presentacion de modelo -->
            <div class="nodelo">
			<label class="nodelo"><?php echo JText::_('MOD_VERSIONCOCHE_NODELO'); ?></label>
			            <!-- Cargamos select con marcas -->
            <select name="Minodelo" id="mySelect"  onchange="cambioModelo()">
						<option value="0">Seleccione una modelo</option>

            <?php
					foreach ($cargamarcas as $id => $marca) {
						?>
						<option value= "<?php echo $id; ?>"><?php echo $marca; ?></option>
					
			<?php 	}
			?>
			</select>
	
            </div>
            <!-- Presentacion de version -->
            <div class="version">
            <label class="version"><?php echo JText::_('MOD_VERSIONCOCHE_VERSION'); ?></label>
			<input type="text" name="data">
            </div>
			            
            <div class ="enviar"></div>
                <input type="submit"/>
           </div>
              
        </form>
		<div class="status"></div>
		<p id="demo"></p>
		
      
    </div>
