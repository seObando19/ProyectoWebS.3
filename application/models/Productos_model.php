<?php 
/*
Modelo de la tabla usuarios
los modelos heredan de la clase principal CI_model
aprovechar las caracteristicas para ahorrar codigo
*/
class Productos_model extends CI_model
{
	function __construct()
	{
		//invocar el helper security
		$this->load->helper('security');
	}

	function listar()
	{
		//Traer listado de usurios y devolverlo para que lo lea el controlador y este a su vez lo pase a la vista
		$query=$this->db->get("productos");
		return $query->result_array();
	}
}	
 ?>
