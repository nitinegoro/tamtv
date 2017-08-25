<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->page_title->push('Menu Navigasi', 'Pengaturan Menu Navigasi');
	}

	public function index()
	{

		$this->data = array(
			'title' => "Menu Navigasi"
		);

		$this->template->admin('menus', $this->data);
	}

}

/* End of file Menu.php */
/* Location: ./application/controllers/administrator/Menu.php */