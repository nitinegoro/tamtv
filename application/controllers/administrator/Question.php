<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends Admin_panel 
{
	public $data = array();

	public $per_page;

	public $page;

	public $query;

	public function __construct()
	{
		parent::__construct();

		$this->page_title->push('Polling', 'Manajemen poliing berita');

		$this->load->js(base_url("public/admin/app/main.js"));

		$this->per_page = (!$this->input->get('per_page')) ? 15 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}
	
	public function index()
	{
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("
			administrator/question?per_page={$this->per_page}&query={$this->query}
		");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->polling->get_question_pg(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Manajemen Polling",
			'questions' => $this->polling->get_question_pg($this->per_page, $this->page)
		);

		$this->template->admin('pquestion', $this->data);
	}

}

/* End of file Question.php */
/* Location: ./application/controllers/administrator/Question.php */