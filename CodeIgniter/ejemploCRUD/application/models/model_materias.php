<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_materias extends CI_Model {
	public function ListarMaterias(){
		$this->db->order_by('ID ASC');
		return $this->db->get('materias')->result();
	}
	function BuscarID($id){
		$query = $this->db->where('ID',$id);
		$query = $this->db->get('materias');
		return $query->result();
	}
	public function SaveMateria($array){
		$this->db->trans_start();
		$this->db->insert('materias', $array);
		$this->db->trans_complete();
	}
	function edit($data,$id){
		$this->db->where('ID',$id);
		$this->db->update('materias',$data);
	}
	function Eliminar($id){
		$this->db->where('ID',$id);
		$this->db->delete('materias');
	}
}
?>