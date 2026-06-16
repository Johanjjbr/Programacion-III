<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playa extends CI_Controller {
    public function listar(){
        $this->load->model('Playa_model', 'UM', true);
        $datos['turno'] = $this->UM->getAll();
        $this->load->view('PlayaListar', $datos);
       
    }
}
?>