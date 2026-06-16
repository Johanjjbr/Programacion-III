<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {
    public function listar(){
        $this->load->model('Alumno_model', 'UM', true);
        $datos['alumno'] = $this->UM->getAll();
        $this->load->view('alumnoListar', $datos);
       
    }
}
?>