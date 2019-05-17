<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	/*
	controlador roles
		aplicar el crud grocery
		para hacerlo es necesario modificar una variabls de los confug.php del CI
		esa variables csrf regenerate
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
		//instanciar la libreria
		$this->crud=new grocery_CRUD();

		if(!$this->session->userdata('id'))
	{
		redirect('login');
	}
	}
	
	public function index()
	{
		$data["nombreusuario"]=$this->session->userdata('nombre');
		$data["modulo"]="Usuarios";
		$data["descripcion"]="Listado de Usuarios en el sistema";

		//Usar crud grocery que podamos cargar el crud de roles
		//esta herramienta se configura y se genera 3 archivos
		//el render o tabla, los js para ejecutarlos y los css asociados
		//estos tres datos se deben pasar a la vista
		//1- Cargar el ema de la tabla.Flexigrid o datatables
		$this->crud->set_theme('flexigrid');
		//2-cargar la tabla
		$this->crud->set_table('usuarios');

		//si queremos relacionar dos tablas y que podamos por medio de un select asociar 
		//un dato de una de ellas usamos set_relation (campo de la tabla set table, la
		// tabla a asociar, que campos a mostrar de la tabla a asociar)
				

		$this->crud->set_relation("perfil","roles","nombre");

		//campos que vamos a solicitar que ingrese
		$this->crud->fields("perfil","nombre","clave","correo","telefono","foto","facebook","twitter","LinkelIn");
		//campos obligatorios
		$this->crud->required_fields("perfil","nombre","clave","correo","telefono");
		$this->crud->display_as("perfil","Rol asociado");
		$this->crud->display_as("nombre","Nombre");
		$this->crud->display_as("telefono","Telefono");
		$this->crud->display_as("clave","Clave");
		$this->crud->display_as("correo","Email de acceso");
		$this->crud->display_as("fechaingreso","registro");
		$this->crud->display_as("fechamodificacion","ultimo cambio");	


		$this->crud->columns("foto","perfil","nombre","correo","telefono","fechamodificacion");
		$this->crud->set_field_upload("foto","assets/uploads/usuarios/");		
		$this->crud->set_subject("Listado usuarios");


		$this->crud->callback_before_insert(array($this,"encriptar"));

		//se puede cambiar los tipos de campos tipo text usando change_field_type
		$this->crud->change_field_type("clave","password");

		//se puede dependiendo de la accion que se ejecute realizar algun proceso adicional 
		if($this->crud->getState()=="edit") 
		{
			$this->crud->field_type("clave","hidden");
		}
		

		//4-Aplicar el render  que es ejecutar estas variables y esperar los 3 cmponentes
		//para cargar en la vista
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


	function encriptar($post_array)
	{
		$post_array["clave"]=md5($post_array["clave"]);
		return $post_array;
	}
}
