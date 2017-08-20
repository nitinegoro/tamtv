<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_panel 
{
	public $data = array();

	public $per_page;

	public $pg;

	public $query;

	public function __construct()
	{
		parent::__construct();
	
		$this->breadcrumbs->unshift(1, 'Halaman', "administrator/pages");

		$this->per_page = (!$this->input->get('per_page')) ? 15 : $this->input->get('per_page');

		$this->pg = $this->input->get('page');

		$this->query = $this->input->get('query');

		$this->load->model(array('page'));
	}

	public function index()
	{
		$this->page_title->push('Halaman', 'Semua Halaman');

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("
			administrator/pages?per_page={$this->per_page}&query={$this->query}&author={$this->input->get('author')}
		");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->page->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Halaman",
			'posts' => $this->page->get_all($this->per_page, $this->pg)
		);

		$this->template->admin('pages', $this->data);
	}

	public function create()
	{
		$this->page_title->push('Halaman', 'Buat Halaman Baru');

		$this->breadcrumbs->unshift(2, 'Buat Halaman', "administrator/pages/create");

		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|is_unique[posts.post_title]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|is_unique[posts.post_slug]');
		$this->form_validation->set_rules('content', 'Konten', 'trim');

		if( $this->form_validation->run() == TRUE )
		{
			$page = $this->page->create();

			redirect(base_url("administrator/pages/update/{$page}"));
		} 

		$this->data = array(
			'title' => "Buat Halaman Baru"
		);

		$this->template->admin('create-page', $this->data);
	}

	public function update($param = 0)
	{
		$page = $this->page->get( $param );

		if( $page == FALSE )
			show_404();

		$this->page_title->push('Halaman', 'Edit Halaman');

		$this->breadcrumbs->unshift(2, 'Edit Halaman', "administrator/pages/create");

		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim');
		$this->form_validation->set_rules('content', 'Konten', 'trim');

		if( $this->form_validation->run() == TRUE )
		{
			$this->page->update( $param );

			redirect(current_url());
		} 

		$this->data = array(
			'title' => "Edit Halaman",
			'page' => $page
		);

		$this->template->admin('update-page', $this->data);
	}

	public function delete($param = 0)
	{
		$this->page->delete($param);

		redirect("administrator/pages");
	}

	public function bulkaction()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->page->delete_multiple();
				break;
			
			default:
				# code...
				break;
		}

		redirect(base_url("administrator/pages"));
	}
}

/* End of file Pages.php */
/* Location: ./application/controllers/administrator/Pages.php */