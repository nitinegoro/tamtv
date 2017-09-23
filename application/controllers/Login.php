<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Web 
{
	public function __construct()
	{
		parent::__construct();

		$this->meta_tags->set_meta_tag('news_keywords', '' );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$user = $this->user->get_user_login();

			if( $user != FALSE)
			{
				if (password_verify($this->input->post('password'), $user->password)) 
				{
			        $user_session = array(
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

			        $this->session->set_userdata( $user_session );

			        $this->user->update_last_login($user->ID);

					if( $this->input->get('back-to') != '' )
					{
						redirect($this->input->get('back-to'));
					} else {
						redirect(base_url());
					}
				} else {
					$this->template->alert(
						' Maaf! Kombinasi Username / E-Mail dengan password anda tidak valid.', 
						array('type' => 'warning','icon' => 'warning')
					);
				}
			} else {
				$this->template->alert(
					' Maaf! Kombinasi Username / E-Mail dengan password anda tidak valid.', 
					array('type' => 'warning','icon' => 'warning')
				);
			}
		}

		$this->meta_tags->set_meta_tag('title', "Login" );

		$this->data = array(
			'title' => "Login "	
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('login', $this->data);
		} else {
			$this->load->view('mobile/login', $this->data);
		}
	}

	public function forgot()
	{
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->template->alert(
				' Maaf! Alamat E-Mail tidak tersedia.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}

		$this->meta_tags->set_meta_tag('title', "Login" );

		$this->data = array(
			'title' => "Login "	
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('forgot', $this->data);
		} else {
			$this->load->view('mobile/forgot', $this->data);
		}		
	}

	public function signout()
	{
		$this->session->sess_destroy();

		redirect(base_url());
	}

	public function signup()
	{
		$this->meta_tags->set_meta_tag('title', "Daftar Akun" );

		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$this->form_validation->set_rules('condition', 'Anda tidak bisa mendaftar apabila tidak menyetujui syarat dan ketentuan yang kami berikan.', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->user->create();

			$user = $this->user->get_user_login();
			        
			$user_session = array(
				 'user_login' => TRUE,
				 'ID' => $user->ID,
				 'user' => (Object) array(
					  'ID' => $user->ID,
					  'fullname' => $user->fullname,
					  'email' => $user->username,
					  'avatar' => $user->avatar,
					  'username' => $user->username,
					  'last_login' => $user->last_login
				 )
			);	

			$this->session->set_userdata( $user_session );

			redirect(base_url());
		}

		$this->data = array(
			'title' => "Daftar Akun "	
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('signup', $this->data);
		} else {
			$this->load->view('mobile/signup', $this->data);
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */