<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('page');
		
		$this->page_title->push('Menu Navigasi', 'Pengaturan Menu Navigasi');

		$this->load->js(base_url("public/admin/js/jquery.nestable.js"));
		$this->load->js(base_url("public/admin/app/menus.js"));
	}

	public function index()
	{

		$this->data = array(
			'title' => "Menu Navigasi"
		);

		$this->template->admin('menus', $this->data);
	}

	public function updatestructure()
	{
		$this->menus->updatestructure();
	}

	public function ajaxupdate($param = 0)
	{
		if( $param != FALSE)
		{
			$this->menus->update( $param );

			$this->data = array('stutus' => 'success', 'data' => $this->input->post());
		} else {
			$this->data = array('stutus' => 'failed');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}
}

/* End of file Menu.php */
/* Location: ./application/controllers/administrator/Menu.php */