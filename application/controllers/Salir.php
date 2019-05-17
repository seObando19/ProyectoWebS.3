<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*controlador salir*/
class Salir extends CI_Controller {

	function __construct()
	{
		parent::__construct(); 
	}

	public function index()
	{
		 //cuando se cargue el enlace hacia el ontrolador salir, en esta funcion se destruyen las variables y se redirecciona hacia login para que se force el usuario y clave de nuevo
		$this->session->sess_destroy();
		redirect('login');
	}
	
	}
