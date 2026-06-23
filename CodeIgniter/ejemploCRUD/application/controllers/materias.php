<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City'); 
class materias extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('model_materias');
          $this->load->model('model_seguridad');
     }
     function Seguridad(){
     	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
         $this->model_seguridad->SessionActivo($url);
     }
     public function index(){
          $this->Seguridad();
          $this->load->view('header');
          $data['materias'] = $this->model_materias->ListarMaterias();         
          $this->load->view('view_materias', $data);
          $this->load->view('footer');
	}
     public function nuevo(){
        $this->Seguridad();
		$this->ValidaCampos();
		if($this->form_validation->run() == TRUE){
			$MateriaInsertar = $this->input->post();
			$this->model_materias->SaveMateria($MateriaInsertar);
			redirect("materias?save=true");
		}else{
			$this->load->view('header');
			$this->load->view('view_nueva_materia');
			$this->load->view('footer');
		} 
     }
	 function ValidaCampos(){
		 $this->form_validation->set_rules("NOMBRE", "Nombre", "trim|required");
		 $this->form_validation->set_rules("CARGA_HORARIA", "Carga Horaria", "trim|required|numeric");
		 $this->form_validation->set_rules("ANO", "Año", "trim|required|numeric");
		 $this->form_validation->set_rules("CARRERA", "Carrera", "trim|required");
	 }
	 public function editar($id = NULL){
		if ($id == NULL OR !is_numeric($id)){
			$data['Modulo']  = "Materias";
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
				$this->model_materias->edit($datos_update,$id);
				redirect('materias?update=true');
			}else{
				$this->nuevo();
			}
		}else{
			$data['datos_materia'] = $this->model_materias->BuscarID($id);
			if (empty($data['datos_materia'])){
				$data['Modulo']  = "Materias";
				$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
				$this->load->view('header');
				$this->load->view('view_errors',$data);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('view_nueva_materia',$data);
				$this->load->view('footer');
			}
		}
	}
	public function eliminar($id = NULL){
		if ($id == NULL OR !is_numeric($id)){
			$data['Modulo']  = "Materias";
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
				redirect("materias");
			}else{
				$this->model_materias->Eliminar($id_eliminar);
				redirect("materias?delete=true");
			}
		}else{
			$data['datos_materia'] = $this->model_materias->BuscarID($id);
			if (empty($data['datos_materia'])){
				$data['Modulo']  = "Materias";
				$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
				$this->load->view('header');
				$this->load->view('view_errors',$data);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('view_delete_materia',$data);
				$this->load->view('footer');
			}
		}
	}
}
