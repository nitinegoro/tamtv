<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Model 
{
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

	public function date_format($date = FALSE)
	{
		if($date == FALSE)
			$date = date('Y-m-d H:i:s');

		$dateClass = new DateTime($date);

		$get_date_format = $this->get_date_format('date_format');

		$get_time_format = $this->get_date_format('time_format');
		
		return $dateClass->format($get_date_format.' '.$get_time_format);
	}

	public function get_date_format($param = 'date_format')
	{
		return $this->db->query("SELECT option_value FROM options WHERE option_name = '{$param}'")->row('option_value');
	}
}

/* End of file Posts.php */
/* Location: ./application/models/Posts.php */