<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home');
	}

	public function adminRegister(){
		$this->load->model('queries');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$roles = $this -> queries -> getRoles ();
		
		$this->form_validation->set_rules('username', 'Username', 'Required');
		$this->form_validation->set_rules('email', 'Email', 'Required');
		$this->form_validation->set_rules('gender', 'Gender', 'Required');
		$this->form_validation->set_rules('role_id', 'Role', 'Required');
		$this->form_validation->set_rules('password', 'Password', 'Required');
		$this->form_validation->set_rules('confpwd', 'Password Again', 'Required');
		
		
		//$this->form_validation->set_rules ('<div class="text-danger">',' </div>' );//
		
		var_dump ($this->form_validation->run() ) ;
		if ($this->form_validation->run() ) {
				echo 'validation passed';
		}
		else {
				echo validation_errors();
		}

		$this->load->view('register', ['roles' => $roles]);

	}

	

	public function adminSignup (){
		

	}
}
