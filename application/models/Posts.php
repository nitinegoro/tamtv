<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Model 
{
	public $permalink_type;

	public function __construct()
	{
		parent::__construct();
		
		$this->permalink_type = $this->get_option('permalink');
	}

	public function get()
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_modified, post_excerpt, comment_status, poll_status');

		switch ($this->permalink_type) 
		{
			case 'slug':
				$this->db->where('post_slug', $this->uri->segment(1));
				break;
			
			default:
				# code...
				break;
		}

		return $this->db->get('posts')->row();
	}

	public function get_type($type = 'default', $limit = 6, $offset = 0)
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image');

		$this->db->where('post_type', $type);
		
		return $this->db->get('posts', $limit, $offset)->result();
	}

	public function most_viewer($limit = 6, $offset = 0)
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image');

		$this->db->order_by('viewer', 'desc');
		
		return $this->db->get('posts', $limit, $offset)->result();
	}

	public function latest($limit = 6, $offset = 0)
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image');

		$this->db->order_by('post_date', 'desc');
		
		return $this->db->get('posts', $limit, $offset)->result();
	}

	public function tags($tags = 0, $limit = 6, $offset = 0)
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_id');

		$this->db->join('posts', 'posttags.post_id = posts.ID', 'inner');

		$this->db->where('tag_id', $tags);

		$this->db->order_by('post_date', 'desc');

		$this->db->group_by('post_id');
		
		return $this->db->get('posttags', $limit, $offset)->result();
	}

	public function category($category = 0, $limit = 6, $offset = 0)
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_id');

		$this->db->join('posts', 'postcategory.post_id = posts.ID', 'inner');

		$this->db->where('category_id', $category);

		$this->db->order_by('post_date', 'desc');

		$this->db->group_by('post_id');
		
		return $this->db->get('postcategory', $limit, $offset)->result();
	}
	
	public function get_thumbnail($image = FALSE, $size = FALSE)
	{
		if($image == FALSE)
			return base_url("public/image/news/no-image.jpg");

		switch ($size) 
		{
			case 'small':
				return base_url("public/image/news/small/{$image}");
				break;
			case 'x-small':
				return base_url("public/image/news/x-small/{$image}");
				break;
			default:
				return base_url("public/image/news/{$image}");
				break;
		}

		return base_url("public/image/news/{$image}");
	}

	public function get_post_category($post = 0)
	{
		$this->db->select('name, slug');

		$this->db->join('postcategory', 'categories.category_id = postcategory.category_id', 'left');

		$this->db->where('post_id', $post);

		$this->db->group_by('post_id');

		return $this->db->get('categories')->row();
	}

	public function get_post_tags($post = 0)
	{
		$this->db->select('name, slug, tags.tag_id');

		$this->db->join('tags', 'tags.tag_id = posttags.tag_id', 'inner');

		$this->db->join('posts', 'posttags.post_id = posts.ID', 'inner');

		$this->db->where('post_id', $post);

		$this->db->order_by('post_date', 'desc');

		$this->db->group_by('name');
		
		return $this->db->get('posttags')->result();
	}

	public function get_post_author($post = 0)
	{
		$this->db->select('fullname, avatar, username');

		$this->db->join('posts', 'users.ID = posts.post_author', 'inner');

		$this->db->where('posts.ID', $post);

		return $this->db->get('users')->row();
	}

	public function similar($tags = 0, $not_post = 0, $limit = 6, $offset = 0)
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_id');

		$this->db->join('posts', 'posttags.post_id = posts.ID', 'inner');

		$this->db->where_in('tag_id', $tags);

		$this->db->where_not_in('post_id', $not_post);

		$this->db->order_by('post_date', 'desc');

		$this->db->group_by('post_id');
		
		return $this->db->get('posttags', $limit, $offset)->result();
	}

	public function permalink($post = 0)
	{
		$this->db->select('post_slug, ID, post_date');

		$post = $this->db->get_where('posts', array('ID' => $post))->row(); 
		
		$date = new DateTime($post->post_date);

		switch ( $this->permalink_type ) 
		{
			case 'slug':
				return base_url($post->post_slug);
				break;
			case 'date':
				return base_url($date->format('Y') . '/' . $date->format('m') . '/' . $date->format('d') . '/' . $post->post_slug);
				break;
			case 'month_year':
				return base_url($date->format('Y') . '/' . $date->format('m') . '/' . $post->post_slug);
				break;
			default:
				return base_url('read/'.$post->ID . '/' . $post->post_slug);
				break;
		}
	}

	public function date_format($date = FALSE)
	{
		if($date == FALSE)
			$date = date('Y-m-d H:i:s');

		$dateClass = new DateTime($date);

		$get_date_format = $this->get_option('date_format');

		$get_time_format = $this->get_option('time_format');
		
		return $dateClass->format($get_date_format.' '.$get_time_format);
	}

	public function get_option($param = 'date_format')
	{
		return $this->db->query("SELECT option_value FROM options WHERE option_name = '{$param}'")->row('option_value');
	}
}

/* End of file Posts.php */
/* Location: ./application/models/Posts.php */