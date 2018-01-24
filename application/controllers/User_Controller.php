<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_Controller extends CI_Controller {
    
     public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        }
    
   public function index()
	{
	   $this->load->view('user/home');
	}  
    
}

