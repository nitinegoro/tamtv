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
		$this->meta_tags->set_meta_tag('title', "Login" );

		$this->data = array(
			'title' => "Login "	
		);

		$this->template->view('login', $this->data);
	}

	public function signup()
	{
		$this->meta_tags->set_meta_tag('title', "Daftar Akun" );

		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$this->form_validation->set_rules('condition', 'Anda tidak bisa mendaftar apabila tidak menyetuji syarat dan ketentuan yang kami berikan.', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->user->create();

			redirect(current_url());
		}

		$this->data = array(
			'title' => "Daftar Akun "	
		);

		$this->template->view('signup', $this->data);
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */