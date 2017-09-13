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
	
	public function me($param = 0) {
        $user = $this->facebook->login('get', '/me');
        if (!isset($user['error']))
        {
            print_r($user);
        }
	}

    public function get_user()
    {
    	$user = $this->db->get_where('users', array('email' => $this->input->post('email')))->row();

    	if($user == TRUE)
    	{
	        $this->create_session_login($user);

	        $output = array('status' => true);
    	} else {
    	    $this->daftar();

    		if( $this->input->post('email') == FALSE )
    		{
        		$this->template->alert(
        			' Maaf! <br>kami tidak bisa mengakses alamat E-Mail anda.', 
        			array('type' => 'warning','icon' => 'warning')
        		);
    		
    		    $output = array('status' => false);
    		} else {
    		    $output = array('status' => true);
    		}
    	}

    	$this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    private function create_session_login($userCheck = FALSE)
    {
	  	$account_session = array(
		   'user_login' => TRUE,
			'ID' => $userCheck->ID,
			'user' => (Object) array(
				'ID' => $userCheck->ID,
				'fullname' => $userCheck->fullname,
				'email' => $userCheck->username,
				'username' => $userCheck->username,
                'avatar' => $userCheck->avatar,
				'last_login' => $userCheck->last_login
	 		)
		);	
		$this->session->set_userdata( $account_session );
    }
    
   	private function daftar()
   	{
		if( $this->input->post('email') != '' )
		{
			if( $this->db->get_where('users', array('email' => $this->input->post('email')))->num_rows() == FALSE )
			{
    			$object = array(
    				'fullname' => $this->input->post('name'),
    				'username' => $this->slug->create_slug( $this->input->post('name')),
    				'email' =>  $this->input->post('email'),
    				'password' => null,
    				'registered' => date('Y-m-d H:i:s'),
    				'avatar' =>  $this->input->post('picture')['data']['url'],
    				'status' => 1
    			);
    
    			$this->db->insert('users', $object);
    			$insert = $this->db->insert_id();
    
    			if($insert  == TRUE )
    			    $this->create_session_login($this->db->get_where('users', array('ID' => $insert))->row());
    			    
    			return $insert;
			}
		}
   	}
}

/* End of file Fb.php */
/* Location: ./application/controllers/api/Fb.php */