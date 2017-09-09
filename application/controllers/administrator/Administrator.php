<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends Admin_panel 
{
	public function __construct()
	{
		parent::__construct();

		$this->page_title->push('Dashboard', 'Halaman Utama administrator');

		$this->load->js(base_url("public/admin/app/main.js"));

		$this->load->model('cpost');
	}

	public function index()
	{

		$this->data = array(
			'title' => "Dashboard"
		);

		$this->template->admin('dashboard', $this->data);
	}

	public function updatelive()
	{
		if( $this->options->update('live-streaming', $this->input->post('live')) != FALSE)
		{
			$this->data = array('stutus' => 'success');
		} else {
			$this->data = array('stutus' => 'failed');
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

}

/* End of file Administrator.php */
/* Location: ./application/controllers/administrator/Administrator.php */