<?php 

class Pedidos_model extends CI_model
{
	function __construct()
	{		
		$this->load->helper('security');
	}

	function agregar()
	{ //recuperar datos y aplicar seguridad que esta en el helper
		$ref=$this->input->post('ref');
		$token=$this->input->post('token');
		$cantidad=$this->input->post('cant');
		$precio=$this->input->post('precio');
		$impuestos=$this->input->post('impuestos');
		$subtotal=$this->input->post('subtotal');
		$tipo=$this->input->post('tipo');
		
		$ref=$this->security->xss_clean($ref);
		$token=$this->security->xss_clean($token);
		$cantidad=$this->security->xss_clean($cantidad);
		$precio=$this->security->xss_clean($precio);
		$impuestos=$this->security->xss_clean($impuestos);
		$subtotal=$this->security->xss_clean($subtotal);
		$tipo=$this->security->xss_clean($tipo);

		// validar existencia del registro
		$vector=array("ref"=>$ref,"token"=> $token);
		$query=$this->db->get_where("pedidos_detalle",$vector);

		$res=$query->result_array();

		if (count($res)>0) {
			//actualizar
			//me sirve tamien para eliminar registro dependiendo si paso 1 o 2
			//apdate se pasa por un vector los datos a actualizar, se pide
			//las condiciones y luego se ejecuta el apdate, el mismo principio es para el delete

			$data=array(
				"precio"=>$precio,
				"impuestos"=>$impuestos,
				"subtotal"=>$subtotal,
				"cantidad"=>$cantidad
			);
			$this->db->where("token",$token);
			$this->db->where("ref",$ref);

			if ($tipo==1) { //actualice
				$this->db->update("pedidos_detalle",$data);
			}elseif ($tipo==2) {//elimine
				$this->db->delete("pedidos_detalle",$data);
			}
		}
		else
		{
			//insertar
			$data=array(
				"precio"=>$precio,
				"impuestos"=>$impuestos,
				"subtotal"=>$subtotal,
				"cantidad"=>$cantidad,
				"ref"=>$ref,
				"token"=>$token
			);
			if ($tipo==1) { 
				$this->db->insert("pedidos_detalle",$data);
			}
		}
		//traer el total del carrito
		$totalpedido=$this->carrito();
		return $totalpedido;
	}

	//funcion que me calcula cual es el valor total  de lo que llevo en el pedido_detalle
	//basado en el token
	function carrito()
	{
		$token=$this->input->post('token');
		$token=$this->security->xss_clean($token);

		$vector=array("token"=>$token);
		$query=$this->db->get_where("pedidos_detalle",$vector);
		$total=0;
		$res=$query->result_array();
		foreach ($res as $fila ) {
			$total=$total+$fila["subtotal"];
		}
		return $total;
	}
}	
 ?>
