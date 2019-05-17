<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

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
		$data["modulo"]="Clientes";
		$data["descripcion"]="Listado de clientes";

		//Usar crud grocery que podamos cargar el crud de roles
		//esta herramienta se configura y se genera 3 archivos
		//el render o tabla, los js para ejecutarlos y los css asociados
		//estos tres datos se deben pasar a la vista
		//1- Cargar el ema de la tabla.Flexigrid o datatables
		$this->crud->set_theme('flexigrid');
		//2-cargar la tabla
		$this->crud->set_table('clientes');

		//si queremos relacionar dos tablas y que podamos por medio de un select asociar 
		//un dato de una de ellas usamos set_relation (campo de la tabla set table, la
		// tabla a asociar, que campos a mostrar de la tabla a asociar)

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

		//Se pueden subir archivos a determinados campos
		//usando set_field_upload ("campo","ruta donde se cargara el archivo")
		$this->crud->set_field_upload("rut","assets/uploads/clientes/");
		$this->crud->set_field_upload("estadosfinanc","assets/uploads/clientes/");

		$this->crud->columns("tipocliente","nit","nombre","telefono","direccion","correo");		
		//3-se le define un titulo a la table
		$this->crud->set_subject("Listado de clientes");
		//otras configuraciones

		//definir que campos son requeridos
		//$this->crud->required_fields("nombre");			

		//definir que campos se deben cargar en el editar o en el ingresar
		//$this->crud->fields("nombre");

		//cambiarle el nombre del campo en la pantalla	

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
}
