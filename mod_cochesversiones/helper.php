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
         
			if($_POST)
			{
			/* Debería entrar solo si hay envio ...*/
			// Tomamos datos de parametros. 
					        
            $marca                 =       trim($_REQUEST['marca']);
            $nodelo                =       trim($_REQUEST['modelo']);
            $version               =       trim($_REQUEST['version']);
			
			// Creo array para devolver resultado
			$resultado = array() ;
			$resultado = array('marca'=> $marca,
								'nodelo' => $nodelo,
								'version' => $version,
								);
			
			}
    }
     static function getListQuery($tabla)
    {
		// Cree un objeto de consulta nueva.           
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		//~ // Seleccione algunos campos
		$query->select($db->quoteName(array('id','nombre')));
		$query->from($tabla);
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
						->where('idmarca = ' . $id_marca);

                
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
		// Ahora debemos realizar una busqueda con los datos recibidos.
		 if ($data[1] == 'marca'){
			// Buscamos los modelos que sean de la marca seleccionada.
            $cargamodelos = modVersioncocheHelper::getListModelos($data[0]);
			
			
			
		}
		//~ if ($data[0] = 'modelo'){
			
		//~ } 
		$html = '<script type="text/javascript">'.
				'var modelos ='.json_encode($cargamodelos).
				'</script>';
				

		return $html;
	}
    
}


