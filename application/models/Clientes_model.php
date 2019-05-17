<?php 
//modelo del cliente
class Clientes_model extends CI_model
{
	function __construct()
	{
		//invocar el helper security
		$this->load->helper('security');
	}

	function listar()
	{
		//Traer listado de usurios y devolverlo para que lo lea el controlador y este a su vez lo pase a la vista
		$query=$this->db->get("clientes");
		return $query->result_array();
	}

	//detalle del cliente
	function detallecliente()
	{
		$cliente=$this->input->post("cliente");
		$cliente=$this->security->xss_clean($cliente);
		$vector=array("pkid"=>$cliente);

		$query=$this->db->get_where("clientes",$vector);
		return $query->result_array();
	}
}	
 ?>
