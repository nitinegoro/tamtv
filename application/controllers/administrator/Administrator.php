<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();

		$this->page_title->push('Dashboard', 'Halaman Utama administrator');
	}

	public function index()
	{

		$this->data = array(
			'title' => "Dashboard"
		);

		$this->template->admin('dashboard', $this->data);
	}

}

/* End of file Administrator.php */
/* Location: ./application/controllers/administrator/Administrator.php */