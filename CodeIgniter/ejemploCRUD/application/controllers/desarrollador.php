<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class desarrollador extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->model('model_seguridad');
     }
     function Seguridad(){
     	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
         $this->model_seguridad->SessionActivo($url);
     }
     public function index(){
          $this->Seguridad();
          $this->load->view('header');
          $this->load->view('view_desarrollador');
          $this->load->view('footer');
     }
}
