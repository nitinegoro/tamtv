<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends Admin_panel 
{
	public $data = array();

	public $per_page;

	public $page;

	public $query;

	public $cat;

	public $author;

	public $topik;

	public function __construct()
	{
		parent::__construct();
	
		$this->breadcrumbs->unshift(1, 'Berita', "administrator/posts");

		$this->per_page = (!$this->input->get('per_page')) ? 15 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');

		$this->cat = $this->input->get('category');

		$this->author = $this->input->get('author');

		$this->topik = $this->input->get('tag');

		$this->load->model(array('cpost'));

		$this->load->library('image_lib');
	}

	public function index()
	{
		$this->page_title->push('Berita', 'Semua berita');

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("
			administrator/post?per_page={$this->per_page}&query={$this->query}&category={$this->cat}&author={$this->author}&tag={$this->topik}
		");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Kategori",
			'posts' => $this->posts->getall($this->per_page, $this->page)
		);

		$this->template->admin('posts', $this->data);
	}

	public function create()
	{
		$this->page_title->push('Berita', 'Tulis Berita Baru');

		$this->breadcrumbs->unshift(2, 'Tulis Berita', "administrator/posts/create");

		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|is_unique[posts.post_title]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|is_unique[posts.post_slug]');
		$this->form_validation->set_rules('content', 'Konten', 'trim');
		$this->form_validation->set_rules('excerpt', 'Kutipan', 'trim');
		$this->form_validation->set_rules('status', 'Status', 'trim');
		$this->form_validation->set_rules('type', 'Tipe', 'trim');
		$this->form_validation->set_rules('video', 'Video', 'trim');
		$this->form_validation->set_rules('comment', 'Pengaktifan Komentar', 'trim');
		$this->form_validation->set_rules('polling', 'Pengaktifan Polling', 'trim');
		$this->form_validation->set_rules('pollingquestion', 'Pertanyaan Polling', 'trim');
		$this->form_validation->set_rules('figure_caption', 'Caption', 'trim');
		$this->form_validation->set_rules('watermark', 'Watermark', 'trim');

		if( $this->form_validation->run() == TRUE )
		{
			$post = $this->cpost->create();

			redirect(base_url("administrator/post/update/{$post}"));
		} 

		$this->data = array(
			'title' => "Tulis Berita"
		);

		$this->template->admin('create-posts', $this->data);
	}

	public function update($param = 0)
	{
		$post = $this->cpost->get( $param );

		if( $post == FALSE )
			show_404();

		$this->page_title->push('Berita', 'Edit Berita');

		$this->breadcrumbs->unshift(2, 'Edit Berita', "administrator/post/update/{$param}");

		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim');
		$this->form_validation->set_rules('content', 'Konten', 'trim');
		$this->form_validation->set_rules('excerpt', 'Kutipan', 'trim');
		$this->form_validation->set_rules('status', 'Status', 'trim');
		$this->form_validation->set_rules('video', 'Video', 'trim');
		$this->form_validation->set_rules('type', 'Tipe', 'trim');
		$this->form_validation->set_rules('comment', 'Pengaktifan Komentar', 'trim');
		$this->form_validation->set_rules('polling', 'Pengaktifan Polling', 'trim');
		$this->form_validation->set_rules('pollingquestion', 'Pertanyaan Polling', 'trim');
		$this->form_validation->set_rules('figure_caption', 'Caption', 'trim');
		$this->form_validation->set_rules('watermark', 'Watermark', 'trim');

		if( $this->form_validation->run() == TRUE )
		{
			$this->cpost->update( $param );

			redirect(current_url());
		} 

		$this->data = array(
			'title' => "Edit Berita",
			'post' => $post
		);

		$this->template->admin('update-post', $this->data);
	}

	public function delete($param = 0)
	{
		$this->cpost->delete( $param );

		redirect('administrator/post');
	}

	public function bulkaction()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->cpost->delete_multiple();
				break;
			
			default:
				# code...
				break;
		}

		redirect(base_url("administrator/post"));
	}

	public function add_new_category()
	{
		if( $this->input->post() )
		{
			$category = $this->cpost->add_new_category();

			$this->data = array(
				'status' => 'success',
				'result_id' => $category,
				'result' => $this->input->post()
			);
		} else {
			$this->data = array(
				'status' => 'failed'
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	public function add_new_tag()
	{
		if( $this->input->post() )
		{
			$tag = $this->cpost->add_new_tag();

			$this->data = array(
				'status' => 'success',
				'result_id' => $tag,
				'result' => $this->input->post()
			);
		} else {
			$this->data = array(
				'status' => 'failed'
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}

	public function delete_galery($param = 0)
	{
		if( $this->cpost->delete_image_in_galery( $param ) == TRUE )
		{
			$this->data = array(
				'status' => 'success'
			);
		} else {
			$this->data = array(
				'status' => 'failed'
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data));
	}
}

/* End of file Post.php */
/* Location: ./application/controllers/administrator/Post.php */