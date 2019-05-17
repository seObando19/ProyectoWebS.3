<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	/*
	controlador pricipal
	este controlador solo se puede acceder a el si las variables de session
	se encuentran ativas
	como todas las funciones deben preguntar por ellas, se valida desde el contructor por que es lo primero que se evalua en na clase
	*/
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id'))
	{
		redirect('login');
	}
	}
	
	public function index()
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');
		$data["modulo"]="Bienvendos";
		$data['foto']=$this->session->userdata('foto');
		//
		$data['facebook']=$this->session->userdata('facebook');
		$data['twitter']=$this->session->userdata('twitter');
		$data['LinkelIn']=$this->session->userdata('LinkelIn');
		$data["descripcion"]="Sistema de pedidos centralizados";
		$this->load->view('principal',$data);
	}
}
