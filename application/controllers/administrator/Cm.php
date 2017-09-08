<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cm extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();

		$this->page_title->push('Komentar', 'Manajemen Komentar');

		$this->breadcrumbs->unshift(1, 'Komentar', "administrator/cm");
	}

	public function index()
	{
		$this->data = array(
			'title' => "Komentar"
		);

		$this->template->admin('comments', $this->data);	
	}

}

/* End of file Cm.php */
/* Location: ./application/controllers/administrator/Cm.php */