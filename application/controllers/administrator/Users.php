<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_panel 
{
	public $data = array();

	public $per_page;

	public $page;

	public $query;

	public function __construct()
	{
		parent::__construct();
	
		$this->breadcrumbs->unshift(1, 'Pengguna', "administrator/users");

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->page_title->push('Pengguna', '');

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("administrator/users?per_page={$this->per_page}&query={$this->query}&role={$this->input->get('role')}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->user->getAll(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Pengguna",
			'users' => $this->user->getAll($this->per_page, $this->page)
		);

		$this->template->admin('users', $this->data);
	}

	public function create()
	{
		$this->page_title->push('Pengguna', 'Tambah Baru');

		$this->breadcrumbs->unshift(2, 'Tambah Baru', "index");

		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('role', 'Peran', 'trim|required');

		if( $this->form_validation->run() == TRUE )
		{
			$this->user->create_admin();

			redirect(current_url());
		} 

		$this->data = array(
			'title' => "Tambah Pengguna"
		);

		$this->template->admin('create-user', $this->data);
	}

	public function update($param = 0)
	{
		$user = $this->user->get( $param );

		if( $user == FALSE )
			show_404();

		$this->page_title->push('Pengguna', 'Edit Pengguna');

		$this->breadcrumbs->unshift(2, 'Edit Pengguna', "index");

		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_validate_username|min_length[6]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|callback_validate_email');
		$this->form_validation->set_rules('role', 'Peran', 'trim|required');

		if( $this->form_validation->run() == TRUE )
		{
			$this->user->update_user($param);

			redirect(current_url());
		} 

		$this->data = array(
			'title' => "Edit Pengguna",
			'user' => $user
		);

		$this->template->admin('update-user', $this->data);
	}

	public function delete($param = 0)
	{
		$this->user->delete($param);

		redirect(base_url('administrator/users'));
	}

	public function bulkaction()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->user->delete_multiple();
				break;
			
			default:
				# code...
				break;
		}

		redirect(base_url("administrator/users"));
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

	public function account()
	{
		$account = $this->user->getMe();

		if( $account == FALSE )
			show_404();

		$this->page_title->push('Pengguna', 'Akun Saya');

		$this->breadcrumbs->unshift(2, 'Akun Saya', "index");

		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_validate_username|min_length[6]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|callback_validate_email');
		$this->form_validation->set_rules('newpassword', 'Password baru ', 'trim');
		$this->form_validation->set_rules('repeatpassword', 'Ulangi Password', 'trim|matches[newpassword]');
		$this->form_validation->set_rules('oldpassword', 'Password lama ', 'trim|required|callback_validate_password');

		if ($this->form_validation->run() == TRUE)
		{
			$this->user->updateAdminAccount();

			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);

			redirect(current_url());
		}

		$this->data = array(
			'title' => "Edit Pengguna",
			'user' => $account
		);

		$this->template->admin('account-user', $this->data);
	}
}

/* End of file Users.php */
/* Location: ./application/controllers/administrator/Users.php */