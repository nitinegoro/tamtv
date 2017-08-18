<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->page_title->push('Pengguna', '');

		$this->breadcrumbs->unshift(1, 'Pengguna', "index");
	}

	public function index()
	{
		$this->data = array(
			'title' => "Pengguna"
		);

		$this->template->admin('users', $this->data);
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/administrator/Users.php */