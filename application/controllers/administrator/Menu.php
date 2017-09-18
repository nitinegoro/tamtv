<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('page');
		
		$this->page_title->push('Tampilan', 'Pengaturan Menu Navigasi');

		$this->breadcrumbs->unshift(2, 'Tampilan', $this->uri->uri_string());

		$this->load->js(base_url("public/admin/js/jquery.nestable.js"));
		$this->load->js(base_url("public/admin/app/menus.js"));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(3, 'Menu Navigasi', $this->uri->uri_string());

		if( $this->input->post('action'))
		{
			switch ($this->input->post('action')) 
			{
				case 'custom':
					$this->menus->create_custom();
					break;
				case 'category':
					$this->menus->create_category();
					break;
				case 'page':
					$this->menus->create_page();
					break;
			}
			
			redirect('administrator/menu?menu='.array_search($this->input->post('key'), $this->menus->menu_type) );
		}

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

			$this->data = array('stutus' => 'success');
		} else {
			$this->data = array('stutus' => 'failed');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	public function delete($param = 0)
	{
		if( $this->menus->delete($param) != FALSE)
		{
			$this->data = array('stutus' => 'success');
		} else {
			$this->data = array('stutus' => 'failed');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}
}

/* End of file Menu.php */
/* Location: ./application/controllers/administrator/Menu.php */