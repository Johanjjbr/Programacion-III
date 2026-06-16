<?php
class Playa_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function getAll() {
        $resultado = $this->db->get('turno');
        $turno = $resultado->result_array();
        return $turno;
    }
}
