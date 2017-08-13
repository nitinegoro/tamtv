<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Web 
{
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->meta_tags->set_meta_tag('canonical', current_url() );
		$this->meta_tags->set_meta_tag('type', 'article' );
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
		$this->meta_tags->set_meta_tag('news_keywords', '' );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->data = array(
			'title' => $this->options->get('sitename')	
		);

		$this->template->view('index', $this->data);
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

		$this->breadcrumbs->unshift(2, $post->post_title, "/");

		$this->data = array(
			'title' => $post->post_title,
			'post' => $post,
			'news_keyword' => $tags,
			'metacategory' =>  $category ? $category->name : ''
		);

		$this->template->view('single', $this->data);
	}

	/**
	 * Index of live streaming
	 *
	 **/
	public function live()
	{
		$this->meta_tags->set_meta_tag('title', $this->options->get('sitename') );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->data = array(
			'title' => "Live Streaming TV Lokal "	
		);

		$this->template->view('live-streaming', $this->data);
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

		$this->data = array(
			'title' => $category->name,
			'category' => $category
		);

		$this->template->view('category', $this->data);
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

		$this->breadcrumbs->unshift(2, $tag->name, current_url());

		$this->data = array(
			'title' => "Topik : ".$tag->name,
			'tag' => $tag	
		);

		$this->template->view('tags', $this->data);
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