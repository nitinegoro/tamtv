<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_category extends Admin_panel 
{
	public $data = array();

	public $per_page;

	public $page;

	public $query;

	public function __construct()
	{
		parent::__construct();
	
		$this->breadcrumbs->unshift(1, 'Berita', "administrator/posts");

		$this->breadcrumbs->unshift(2, 'Kategori', "administrator/post_category");

		$this->per_page = (!$this->input->get('per_page')) ? 15 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->page_title->push('Kategori', 'Kategori dalam berita');

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|is_unique[categories.name]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|is_unique[categories.slug]');
		$this->form_validation->set_rules('parent', 'Kategori Induk', 'trim');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

		if( $this->form_validation->run() == TRUE )
		{
			$this->category->create();

			redirect(current_url());
		} 

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("administrator/post_category?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->category->getallpg(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Kategori",
			'category' => $this->category->getallpg($this->per_page, $this->page)
		);

		$this->template->admin('category', $this->data);
	}

	public function delete($param = 0)
	{
		$this->category->delete( $param );

		redirect(base_url("administrator/post_category"));
	}

	public function update($param = 0)
	{
		$category = $this->category->get($param);

		if( $category == FALSE )
			show_404();

		$this->page_title->push('Kategori', 'Kategori berita');

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required');
		$this->form_validation->set_rules('parent', 'Kategori Induk', 'trim');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

		if( $this->form_validation->run() == TRUE )
		{
			$this->category->update( $param );

			redirect(current_url());
		} 

		$this->data = array(
			'title' => $category->name,
			'category' => $category
		);

		$this->template->admin('update-category', $this->data);
	}

	public function bulkaction()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->category->delete_multiple();
				break;
			
			default:
				# code...
				break;
		}

		redirect(base_url("administrator/post_category"));
	}

}

/* End of file Post_category.php */
/* Location: ./application/controllers/administrator/Post_category.php */