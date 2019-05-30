<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

	/*
	controlador pricipal
	este controlador solo se puede acceder a el si las variables de session
	se encuentran ativas
	como todas las funciones deben preguntar por ellas, se valida desde el contructor por que es lo primero que se evalua en na clase
	*/
	function __construct()
	{
		parent::__construct();
		//$this->load->library('grocery_CRUD');
		//$this->crud=new grocery_CRUD();
		
		//invocar los modelos que se necesitan ´para todo el controlador
		$this->load->model("productos_model");
		$this->load->model("pedidos_model");
		$this->load->model("clientes_model");

		if(!$this->session->userdata('id'))
	{
		redirect('login');
	}
	}
	
	public function index()
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');
		$data['foto']=$this->session->userdata('foto');
		//
		$data['facebook']=$this->session->userdata('facebook');
		$data['twitter']=$this->session->userdata('twitter');
		$data['LinkelIn']=$this->session->userdata('LinkelIn');
		$data["modulo"]="Pedidos";
		$data["descripcion"]="Lista de pedidos";
		//
		$data["lista"]=$this->pedidos_model->listar();
		//
		$this->load->view('pedidos',$data);
	}
		public function nuevo()
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');
		$data['foto']=$this->session->userdata('foto');
		$data['facebook']=$this->session->userdata('facebook');
		$data['twitter']=$this->session->userdata('twitter');
		$data['LinkelIn']=$this->session->userdata('LinkelIn');
		$data["modulo"]="Pedidos";
		$data["descripcion"]="Ingreso de pedido";

		//se van a pasar los datos de los productos y el token que se va a usar 
		//para el pedido
		$data["listarproductos"]=$this->productos_model->listar();
		//Vamos a generar el token, se va usar el session_id y combinando con un valor 
		//aprovecharemos la version 7.0 del php usaremos una funcion que nos gener 
		//un valor aleatorio
		$token=base64_encode(random_bytes(32).session_id());
		
		$data["token"]=$token;

		//enviar el listado de los clientes que se van a cargar en el select
		//cliente
		$data["listadoclientes"]=$this->clientes_model->listar();



		$this->load->view('nuevopedido',$data);

	}
	//funcion agregar que nos servira para agg o quitar produtos del pedido

function agregar()
{
	//cargar el modelo de pedidos con una funcion que nos permita agg o eliminar de la tabla 
	//pedidos_detalle
	$respuesta=$this->pedidos_model->agregar();
	echo "El pedido va en : " .number_format($respuesta,0);
}
function cargarcliente()
{
	//del modelo va extraer la funcion que trae el detalle del cliente del registro 
	//y devolverlo como json
	$data=$this->clientes_model->detallecliente();
	echo json_encode($data);
}
//crear la funcion finalzar
function finalizar()
{
	//La caracteristica de este sistema de pedidos es que todo 
	//gira alrededor del token
	//agregar el token al vector de POST
	$_POST['token']=$_POST['token_1'];
	//invocar el modelo y esperar la respuesta de este
	$data=$this->pedidos_model->finalizar();
	echo $data;
}
function eliminar($id)
{
	$this->pedidos_model->eliminar($id);
	redirect('pedidos');
}

//proceso de edicion
//1. cargar los datos del pedido basados en el id que pasamos
function editar($id)
{
	$data["nombreusuario"]=$this->session->userdata('nombre');
		$data['foto']=$this->session->userdata('foto');
		$data['facebook']=$this->session->userdata('facebook');
		$data['twitter']=$this->session->userdata('twitter');
		$data['LinkelIn']=$this->session->userdata('LinkelIn');
		$data["modulo"]="Pedidos";
		$data["descripcion"]="Editar pedido numero".$id;

		$data["listarproductos"]=$this->productos_model->listar();
		$data["listadoclientes"]=$this->clientes_model->listar();
		$data["encabezado"]=$this->pedidos_model->detalle($id);
		//invocar el encabezado de pedido  y guardarlo en el vector $data
		//1- metodo o forma
		//$data['detallepedido']=$this->pedidos_model->pedidos_detalle($data['encabezado']);

		//2 metodo o forma es recorre el encabezado y sacar el token y pasrlo en la funcion
		foreach ($data["encabezado"] as $fila ) {
			$token=$fila["token"];
		}
		$data["detallepedido"]=$this->pedidos_model->pedidos_detalle($token);
		$data["token"]=$token;

		$this->load->view('nuevopedido',$data);
}


}

