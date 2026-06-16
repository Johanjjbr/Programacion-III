<?php
class Peliculas extends CI_Controller {
}
?>

<?php class peliculas extends CI_Controller {

    public function show($id){
        $this->load->model('peliculas_model');
        $pelicula = $this->Peliculas_model->get_reviews($id);
        $data['title'] = $pelicula['titulo'];
        $data['grade'] = $peliculas ['puntuacion'];
        $this->load->view('pelicula_review', $data);
    }
}
?>