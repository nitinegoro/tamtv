<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Web 
{
	public $data;

	public $per_page;

	public $page;

	public $query;

	public $order;

	public $from_date;

	public $to_date;

	public function __construct()
	{
		parent::__construct();

		$this->meta_tags->set_meta_tag('canonical', current_url() );
		$this->meta_tags->set_meta_tag('type', 'article' );

		$this->page = $this->input->get('page');

		$this->per_page = 20;

		$this->query = $this->input->get('q');

		$this->order = $this->input->get('order');

		$this->from_date = $this->input->get('from_date');

		$this->to_date = $this->input->get('to_date');

		$this->visitors->visitor_create();
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -s
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->meta_tags->set_meta_tag('title', $this->options->get('sitename') );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->data = array(
			'title' => $this->options->get('sitename')	
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('index', $this->data);
		} else {
			$this->load->view('mobile/main', $this->data);
		}
	}

	/**
	 * Detail POST
	 *
	 * @param string uri_segment (1, 2, 3)
	 **/
	public function getpost()
	{
		$post = $this->posts->get();

		if($post == FALSE)
			show_404();

		$this->posts->update_viewer($post->ID, ++$post->viewer);

		$inputTags = array_map(function ($object) { 
				return $object->name; 
			}, 
			$this->posts->get_post_tags($post->ID)
		);

		$tags = implode(', ', $inputTags);

		$category = $this->posts->get_post_category($post->ID);

		$this->meta_tags->set_meta_tag('title', $post->post_title );
		$this->meta_tags->set_meta_tag('news_keywords', $tags );
		$this->meta_tags->set_meta_tag('image', base_url($this->posts->get_thumbnail($post->image)) );
		$this->meta_tags->set_meta_tag('description', strip_tags(word_limiter($post->post_content, 13)) );

		if( $category )
			$this->breadcrumbs->unshift(1, $category->name, "kategori/{$category->slug}");

		$this->data = array(
			'title' => $post->post_title,
			'post' => $post,
			'news_keyword' => $tags,
			'metacategory' =>  $category ? $category->name : '',
			'nextpost' => $this->posts->next($post->ID),
			'prevpost' => $this->posts->prev($post->ID)
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->breadcrumbs->unshift(2, $post->post_title, "/");
			$this->template->view('single', $this->data);
		} else {
			$this->load->view('mobile/single', $this->data);
		}
	}

	/**
	 * Index of live streaming
	 *
	 **/
	public function live()
	{
		header('Access-Control-Allow-Origin: *');
		
		$this->meta_tags->set_meta_tag('title', $this->options->get('sitename') );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("live");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->get_type('video', null, null, 'num');
		// $config['total_rows'] = ($this->posts->get_type('vidio', null, null, 'num') - 8);

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Live Streaming TV Lokal ",
			'vidio_posts' => $this->posts->get_type('video', $this->per_page, $this->page, 'results')
		);

		//$this->posts->get_type('vidio', $this->per_page, ($this->page+8), 'results')
		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('live-streaming', $this->data);
		} else {
			redirect(base_url());
		}
	}

	/**
	 * Get Post by category
	 *
	 **/
	public function getcategory()
	{
		$category = $this->category->get();

		if($category == FALSE)
			show_404();

		$this->meta_tags->set_meta_tag('title', $category->name );
		$this->meta_tags->set_meta_tag('description', $category->description );

		$parent = $this->category->get($category->parent);

		if( $parent )
			$this->breadcrumbs->unshift(1, $parent->name, "/kategori/" . $parent->slug);

		$this->breadcrumbs->unshift(2, $category->name, current_url());


		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("kategori/{$category->slug}");

		$config['per_page'] = $this->per_page;

		if( $this->agent->is_mobile() == FALSE) 
		{
			$config['total_rows'] = ($this->posts->category($category->category_id, null, null, 'num') - 6);
			$categories = $this->posts->category($category->category_id, $this->per_page, ($this->page+6), 'results');
		} else {
			$config['total_rows'] = ($this->posts->category($category->category_id, null, null, 'num') - 1);
			$categories = $this->posts->category($category->category_id, $this->per_page, ($this->page+1), 'results');
		}

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => $category->name. " :: ". $this->options->get('sitename'),
			'category' => $category,
			'categories' => $categories
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('category', $this->data);
		} else {
			$this->load->view("mobile/category", $this->data);
		}
	}

	/**
	 * Get Post by Tag
	 *
	 **/
	public function gettag()
	{
		$tag = $this->tags->get();

		if($tag == FALSE)
			show_404();

		$this->meta_tags->set_meta_tag('title', $tag->name );
		$this->meta_tags->set_meta_tag('description', $tag->description );

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("tag/{$tag->slug}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->tags($tag->tag_id, null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Topik : ".$tag->name. " :: ". $this->options->get('sitename'),
			'tag' => $tag,
			'posttags'=>  $this->posts->tags($tag->tag_id, $this->per_page, $this->page, 'results')
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('tags', $this->data);
		} else {
			$this->load->view("mobile/tags", $this->data);
		}
	}

	/**
	 * Searchong page
	 *
	 **/
	public function search()
	{
		$this->meta_tags->set_meta_tag('title', $this->options->get('sitename') );
		$this->meta_tags->set_meta_tag('news_keywords', $this->query );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("search?q={$this->query}&order={$this->order}&category={$this->input->get('category')}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->search(null, null, 'num');

		$this->pagination->initialize($config);

		if(!$this->page)
			$this->page = 0;

		$this->data = array(
			'title' => $this->options->get('sitename'),
			'contents'=>  $this->posts->search($this->per_page, $this->page, 'results'),
			'results_count' => $config['total_rows']
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('search', $this->data);
		} else {
			$this->load->view("mobile/search", $this->data);
		}
	}

	public function terbaru()
	{
		$this->meta_tags->set_meta_tag('title', 'Berita Terbaru' );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->breadcrumbs->unshift(2, 'Berita Terbaru', current_url());

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("terbaru");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->latest(null, null, 'num');

		$this->pagination->initialize($config);

		if(!$this->page)
			$this->page = 0;

		$this->data = array(
			'title' => 'Berita Terbaru',
			'contents'=>  $this->posts->latest($this->per_page, $this->page, 'results'),
			'results_count' => $config['total_rows']
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('latest', $this->data);
		} else {
			//$this->load->view("mobile/latest", $this->data);
		}
	}

	/**
	 * Berita Regional
	 *
	 **/
	public function regional()
	{
		$this->meta_tags->set_meta_tag('title', 'Berita Lokal' );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->breadcrumbs->unshift(2, 'Berita Lokal', current_url());

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("terbaru");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->news_category_array(array(1,2,3,4,5,6,7,8), null, null, 'num');

		$this->pagination->initialize($config);

		if(!$this->page)
			$this->page = 0;

		$this->data = array(
			'title' => 'Berita Lokal',
			'contents'=>  $this->posts->news_category_array(array(1,2,3,4,5,6,7,8), $this->per_page, $this->page, 'results'),
			'results_count' => $config['total_rows']
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('regional', $this->data);
		} else {
			//$this->load->view("mobile/regional", $this->data);
		}
	}

	public function rekomendasi()
	{
		$this->meta_tags->set_meta_tag('title', 'Rekomendasi' );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->breadcrumbs->unshift(2, 'Rekomendasi', current_url());

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("rekomendasi");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->get_type('recomended',null, null, 'num');

		$this->pagination->initialize($config);

		if(!$this->page)
			$this->page = 0;

		$this->data = array(
			'title' => 'Rekomendasi',
			'contents'=>  $this->posts->get_type('recomended',$this->per_page, $this->page, 'results'),
			'results_count' => $config['total_rows']
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('recomended', $this->data);
		} else {
			//$this->load->view("mobile/recomended", $this->data);
		}
	}

	public function photo()
	{
		$this->meta_tags->set_meta_tag('title', 'Berita Foto' );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->breadcrumbs->unshift(2, 'Berita Foto', current_url());

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("Berita Foto");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->get_type('photo',null, null, 'num');

		$this->pagination->initialize($config);

		if(!$this->page)
			$this->page = 0;

		$this->data = array(
			'title' => 'Berita Foto',
			'contents'=>  $this->posts->get_type('photo',$this->per_page, $this->page, 'results'),
			'results_count' => $config['total_rows']
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('photo', $this->data);
		} else {
			//$this->load->view("mobile/photo", $this->data);
		}
	}

	public function video()
	{
		$this->meta_tags->set_meta_tag('title', 'Berita Video' );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->breadcrumbs->unshift(2, 'Berita Video', current_url());

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("Berita Video");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->posts->get_type('video',null, null, 'num');

		$this->pagination->initialize($config);

		if(!$this->page)
			$this->page = 0;

		$this->data = array(
			'title' => 'Berita Video',
			'contents'=>  $this->posts->get_type('video',$this->per_page, $this->page, 'results'),
			'results_count' => $config['total_rows']
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('video', $this->data);
		} else {
			//$this->load->view("mobile/video", $this->data);
		}
	}

	public function page()
	{
		$post = $this->posts->get_page();

		if($post == FALSE)
			show_404();

		$this->meta_tags->set_meta_tag('title', $post->post_title );
		$this->meta_tags->set_meta_tag('description', strip_tags(word_limiter($post->post_content, 13)) );

		$this->breadcrumbs->unshift(1, $post->post_title, "/");

		$this->data = array(
			'title' => $post->post_title,
			'post' => $post
		);

		if( $this->agent->is_mobile() == FALSE) 
		{
			$this->template->view('page', $this->data);
		} else {
			$this->load->view('mobile/single-page', $this->data);
		}
	}

	public function update($value='')
	{
		foreach ($this->db->get('posts')->result() as $row) 
		{
			//$this->db->update('menus', array('url' => str_replace('category', 'kategori', $row->url)), array('ID' => $row->ID));
			$this->db->update('posts', array('image' => $row->post_slug.'.jpg'), array('ID' => $row->ID));
			//$this->db->update('posts', array('post_slug' => $this->slug->create_slug($row->post_title)), array('ID' => $row->ID));
		}
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */