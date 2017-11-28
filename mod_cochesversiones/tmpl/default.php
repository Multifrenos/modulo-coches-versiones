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
//~ $session     = JFactory::getSession();
//~ $sessionData = $session->get($node);
// No funciona get
// Si funcion $session ya que crear objecto donde podemos obtener datos de la session...
// Este punto continuamos cuando funcione la carga en Ajax


	//~ // Creamos variables de parametros de modulo
	//~ // Aqui deberíamos cargar un array con los datos de 
	//~ $marca                    =     $cocheselecionado[marca];
	//~ // Los demas debería ser una carga simultanea es decir cargar al seleccionar , con un javascript...como se hizo en parte administradora del componente.
    //~ $nodelo                   =     $cocheselecionado[nomelo];
  	//~ // Los demas debería ser una carga simultanea es decir cargar al seleccionar , con un javascript...como se hizo en parte administradora del componente.
    //~ $version                  =     $cocheselecionado[version];
$document = JFactory::getDocument();
// Ahora identificamos si ya tenemos selecciona un coche.
//~ $idVehiculos = "12";
//~ $session->set('SusVehiculos',$idVehiculos);
//~ echo '<pre>';
//~ print_r($session->get('SusVehiculos'));
//~ echo '</pre>';


$document->addScript(JUri::base().'modules/mod_versioncoche/roe.js'); // Para llamar a la funcion change
$js = <<<JS
(function ($) {
	$(document).ready(function(){
		// A la hora cargar bloqueamos el select de modelos y versiones
		$("#nodelo").prop('disabled', true);
		$("#versiones").prop('disabled', true);

		// Hacemos lógica para cuando cambiemmos marca
		$('select[name=myMarca]').change(function(){
			// Eliminamos modelos que hay y desactivo select.
			EliminarModelos();
			document.getElementById("nodelo").disabled = true;

			// Creamos array para enviar...
			var value   = $('select[name=myMarca]').val(),
				datos   = [value,'marca'],
			
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
					CambioMarcas();
				}
			});
		
		});
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
					CambioModelos();
				}
			});
			
		});
	});
	
})(jQuery);
JS;

$document->addScriptDeclaration($js);


//~ echo '<pre>';
//~ print_r($_POST);
//~ 
//~ echo '</pre>';




?>
    <link rel="stylesheet" href="modules/mod_versioncoche/tmpl/lib/versioncoche.css" media="screen" />
  <div class="SelecionaVehiculo">
	<div>
	<a class="btn">Selecciona tu vehiculo</a>
	</div>
  
  
  
    <div id="IDSeleccionarVersion">
		<form id="formSeleccionarCoche" method="post" action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" onsubmit="return validar(this)">
            <!-- Presentacion de marca -->
            <div class="form-group marca">
            <label class="marca"><?php echo JText::_('MOD_VERSIONCOCHE_MARCA'); ?></label>
            <!-- Cargamos select con marcas -->
            <select name="myMarca" id="myMarca">
				<option value="0">Seleccione una marca</option>
            <?php	// Al cambiar la selección ejecuta JSOn del principio.
					foreach ($cargamarcas as $id => $marca) {
						?>
						<option value= "<?php echo $id; ?>"><?php echo $marca; ?></option>
					
			<?php 	}
			?>
			</select>
            </div>
			<!-- Presentacion de modelo -->
            <div class="form-group nodelo">
			<label class="nodelo"><?php echo JText::_('MOD_VERSIONCOCHE_NODELO'); ?><span id='Numero_modelos'></span></label>
			            <!-- Cargamos select con marcas -->
            <select name="Minodelo" id="nodelo" >
						<option value="0">Seleccione una modelo</option>
            			<?php // Las opciones se cargan mediante JAVASCRIPT ;?>

			</select>
	
            </div>
            <!-- Presentacion de version -->
            <div class="form-group versiones">
				<label class="versiones"><?php echo JText::_('MOD_VERSIONCOCHE_VERSION'); ?><span id='Numero_versiones'></span></label>
			            <!-- Cargamos select con marcas -->
				<select name="Miversion" id="versiones"  onchange="cambioModelo()">
						<?php // Las opciones se cargan mediante JAVASCRIPT ;?>
						<option value="0">Seleccione una version/acabado</option>
				</select>
	
            </div>
 
            <div class ="form-group enviar">
                <input class="addtocart-button" type="submit"/>
           </div>
              
        </form>
        <!-- Este div es donde cargamos con JAVASCRITP los modelos y versiones de la marca seleccionada -->
        <?php 	/*  La carga se hace JSON con la funcion $document.ready que tenemos al principio
        		 * y la ponemos dentro de este div, por orden nadamas, pero si lo quitas o cambias la clase 
        		 * dejará de funciona... */
        ?>
				
		<div class="status"></div>
		<p id="demo"></p>
		
      
    </div>
</div>
