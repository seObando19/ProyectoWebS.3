<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	para pasar datos a una vista se usa arrays y despues del nombre de la vista se invoca el array separados por una coma
	los datos se arman en un vector y cada posicion tiene un nombre y ese nombre es el que se pintara en la vista*/
class Usuarios extends CI_Controller {
/*
	si en toda la clase se va a usar o realizar operaciones con un modelo se recomienda instanciarlo en el construct
*/
	function __construct()
	{
		parent::__construct(); //hereda las caracteristicas del constructor
		//Invocar el modelo
		$this->load->model("usuarios_model");

		if(!$this->session->userdata('id'))
		{
			redirect('login');
		}
	}

	public function index()
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');
		$listar=$this->usuarios_model->listar();
		$data["listado"]=$listar;
		$data["titulo"]="Usuarios";

		$this->load->view('usuarios',$data);



		
	}
	public function eliminar($param)
	{
		/*
		proceso de eliminacion
		1-invocar una funcion del modelo que permita borrar e registro
		2-devolverlo a la pricipal del controlador
		*/
		$this->usuarios_model->eliminar($param);
		redirect('usuarios');

	}
	public function nuevo()
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');		
		$data["titulo"]="Ingreso de nuevo Usuario";
		/*
		Proceso de insercion
		1-preguntamos si se pasa el vector _POST > 0
		2- si es mayor de cero, es por que estan enviando datos desde un formulario
		3- cargar el modelo que permita ingresar
		4- pasaremos una variable llamada mensaje a la vista en el cual le indicamos si el registro fue ingresado no
		*/
		if(count($this->input->post())>0)
		{
			$resp=$this->usuarios_model->ingresar();
			$data["mensaje"]=$resp;
		}

		$this->load->view('usuarios-forma',$data);
	}	
	public function listado()
	{
		$data=$this->usuarios_model->listar();

		$vector["listado"]=$data;
		$vector["titulo"]="Listado de usuarios";

		$this->load->view('usuarios-tabla', $vector);
	}
	
	public function editar($param)
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');		
		$data["titulo"]="Edicion de Usuario";

		if(count($this->input->post())>0)
		{
			//cuando se preciona un boton es por que los datos se estan enviando al controlador
			//se realizaran las operaciones de modificacion

			$mensaje=$this->usuarios_model->modificar($param);
			$data["mensaje"]=$mensaje;
		}
		//invocar funcion del modelo que nos traiga 
		//los datos del parametro pasado en la funcion
		$registro=$this->usuarios_model->detalle($param);

		$data["registro"]=$registro;
		$data["param"]=$param;
		$this->load->view("usuarios-forma", $data);

	}
}
