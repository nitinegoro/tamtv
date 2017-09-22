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

	public function socialmedia()
	{
		$this->page_title->push('Pengaturan', 'Social Media');

		$this->breadcrumbs->unshift(2, 'Social Media', $this->uri->uri_string());

		$this->data = array(
			'title' => "Pengaturan Social Media"
		);

		$this->template->admin('socialmedia', $this->data);	
	}

	public function set_socialmedia()
	{
		$this->options->update_social_media();

		redirect(base_url("administrator/setting/socialmedia"));
	}
}

/* End of file Setting.php */
/* Location: ./application/controllers/administrator/Setting.php */