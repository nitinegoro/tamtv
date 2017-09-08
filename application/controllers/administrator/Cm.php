<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cm extends Admin_panel 
{
	public $data = array();

	public $per_page;

	public $page;

	public $query;

	public $order_by;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('comment');

		$this->per_page = (!$this->input->get('per_page')) ? 15 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');

		$this->order_by = (!$this->input->get('order_by')) ? 'all' : $this->input->get('order_by');

		$this->page_title->push('Komentar', 'Manajemen Komentar');

		$this->breadcrumbs->unshift(1, 'Komentar', "administrator/cm");
	}

	public function index()
	{
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("
			administrator/cm?per_page={$this->per_page}&query={$this->query}&order_by={$this->order_by}
		");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->comment->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Komentar",
			'comments' => $this->comment->getall($this->per_page, $this->page)
		);

		$this->template->admin('comments', $this->data);	
	}

	public function reply()
	{
		$setReply = $this->comment->reply();

		if( $setReply == TRUE )
		{
			$this->data = array(
				'status' => 'success',
				'result' => $setReply
			);
		} else {
			$this->data = array(
				'status' => 'failed'
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}
}

/* End of file Cm.php */
/* Location: ./application/controllers/administrator/Cm.php */