<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fb extends Web 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('facebook'));
	}

	public function index()
	{
		$this->facebook->login_url();
	}

    public function get_user()
    {
    	$user = $this->user->get_user_login();

    	if($user AND $this->input->post('email') != '')
    	{
	        $account_session = array(
	        	'user_login' => TRUE,
			    'ID' => $user->ID,
			    'user' => (Object) array(
				    'ID' => $user->ID,
				    'fullname' => $user->fullname,
				    'email' => $user->username,
				    'username' => $user->username,
				    'avatar' => $user->avatar,
				    'last_login' => $user->last_login
			    )
	        );	
	        
	        $this->session->set_userdata( $account_session );

	        $output = array('status' => true);
    	} else {
			$this->template->alert(
				' Maaf! anda tidak terdaftar, silahkan mendaftar terlebih dahulu.', 
				array('type' => 'warning','icon' => 'warning')
			);

    		$output = array('status' => false);
    	}

    	$this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

   	public function daftar()
   	{

   	}
}

/* End of file Fb.php */
/* Location: ./application/controllers/api/Fb.php */