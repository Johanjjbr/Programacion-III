<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City'); 
class alumnos extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('model_alumnos');
          $this->load->model('model_seguridad');
     }
     function Seguridad(){
     	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
         $this->model_seguridad->SessionActivo($url);
     }
     public function index(){
          $this->Seguridad();
          $this->load->view('header');
          $data['alumnos'] = $this->model_alumnos->ListarAlumnos();         
          $this->load->view('view_alumnos', $data);
          $this->load->view('footer');
	}
     public function nuevo(){
        $this->Seguridad();
		$this->ValidaCampos();
		if($this->form_validation->run() == TRUE){
			$AlumnoInsertar = $this->input->post();
			$this->model_alumnos->SaveAlumno($AlumnoInsertar);
			redirect("alumnos?save=true");
		}else{
			$this->load->view('header');
			$this->load->view('view_nuevo_alumno');
			$this->load->view('footer');
		} 
     }
	 function ValidaCampos(){
		 $this->form_validation->set_rules("NOMBRE", "Nombre", "trim|required");
		 $this->form_validation->set_rules("APELLIDO", "Apellido", "trim|required");
		 $this->form_validation->set_rules("DNI", "DNI", "trim|required");
		 $this->form_validation->set_rules("MAIL", "Mail", "trim|required|valid_email");
		 $this->form_validation->set_rules("TELEFONO", "Telefono", "trim");
	 }
	 public function editar($id = NULL){
		if ($id == NULL OR !is_numeric($id)){
			$data['Modulo']  = "Alumnos";
			$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
			$this->load->view('header');
			$this->load->view('view_errors',$data);
			$this->load->view('footer');
			return;
		}
		if ($this->input->post()) {
			$this->ValidaCampos();
			if ($this->form_validation->run() == TRUE){
				$datos_update = $this->input->post();
				$this->model_alumnos->edit($datos_update,$id);
				redirect('alumnos?update=true');
			}else{
				$this->nuevo();
			}
		}else{
			$data['datos_alumno'] = $this->model_alumnos->BuscarID($id);
			if (empty($data['datos_alumno'])){
				$data['Modulo']  = "Alumnos";
				$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
				$this->load->view('header');
				$this->load->view('view_errors',$data);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('view_nuevo_alumno',$data);
				$this->load->view('footer');
			}
		}
	}
	public function eliminar($id = NULL){
		if ($id == NULL OR !is_numeric($id)){
			$data['Modulo']  = "Alumnos";
			$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
			$this->load->view('header');
			$this->load->view('view_errors',$data);
			$this->load->view('footer');
			return;
		}
		if ($this->input->post()) {
			$id_eliminar = $this->input->post('ID');
			$boton       = strtoupper($this->input->post('btn_guardar'));
			if($boton=="NO"){
				redirect("alumnos");
			}else{
				$this->model_alumnos->Eliminar($id_eliminar);
				redirect("alumnos?delete=true");
			}
		}else{
			$data['datos_alumno'] = $this->model_alumnos->BuscarID($id);
			if (empty($data['datos_alumno'])){
				$data['Modulo']  = "Alumnos";
				$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
				$this->load->view('header');
				$this->load->view('view_errors',$data);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('view_delete_alumno',$data);
				$this->load->view('footer');
			}
		}
	}
}
