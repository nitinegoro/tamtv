<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');

		$this->load->model(array('options','user'));

		$this->load->library(array('form_validation','template','session'));
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$user = $this->user->get_admin_login();

			if( $user != FALSE)
			{
				if (password_verify($this->input->post('password'), $user->password)) 
				{
			        $user_session = array(
			        	'admin_login' => TRUE,
			        	'ID' => $user->ID,
			        	'user' => (Object) array(
			        		'ID' => $user->ID,
			        		'fullname' => $user->fullname,
			        		'email' => $user->email,
			        		'username' => $user->username,
			        		'last_login' => $user->last_login
			        	)
			        );	

			        $this->session->set_userdata( $user_session );

			        $this->user->update_last_login($user->ID);

					if( $this->input->get('back-to') != '' )
					{
						redirect($this->input->get('back-to'));
					} else {
						redirect(base_url("administrator"));
					}
				} else {
					$this->template->alert(
						' Maaf! Kombinasi Username / E-Mail dengan password anda tidak valid.', 
						array('type' => 'danger','icon' => 'warning')
					);
				}
			} else {
				$this->template->alert(
					' Maaf! Kombinasi Username / E-Mail dengan password anda tidak valid.', 
					array('type' => 'danger','icon' => 'warning')
				);
			}
		}

		$this->data = array(
			'title' => "Login Administrator | TAM TV Babel", 
		);

		$this->load->view('administrator/login', $this->data);
	}

	public function signout()
	{
		$this->session->sess_destroy();

		redirect(base_url("administrator/auth"));
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/administrator/Auth.php */