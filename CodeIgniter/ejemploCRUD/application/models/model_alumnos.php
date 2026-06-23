<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_alumnos extends CI_Model {
	public function ListarAlumnos(){
		$this->db->order_by('ID ASC');
		return $this->db->get('alumnos')->result();
	}
	function BuscarID($id){
		$query = $this->db->where('ID',$id);
		$query = $this->db->get('alumnos');
		return $query->result();
	}
	public function SaveAlumno($array){
		$this->db->trans_start();
		$this->db->insert('alumnos', $array);
		$this->db->trans_complete();
	}
	function edit($data,$id){
		$this->db->where('ID',$id);
		$this->db->update('alumnos',$data);
	}
	function Eliminar($id){
		$this->db->where('ID',$id);
		$this->db->delete('alumnos');
	}
}
?>