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
								'nodelo' => $email,
								'version' => $phno,
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
                $tabla= '#__coche_modelos';
                // Campos
                // id 
                // idMarca
                // nombre
                
                $query->select($db->quoteName(array('id','nombre')));
                $query->from($tabla);
                //~ 
                //~ $query->select( array('id', 'nombre'))->from($db->quoteName('#__coche_marcas'));
                // Reset the query using our newly populated query object.
				$db->setQuery($query);
				$result = $db->loadAssocList('id', 'nombre');
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
			$CuantosModelos=count($cargamodelos);
			// Creamos array script para luego mostrar modelos
			$varmodelos= '';
			foreach ($cargamodelos as $id => $modelos) {
				$varmodelos = $varmodelos .'modelo['.$id.']=';
				$varmodelos = $varmodelos."'".$modelos."';";
			
			}
			
			
			
		}
		//~ if ($data[0] = 'modelo'){
			
		//~ } 
		$html = '<script type="text/javascript">'.
				'var modelo;'.
				$varmodelos.
				'</script>';
				

		return 'Cargo Modelos con Ajax,'.$html. $CuantosModelos;
	}
    
}


