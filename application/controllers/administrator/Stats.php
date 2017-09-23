<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats extends Admin_panel 
{
	public $start_date;

	public $end_date;

	public $polling_stats;

	public function __construct()
	{
		parent::__construct();
		
		$this->breadcrumbs->unshift(1, 'Statistik', $this->uri->uri_string());

		$this->load->js(base_url("public/admin/app/main.js"));

		$this->load->model(array('cpost','visitors'));

		$this->start_date = ($this->input->get('start_date') != '') ? 
				$this->input->get('start_date') :  date('Y-m-d', strtotime('-10 days', strtotime( date('Y-m-d') )));

		$this->end_date = ($this->input->get('end_date') != '') ? $this->input->get('end_date') : date('Y-m-d');

		$this->polling_stats = ($this->input->get('get') != NULL) ? $this->input->get('get') : 1;
	}

	public function index()
	{
		$this->page_title->push('Statistik', 'Pengunjung');

		$this->breadcrumbs->unshift(2, 'Pengunjung', $this->uri->uri_string());

		$this->data = array(
			'title' => "Statistik Pengunjung",
		);

		$this->template->admin('stats-pengunjung', $this->data);
	}

	public function polling($param = 0)
	{
		$this->page_title->push('Statistik', 'Poliing berita');

		$this->breadcrumbs->unshift(2, 'Polling Berita', $this->uri->uri_string());

		$this->data = array(
			'title' => "Statistik Polling Berita",
		);

		$this->template->admin('polling-stats', $this->data);
	}

}

/* End of file Stats.php */
/* Location: ./application/controllers/administrator/Stats.php */