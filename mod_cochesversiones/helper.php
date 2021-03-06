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

class modVersioncocheHelper
{
	static function preLoadprocess(&$params)
	{
         
			$resultado = '' ;

			if($_POST)
			{
			/* Debería entrar solo si hay envio ...*/
			// Tomamos datos de parametros. 
					        
            //~ $marca                 =       trim($_REQUEST['marca']);
            //~ $nodelo                =       trim($_REQUEST['modelo']);
            //~ $version               =       trim($_REQUEST['version']);
			
			// Creo array para devolver resultado
				if ($_POST['Miversion']){
					$resultado = $_POST['Miversion'];
					$url = JURI::base();
					header( 'Location: ' . $url );
				}
				
			}
			
			return $resultado;
			
    }
    
    
     static function getListQuery($tabla)
    {
		// Cree un objeto de consulta nueva.           
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		//~ // Seleccione algunos campos
		$query->select($db->quoteName(array('id','nombre')));
		$query->from($tabla);
		$query->order('nombre ASC');
		//~ 
		//~ $query->select( array('id', 'nombre'))->from($db->quoteName('#__coche_marcas'));
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		$result = $db->loadAssocList('id', 'nombre');
		return $result;
    }
    
     static function getListModelos($id_marca)
	{
                // Cree un objeto de consulta nueva.           
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                //~ // Seleccione algunos campos
                $tabla= '#__vehiculo_modelos';
                $query = $db->getQuery(true)
                        ->select('id,nombre')
                        ->from($tabla)
						->where('idmarca = ' . $id_marca)
						->order('nombre ASC');

                
                // Campos
                // id 
                // idMarca
                // nombre
                

                //~ 
                //~ $query->select( array('id', 'nombre'))->from($db->quoteName('#__coche_marcas'));
                // Reset the query using our newly populated query object.
                $db->setQuery($query);
				$result = $db->loadObjectList();
                
                return $result;
	}
	
	 static function getListVersiones($id_modelo)
	{
                // Cree un objeto de consulta nueva.           
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                //~ // Seleccione algunos campos
                $tabla= '#__vehiculo_versiones';
                $query = $db->getQuery(true)
                        ->select('id,nombre,cv,kw,cm3,ncilindros,fecha_inicial,fecha_final')
                        ->from($tabla)
						->where('idModelo = ' . $id_modelo)
						->order('nombre ASC');

                
                            

                //~ 
                //~ $query->select( array('id', 'nombre'))->from($db->quoteName('#__coche_marcas'));
                // Reset the query using our newly populated query object.
                $db->setQuery($query);
				$result = $db->loadObjectList();
                //~ 
                return $result;
	}
    
    
    public static function getAjax()
	{
		//* Obtenemos los datos recibidos...
		// Aquí me surge la duda si utilizar la misma funcion para recibir id de marca o modelo o version
		// o utilizar una funcion para cada cosa, ya que cambiaría  el resultado...
		// data es un array que contiene el:
		// 		data[0] -> Numero de Id
		//		data[1] -> Contiene string que puede ser:
		//						marca
		//						modelo
		// Version selecciona va otra funcion pero ya con php.
		
		$input = JFactory::getApplication()->input;
		$data  = $input->get('data');
		if ($data[1] === 'Eliminar'){
			// Quiere decir queremos quitar de session el vehiculo.
			$ControlSession     = JFactory::getSession();
			$vacio = array();
			$ControlSession->set('SusVehiculos',$vacio);
			return;
			
		}else {
			// Si estamos pidiendo marcva, modelo o version.
			$html = '<script type="text/javascript">';

			// Ahora debemos realizar una busqueda con los datos recibidos.
			 if ($data[1] == 'marca'){
				// Buscamos los modelos que sean de la marca seleccionada.
				$respuesta = modVersioncocheHelper::getListModelos($data[0]);
				$html .='var modelos ='.json_encode($respuesta).';';

			}
			if ($data[1] = 'modelo'){
				// Buscamos los modelos que sean de la marca seleccionada.
				$respuesta = modVersioncocheHelper::getListVersiones($data[0]);
				$html .='var versiones ='.json_encode($respuesta).';';
				$html .='var datoentregado ='.$data[0].';';

			}
			//~ $respuesta = implode(',', $data); 
					//~ 'var modelos ='.json_encode($respuesta).';'.
					//~ '// '.$respuesta.
					
					$html .='</script>';
		}		

		return $html;
	}
	
	
	 static function getVersion($id_version)
	{
                // Cree un objeto de consulta nueva.           
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                //~ // Seleccione algunos campos
                $query = $db->getQuery(true)
                        ->select('v.id,ma.nombre as marca,mo.nombre as modelo,v.nombre,v.cm3,v.kw,v.ncilindros,v.cv,v.fecha_inicial,v.fecha_final')
                        ->from('#__vehiculo_versiones as v')
                        ->join('left', '#__vehiculo_modelos as mo ON (v.idModelo = mo.id)')
                        ->join('left', '#__vehiculo_marcas as ma ON (v.idMarca = ma.id)')
						->where('v.id = ' . $id_version);

                
                            

                //~ 
                //~ $query->select( array('id', 'nombre'))->from($db->quoteName('#__coche_marcas'));
                // Reset the query using our newly populated query object.
                $db->setQuery($query);
				$result = $db->loadObjectList();
                //~ $result = $query->__toString(); 
                return $result;
	}
   
	
    
}


