<?php
class peliculas extends CI_Controller {
    public function show($id){
        $this->load->model('Peliculas_model');
        $peliculas = $this->Peliculas_model->get_reviews($id);
        $data['title'] = $peliculas['titulo'];
        $data['grade'] = $peliculas ['puntuacion'];
        $this->load->view('Peliculas_review', $data);
    }
}
?>