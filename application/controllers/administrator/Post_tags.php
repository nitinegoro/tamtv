<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_tags extends Admin_panel 
{
	public $data = array();

	public $per_page;

	public $page;

	public $query;

	public function __construct()
	{
		parent::__construct();
	
		$this->breadcrumbs->unshift(1, 'Berita', "administrator/posts");

		$this->breadcrumbs->unshift(2, 'Topik', "administrator/post_tags");

		$this->per_page = (!$this->input->get('per_page')) ? 15 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->page_title->push('Topik', 'Topik dalam berita');

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|is_unique[tags.name]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|is_unique[tags.slug]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

		if( $this->form_validation->run() == TRUE )
		{
			$this->tags->create();

			redirect(current_url());
		} 

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("administrator/post_tags?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->tags->getAll(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Topik",
			'tags' => $this->tags->getAll($this->per_page, $this->page)
		);

		$this->template->admin('tags', $this->data);
	}

	public function update($param = 0)
	{
		$tag = $this->tags->get($param);

		if( $tag == FALSE )
			show_404();

		$this->page_title->push('Topik', 'Topik dalam berita');

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

		if( $this->form_validation->run() == TRUE )
		{
			$this->tags->update( $param );

			redirect(current_url());
		} 

		$this->data = array(
			'title' => $tag->name,
			'tag' => $tag
		);

		$this->template->admin('update-tag', $this->data);
	}

	public function delete($param = 0)
	{
		$this->tags->delete($param);

		redirect('administrator/post_tags');
	}

	public function bulkaction()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->tags->delete_multiple();
				break;
			
			default:
				# code...
				break;
		}

		redirect(base_url("administrator/post_tags"));
	}
}

/* End of file Tags.php */
/* Location: ./application/controllers/administrator/Tags.php */