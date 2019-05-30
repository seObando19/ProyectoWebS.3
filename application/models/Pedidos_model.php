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
	function unidades()
	{
		$token=$this->input->post('token');
		$token=$this->security->xss_clean($token);

		$vector=array("token"=>$token);
		$query=$this->db->get_where("pedidos_detalle",$vector);
		$total=0;
		$res=$query->result_array();
		foreach ($res as $fila ) {
			$total=$total+$fila["cantidad"];
		}
		return $total;	
	}

	//function finalzar
	function finalizar()
	{
		//capturar los valores del post que se usaran  para el encabezado
		$token=$this->input->post('token');
		$token=$this->security->xss_clean($token);
		//
		$nombre=$this->input->post('nombre');
		$nombre=$this->security->xss_clean($nombre);
		//
		$telefono=$this->input->post('telefono');
		$telefono=$this->security->xss_clean($telefono);
		//
		$direccion=$this->input->post('direccion');
		$direccion=$this->security->xss_clean($direccion);
		//
		$correo=$this->input->post('correo');
		$correo=$this->security->xss_clean($correo);
		//unidades y totales
		$total=$this->carrito();
		$unidades=$this->unidades();		
		//
		$estado=1; //que indica en proceso
		//Proceso de insercion se le pasa un array con los campos

		//preguntar si el token existe en pedidos encabezado
		//si existeactualizar en caso contrario ingresamos
		$resp=$this->pedidos_detalle($token);
		if (sizeof($resp)>0) {
			$data=array(
				
				"nombre"=>$nombre,
				"telefono"=>$telefono,
				"correo"=>$correo,
				"direccion"=>$direccion,
				"total"=>$total,
				"unidades"=>$unidades				
			);
			$this->db->where("token",$token);
			$this->db->update("pedidos_encabezados",$data);


		}else {
			$data=array(
				"token"=>$token,
				"nombre"=>$nombre,
				"telefono"=>$telefono,
				"correo"=>$correo,
				"direccion"=>$direccion,
				"total"=>$total,
				"unidades"=>$unidades,				
				"estado"=>$estado
			);
			$this->db->insert("pedidos_encabezados",$data);
		}	
		return 0;
	}

	function listar()
	{	
		$query=$this->db->get("pedidos_encabezados");
		return $query->result_array();
	}
	//proceso de eliminacion
	//para realizar la eliminar es necesario capturar el token y aplicar el delete
	//en ambas tablas
	function eliminar($id)
	{
		$data=$this->detalle($id);
		foreach ($data as $fila) {
			$token=$data[0]["token"];
		}
		$this->db->where("token",$token);
		$this->db->delete("pedidos_encabezados");
		//
		$this->db->where("token",$token);
		$this->db->delete("pedidos_detalle");
	}
	//el detalle del registro	
	function detalle($id)
	{
		$vector=array('pkid'=>$id);
		$query=$this->db->get_where("pedidos_encabezados",$vector);
		return $query->result_array();
	}

	//funcion que me permite cargar el pedido_detalle
	function pedidos_detalle($token)
	{
		$vector=array('token'=>$token);
		$query=$this->db->get_where("pedidos_detalle",$vector);
		return $query->result_array();
	}
}	
 ?>
