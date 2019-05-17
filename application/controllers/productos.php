<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	/*
	controlador Categorias de productos
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
		$data["modulo"]="clientes";
		$data["descripcion"]="Listado de los productos";

		//Usar crud grocery que podamos cargar el crud de roles
		//esta herramienta se configura y se genera 3 archivos
		//el render o tabla, los js para ejecutarlos y los css asociados
		//estos tres datos se deben pasar a la vista
		//1- Cargar el ema de la tabla.Flexigrid o datatables
		$this->crud->set_theme('flexigrid');
		//2-cargar la tabla
		$this->crud->set_table('productos');
		$this->crud->set_relation("categoria","categoriasproductos","nombre");
		$this->crud->fields("categoria","ref","nombre","foto1","foto2","descripcion","precio","iva","cantidad");
		$this->crud->required_fields("ref","nombre","foto1","precio","iva","cantidad");
		$this->crud->display_as("categoria","seleccione la categoria");
		$this->crud->display_as("ref","Ingrese referencia");
		$this->crud->display_as("nombre","Ingrese nombre");
		$this->crud->display_as("descripcion","Resumen -detalle del Productoo");
		$this->crud->display_as("precio","Precio");
		$this->crud->display_as("iva","% de iva");
		$this->crud->display_as("cantidad","Cantidad de Producto");
		$this->crud->display_as("foto1","Imagen 1");
		$this->crud->display_as("foto2","Imagen 2");
		$this->crud->set_field_upload("foto1","assets/uploads/productos/");		
		$this->crud->set_field_upload("foto2","assets/uploads/productos/");
		$this->crud->columns("foto1","categoria","ref","nombre","precio","iva","cantidad");
		$this->crud->set_subject("Listado de  productos");
		$this->crud->change_field_type("precio","integer");
		$this->crud->change_field_type("iva","integer");
		$this->crud->change_field_type("cantidad","integer");



		//3-se le define un titulo a la table
		
		//otras configuraciones

		//definir que campos son requeridos

		//definir que campos se deben cargar en el editar o en el ingresar
		

		//cambiarle el nombre del campo en la pantalla
		$this->crud->display_as("nombre","Categoria");
		$this->crud->display_as("fechaingreso","Fecha de registro");
		$this->crud->display_as("fechamodificacion","Ultima modificacion");

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
