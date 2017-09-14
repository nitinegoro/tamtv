<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google extends Web 
{
	public function __construct()
	{
		parent::__construct();
        
        $this->load->helper(array('url'));
        
        $this->load->library(array('form_validation', 'session'));
	}

    public function index()
    {
       print_r($this->session->userdata('user'));
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
  
    public function log_google()
    {
        $client = $this->get_client();
        $auth_url = $client->createAuthUrl();
        redirect($auth_url);
    }
 
    public function logout()
    {
        $this->session->set_userdata('google', null);
 
        redirect('api/google');
    }
  
    public function callback()
    {
        $client = $this->get_client();
        $client->authenticate($_GET['code']);
  
        # ambil profilenya
        $plus = new Google_Service_Plus($client);
        $profile = $plus->people->get("me");
        $email = $profile['emails'][0]['value'];

	  	if( $profile == TRUE ) 
	  	{
			if( $this->db->get_where('users', array('email' => $email))->num_rows() == FALSE )
			{
				$object = array(
					'fullname' => @$profile['name']['familyName'].' '.$profile['name']['givenName'],
					'username' => @strtolower($profile['name']['givenName']),
					'email' => @$profile['emails'][0]['value'],
					'password' => null,
					'registered' => date('Y-m-d H:i:s'),
					'avatar' => @$profile['emails']['url'],
					'status' => 1
				);

				$this->db->insert('users', $object);
				$insert = $this->db->insert_id();

				if($insert  == TRUE )
					$this->create_session_login($this->db->get_where('users', array('ID' => $insert))->row());
			} else {
				$this->create_session_login($this->db->get_where('users', array('email' => $email))->row());
			}
	  	} 

        if( $this->input->get('back-to') != '' )
        {
            redirect($this->input->get('back-to'));
        } else {
            redirect(base_url());
        }
    }
  
    private function get_client()
    {
        $client = new Google_Client();
        $client->setAuthConfigFile(APPPATH . 'client_secret.json'); 

        $client->setRedirectUri("http://localhost/tamtv/api/google/callback");
        $client->setScopes(array(
            "https://www.googleapis.com/auth/plus.login",
            "https://www.googleapis.com/auth/userinfo.email",
            "https://www.googleapis.com/auth/userinfo.profile",
            "https://www.googleapis.com/auth/plus.me",
        ));
  
        return $client;
    }

}

/* End of file Google.php */
/* Location: ./application/controllers/api/Google.php */