<?php 
/*
Modelo de la tabla usuarios
los modelos heredan de la clase principal CI_model
aprovechar las caracteristicas para ahorrar codigo
*/
class Usuarios_model extends CI_model
{
	function __construct()
	{
		//invocar el helper security
		$this->load->helper('security');
	}
	function ingresar()
	{
		/*
		como se hizo en el acceso de login se recuperan las variables, se les aplica el xss clean perguntar po el campo unico correo
		*/
		$correo=$this->input->post('correo');
		$nombre=$this->input->post('nombre');
		$telefono=$this->input->post('telefono');
		$perfil=$this->input->post('perfil');
		$clave=$this->input->post('clave');
		//
		$correo=$this->security->xss_clean($correo);
		$nombre=$this->security->xss_clean($nombre);
		$telefono=$this->security->xss_clean($telefono);
		$perfil=$this->security->xss_clean($perfil);
		$clave=$this->security->xss_clean($clave);
		//
		/*
		Para validar si un registro ya existe podemos usar la funcion get_where de CI 
		la cual si encuentra registro  devuelve el array o en caso contrario devuelve en array pero en 0
		*/
		//
		$query=$this->db->get_where("usuarios",array("correo"=>$correo));
		$resultado=$query->result_array();
		if(count($resultado)>0)
		{
			$resp="este regisro ya se encuentra. revise los datos";
		}else
		{
			//el siguiente proceso aplica tanto para modificar o inserta. CI nos recomienda pasar los datos en un array y ejecutar insert o el update
			$vector=array(
				"correo"=>$correo,
				"clave"=>md5($clave),
				"nombre"=>$nombre,
				"telefono"=>$telefono,
				"perfil"=>$perfil
			);
			$this->db->insert("usuarios",$vector);
			$resp="Registro insertado con exito";
		}
		return $resp;
	}
	function listar()
	{
		//Traer listado de usurios y devolverlo para que lo lea el controlador y este a su vez lo pase a la vista
		$query=$this->db->get("usuarios");
		return $query->result_array();
	}
	function validar_acceso()
	{
		//esta funcion esper dos parametros que vienen de un formulario 
		//como on datos super globales, no es necesario pasarlos como parametros
		//($_GET,$_POST,$_FILES,$_ENV,$_SERVER, ETC)

		//aprovechando vamos a invocar la forma como recibe los parametros
		$correo=$this->input->post('correo');
		$clave=$this->input->post('clave');

		//aplicr politicas de control y limpieza de codigo malisioso
		//que nos envian en un formulario
		$correo=$this->security->xss_clean($correo);
		$clave=$this->security->xss_clean($clave);

		//select *from usuarios where correo=$correo and clave=md5($clave)
		//aprovechando el codeigniter, podemos hacer un select usando el comando
		//get_where el cual es la tabla y el vector de los parametros que deseo
		//usar con el and o con el or
		//el vector debe ser asociativo y los nombres de las variables deben coincidir con los nombres de los campos
		$vector=array("correo"=>$correo,"clave"=>md5($clave));
		$query=$this->db->get_where("usuarios",$vector);
		//si se desea ejecutar el query paravalidar en la base de datos se usa 
		//last_queyr
		//echo $this->db->last_query();
		//print_r();
		//exit();
		return $query->result_array();
	}
	function eliminar($param)
	{
		/*
	se puede eliminar realizando el delete from table pero el CI maneja su propia libreria  que se llama this->db->delete la cual se le debe pasar el parametro que borra y ejecuta la funcion
	*/
	$this->db->where("id",$param);
	return $this->db->delete("usuarios");
	}
	function detalle($param)
	{
		$query=$this->db->get_where("usuarios",array("id"=>$param));
		return $query->result_array();

	}
	function modificar($param)
	{
		$correo=$this->input->post('correo');
		$nombre=$this->input->post('nombre');
		$telefono=$this->input->post('telefono');
		$perfil=$this->input->post('perfil');
		//
		$correo=$this->security->xss_clean($correo);
		$nombre=$this->security->xss_clean($nombre);
		$telefono=$this->security->xss_clean($telefono);
		$perfil=$this->security->xss_clean($perfil);

					$vector=array(
				"correo"=>$correo,
				"nombre"=>$nombre,
				"telefono"=>$telefono,
				"perfil"=>$perfil
			);
					//el proceso de edicion usando CI es pasando el parametro where, el vector y a que  tabla 
					//ejecutarlo.se parece a el que se usa con get_where
					$this->db->where("id",$param);
					if($this->db->update("usuarios", $vector))
					{
						$mensaje="modificacion realizada";
					}else
					{
						$mensaje="No se puede realizar el proceso. Intente de nuevo";
					}
					return $mensaje;
	}	
	
}
 ?>
