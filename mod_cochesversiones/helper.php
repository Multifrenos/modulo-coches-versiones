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
                //~ return $query;
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
		//						version
		
		$input = JFactory::getApplication()->input;
		$data  = $input->get('data');
		// Ahora debemos realizar una busqueda con los datos recibidos.
		

		return 'Hello Ajax World,'.$data[1].$data[0];
	}
    
}


