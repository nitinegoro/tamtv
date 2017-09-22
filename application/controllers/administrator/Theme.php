<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme extends Admin_panel
{
	public $layout;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Tampilan', $this->uri->uri_string());

		$this->layout = ( $this->input->get('layout') != '') ? $this->input->get('layout') : 'sidebar-index';
	}

	public function index()
	{
		$this->page_title->push('Tampilan', 'Element');

		$this->breadcrumbs->unshift(2, 'Element', $this->uri->uri_string());

		$this->data = array(
			'title' => "Element",
		);

		$this->template->admin('element', $this->data);
	}

	public function update()
	{
		$this->themes->update_layout();

		 redirect(base_url("administrator/theme?layout="));

		echo "<pre>";
		print_r ($this->input->post('trending-tags'));
		echo "</pre>";
	}

}

/* End of file Theme.php */
/* Location: ./application/controllers/administrator/Theme.php */