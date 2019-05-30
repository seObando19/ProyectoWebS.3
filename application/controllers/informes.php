<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informes extends CI_Controller {

	/*
	controlador pricipal
	este controlador solo se puede acceder a el si las variables de session
	se encuentran ativas
	como todas las funciones deben preguntar por ellas, se valida desde el contructor por que es lo primero que se evalua en na clase
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->crud=new grocery_CRUD();
		
		//invocar los modelos que se necesitan ´para todo el controlador
		// $this->load->model("productos_model");
		 $this->load->model("pedidos_model");
		// $this->load->model("clientes_model");

		if(!$this->session->userdata('id'))
	{
		redirect('login');
	}
	}
	
	public function pedidos()
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');
		$data['foto']=$this->session->userdata('foto');
		//
		$data['facebook']=$this->session->userdata('facebook');
		$data['twitter']=$this->session->userdata('twitter');
		$data['LinkelIn']=$this->session->userdata('LinkelIn');
		$data["modulo"]="Pedidos";
		$data["descripcion"]="Informes de pedidos";
		//
		$this->crud->set_theme('flexigrid');
		//2-cargar la tabla
		$this->crud->set_table('pedidos_encabezados');
		$this->crud->columns('pkid','nombre','telefono','direccion','correo','unidades','total','fecha');

		//quitarle las acciones o botones solo dejando exportar y el imprimir
		$this->crud->unset_add();//quitar añadir
		$this->crud->unset_edit(); //quitar editar
		$this->crud->unset_clone(); //quitar clonar
		$this->crud->unset_delete(); //quitar borrado
		$this->crud->unset_read(); //quitar vista previa
		$this->crud->unset_back_to_list(); //quitar botones adicionales

		$data['lista']=$this->pedidos_model->listar();

		$tabla=$this->crud->render();
		//los tres componentes que se llaman output,js_files y css_files
		$data["contenido"]=$tabla->output;
		$data["js_files"]=$tabla->js_files;
		$data["css_files"]=$tabla->css_files;
		
		$this->load->view('crud',$data);
	}

	public function clientes()
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');
		$data["modulo"]="Clientes";
		$data["descripcion"]="Listado de clientes";

		$this->crud->set_theme('flexigrid');
		//2-cargar la tabla
		$this->crud->set_table('clientes');


		$this->crud->set_relation("tipocliente","tiposdeclientes","nombre");

		//campos que vamos a solicitar que ingrese
		$this->crud->fields("tipocliente","nit","nombre","comercial","telefono","direccion","correo","rut","estadosfinanc");
		//campos obligatorios
		$this->crud->required_fields("tipocliente","nit","nombre","telefono","direccion","correo");

		$this->crud->display_as("tiposdecliente","Seleccione tipo de cliente");
		$this->crud->display_as("nit","Digite su cc o nit");
		$this->crud->display_as("nombre","Digite su nombre");
		$this->crud->display_as("telefono","Digite su telefono");
		$this->crud->display_as("direccion","Direccion");
		$this->crud->display_as("correo","Email");
		$this->crud->display_as("rut","Cargar el rut");
		$this->crud->display_as("estadosfinanc","Cargar los estados financieros");


		$this->crud->set_field_upload("rut","assets/uploads/clientes/");
		$this->crud->set_field_upload("estadosfinanc","assets/uploads/clientes/");

		$this->crud->columns("tipocliente","nit","nombre","telefono","direccion","correo");		

		$this->crud->unset_add();//quitar añadir
		$this->crud->unset_edit(); //quitar editar
		$this->crud->unset_clone(); //quitar clonar
		$this->crud->unset_delete(); //quitar borrado
		$this->crud->unset_read(); //quitar vista previa
		$this->crud->unset_back_to_list(); //quitar botones adicionales
		$this->crud->set_subject("Listado de clientes");

		$tabla=$this->crud->render();
		//los tres componentes que se llaman output,js_files y css_files
		$data["contenido"]=$tabla->output;
		$data["js_files"]=$tabla->js_files;
		$data["css_files"]=$tabla->css_files;
		$data['foto']=$this->session->userdata('foto');
		//
		$data['facebook']=$this->session->userdata('facebook');
		$data['twitter']=$this->session->userdata('twitter');
		$data['LinkelIn']=$this->session->userdata('LinkelIn');

		$this->load->view('crud',$data);
	}	


}

