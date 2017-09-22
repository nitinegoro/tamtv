<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Pengaturan', $this->uri->uri_string());

		$this->load->js(base_url("public/admin/app/main.js"));
	}

	public function index()
	{
		$this->page_title->push('Pengaturan', 'Umum');

		$this->breadcrumbs->unshift(2, 'Umum', $this->uri->uri_string());

		$this->data = array(
			'title' => "Pengaturan Umum"
		);

		$this->template->admin('general-setting', $this->data);	
	}

	public function set_general()
	{
		foreach ($this->input->post('options') as $key => $value) 
		{
			$this->options->update($key, $value);
		}
		redirect(base_url("administrator/setting"));
	}
}

/* End of file Setting.php */
/* Location: ./application/controllers/administrator/Setting.php */