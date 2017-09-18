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

		$this->breadcrumbs->unshift(1, 'Polling', "index");

		$this->load->js(base_url("public/admin/app/main.js"));

		$this->per_page = (!$this->input->get('per_page')) ? 15 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}
	
	public function index()
	{
		$this->page_title->push('Polling', 'Manajemen poliing berita');

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

	public function create()
	{
		$this->page_title->push('Tambah', 'Manajemen polling berita');

		$this->breadcrumbs->unshift(2, 'Tambah Polling', "index");

		$this->form_validation->set_rules('question', 'Pertanyaan Polling', 'trim|required');

		if( $this->form_validation->run() == TRUE )
		{
			$this->polling->create_polling();

			redirect(current_url());
		}

		$this->data = array(
			'title' => "Tambah Polling"
		);

		$this->template->admin('createquestion', $this->data);
	}

	public function update($param = 0)
	{
		$question = $this->polling->get_question($param);

		if( $question == FALSE)
			show_404();

		$this->page_title->push('Update', 'Manajemen polling berita');

		$this->breadcrumbs->unshift(2, 'Update Polling', "index");

		$this->form_validation->set_rules('question', 'Pertanyaan Polling', 'trim|required');

		if( $this->form_validation->run() == TRUE )
		{
			$this->polling->update_polling( $param );
			
			redirect(current_url());
		}

		$this->data = array(
			'title' => "Update Polling",
			'question' => $question
		);

		$this->template->admin('updatequestion', $this->data);
	}

	public function delete($param = 0)
	{
		$this->polling->delete( $param );

		redirect(base_url("administrator/question"));
	}

	public function deleteanswer($param = 0)
	{
		$this->response = $this->polling->delete_answer($param);

		$this->output->set_content_type('application/json')->set_output(json_encode($this->response));
	}
}

/* End of file Question.php */
/* Location: ./application/controllers/administrator/Question.php */