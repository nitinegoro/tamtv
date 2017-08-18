<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Web 
{
	public $data;

	public $per_page;

	public $page;

	public function __construct()
	{
		parent::__construct();
		$this->meta_tags->set_meta_tag('canonical', current_url() );
		$this->meta_tags->set_meta_tag('type', 'website' );

		$this->page = $this->input->get('page');

		$this->per_page = 15;
	}

	public function index()
	{
		$this->meta_tags->set_meta_tag('title', $this->options->get('sitename') );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		if($this->session->userdata('user_login') == FALSE)  
			redirect(base_url());

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("me/{$this->uri->segment(2)}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->comment->get_user_comments(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Akun Saya"	
		);

		$this->template->view('account', $this->data);
	}

	public function change_password()
	{
		$account = $this->user->getMe();

		if( $account == FALSE )
			show_404();

		$this->meta_tags->set_meta_tag('title', $this->options->get('sitename') );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_validate_username|min_length[6]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|callback_validate_email');
		$this->form_validation->set_rules('newpassword', 'Password baru ', 'trim');
		$this->form_validation->set_rules('repeatpassword', 'Ulangi Password', 'trim|matches[newpassword]');
		$this->form_validation->set_rules('oldpassword', 'Password lama ', 'trim|required|callback_validate_password');

		if ($this->form_validation->run() == TRUE)
		{
			$this->user->updateAccount();

			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		}

		$this->data = array(
			'title' => "Ganti Password"	,
			'account' => $account
		);

		$this->template->view('change-password', $this->data);
	}

	/**
	 * Check Ketersediaan E-mail
	 *
	 * @return string
	 **/
	public function validate_email()
	{
		if( $this->user->validate_email() )
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_email', 'E-Mail sudah pernah terdaftar.');
			return false;
		}
	}

	/**
	 * Check Ketersediaan Username
	 *
	 * @return string
	 **/
	public function validate_username()
	{
		if( $this->user->validate_username() )
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_username', 'Username sudah pernah terdaftar.');
			return false;
		}
	}

	/**
	 * Cek kebenaran password
	 *
	 * @return Boolean
	 **/
	public function validate_password()
	{
		if( $this->user->validate_password() )
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_password', 'Password lama anda tidak cocok!');
			return false;
		}
	}
}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */