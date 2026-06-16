<?php
class Alumno_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function getAll() {
        $resultado = $this->db->get('Alumno');
        $alumno = $resultado->result_array();
        return $alumno;
    }
}
