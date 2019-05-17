<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*controlador login*/
class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct(); 
		$this->load->model("usuarios_model");
	}

	public function index()
	{
		$this->load->view('login');
	}
	function acceso()
	{
		//este controlador es el que permite validar con el modelo
		//si el usuario existe
		//if($_POST['correo']<>"" && $_POST['clave']<>"")		
			//invoque el model
		//}else
		//{
		//	redirect('login');
		//}

		//*****************************************************
		//el proceso de vlidacion lo hara por completo el modelo
		//lo unico que va ser el controlador es invocar el modelo
		//si el modelo retorna valores, que permita cargar las variables de session
		//si no trae lo mande con un redirect a login
		//***********************************************************

		$data=$this->usuarios_model->validar_acceso();
		//print_r(($data));
		//exit();

		if(sizeof($data)>0)
		{
			//cargar las sessiones
			//las sessiones em el ci no se cargan como normalmente  que se hace
			//session_star();
			//$_SESSION
			//en el ci se una es pasar los datos a un vector asociativo y luego 
			//ejecutar la funcion set_userdata
			//para que estos funcione debe estar la libreria session activa
			$data_session=array(
				'id'=>$data[0]['id'],
				'nombre'=>$data[0]['nombre'],
				'telefono'=>$data[0]['telefono'],
				'foto'=>$data[0]["foto"],
				'facebook'=>$data[0]["facebook"],
				'twitter'=>$data[0]["twitter"],
				'LinkelIn'=>$data[0]["LinkelIn"]
			);
			$this->session->set_userdata($data_session);
			redirect('principal');
		}
		else{
			redirect('login');
		}
	}
}
