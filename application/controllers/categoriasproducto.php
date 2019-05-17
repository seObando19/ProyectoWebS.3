<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoriasproducto extends CI_Controller {

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
		$data["modulo"]="Categorias de productos";
		$data["descripcion"]="Listado de categorias donde se ubican los productos";

		//Usar crud grocery que podamos cargar el crud de roles
		//esta herramienta se configura y se genera 3 archivos
		//el render o tabla, los js para ejecutarlos y los css asociados
		//estos tres datos se deben pasar a la vista
		//1- Cargar el ema de la tabla.Flexigrid o datatables
		$this->crud->set_theme('flexigrid');
		//2-cargar la tabla
		$this->crud->set_table('categoriasproductos');
		//3-se le define un titulo a la table
		$this->crud->set_subject("Listado de categorias de productos");
		//otras configuraciones

		//definir que campos son requeridos
		$this->crud->required_fields("nombre");

		//definir que campos se deben cargar en el editar o en el ingresar
		$this->crud->fields("nombre");

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
