<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Model 
{
	public $permalink_type;

	public function __construct()
	{
		parent::__construct();

		$this->permalink_type = $this->get_option('permalink');

		$this->permalink_page = $this->uri->segment(2);
	}

	public function getall($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->select('post_title, fullname, post_date, posts.ID, users.ID AS user_id ');

		$this->db->join('users', 'posts.post_author = users.ID', 'left');

		$this->db->join('postcategory', 'posts.ID = postcategory.post_id', 'left');

		$this->db->join('posttags', 'posts.ID = posttags.post_id', 'left');

		if( $this->input->get('query') != '')
			$this->db->like('post_title', $this->input->get('query'))
				->or_like('post_excerpt', $this->input->get('query'));
				
		if( $this->input->get('category') != '')
			$this->db->where_in('category_id', $this->input->get('category'));

		if( $this->input->get('tag') != '')
			$this->db->where_in('tag_id', $this->input->get('tag'));

		if( $this->input->get('author') != '')
			$this->db->where('post_author', $this->input->get('author'));

		$this->db->where('post_type !=', 'page');

		$this->db->order_by('ID', 'desc');

		$this->db->group_by('ID');

		if( $type == 'num' )
		{
			return $this->db->get('posts')->num_rows();
		} else {
			return $this->db->get('posts', $limit, $offset)->result();
		}
	}

	public function get()
	{
		$this->db->select('
			ID, post_title, post_slug, post_date, post_content, post_type, image, post_modified, 
			post_excerpt, comment_status,poll_status, poll_status, viewer
		');

		switch ($this->permalink_type) 
		{
			case 'slug':
				$this->db->where('post_slug', $this->uri->segment(1));
				break;
			case 'date':
				$this->db->where('post_slug', $this->uri->segment(4));
				break;
			case 'month':
				$this->db->where('post_slug', $this->uri->segment(3));
				break;
			default:
				# code...
				break;
		}

		return $this->db->get('posts')->row();
	}

	public function update_viewer($param = 0, $counter = 0)
	{
		$this->db->update('posts', array('viewer' => $counter), array('ID' => $param));

		return $this->db->affected_rows();
	}

	public function get_type($param = NULL, $limit = 6, $offset = 0, $type = 'result')
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_excerpt');

		$this->db->where_not_in('post_type', 'page');

		if($param != NULL)
			$this->db->where('post_type', $param);

		$this->db->order_by('post_date', 'desc');
		
		if($type == 'num')
		{
			return $this->db->get('posts')->num_rows();
		} else {
			return $this->db->get('posts', $limit, $offset)->result();
		}
	}

	public function most_viewer($limit = 6, $offset = 0)
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_excerpt');

		$this->db->where_not_in('post_type', 'page');

		$this->db->order_by('viewer', 'desc');
		
		return $this->db->get('posts', $limit, $offset)->result();
	}

	public function latest($limit = 6, $offset = 0, $type = 'num')
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_excerpt');

		$this->db->where_not_in('post_type', array('page'));

		$this->db->order_by('post_date', 'desc');
		
		if($type == 'num')
		{
			return $this->db->get('posts')->num_rows();
		} else {
			return $this->db->get('posts', $limit, $offset)->result();
		}
	}

	public function tags($tags = 0, $limit = 6, $offset = 0, $type = 'num')
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_id, post_excerpt');

		$this->db->where_not_in('post_type', 'page');

		$this->db->join('posts', 'posttags.post_id = posts.ID', 'inner');

		$this->db->where('tag_id', $tags);

		$this->db->order_by('post_date', 'desc');

		$this->db->group_by('post_id');
		
		if($type == 'num')
		{
			return $this->db->get('posttags')->num_rows();
		} else {
			return $this->db->get('posttags', $limit, $offset)->result();
		}
	}

	public function category($category = 0, $limit = 6, $offset = 0, $type = 'num')
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_id, post_excerpt');

		$this->db->where_not_in('post_type', 'page');

		$this->db->join('posts', 'postcategory.post_id = posts.ID', 'inner');

		$this->db->where('category_id', $category);

		$this->db->order_by('post_date', 'desc');

		$this->db->group_by('post_id');
		if($type == 'num')
		{
			return $this->db->get('postcategory')->num_rows();
		} else {
			return $this->db->get('postcategory', $limit, $offset)->result();
		}
	}

	public function news_category_array($category = NULL,  $limit = 6, $offset = 0, $type = 'num')
	{
		if( is_array($category) == FALSE )
			show_error(
				"Parameter pertama yang harus dimasukkan harus berupa array.", 
				500, 
				'Kesalahan Parameter'
			);

		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_id, post_excerpt');

		$this->db->where_not_in('post_type', 'page');

		$this->db->join('posts', 'postcategory.post_id = posts.ID', 'inner');

		$this->db->where_in('category_id', $category);

		$this->db->order_by('viewer', 'asc');

		$this->db->group_by('post_id');
		if($type == 'num')
		{
			return $this->db->get('postcategory')->num_rows();
		} else {
			return $this->db->get('postcategory', $limit, $offset)->result();
		}
	}

	public function search($limit = 16, $offset = 0, $type = 'num')
	{
		$keyword = $this->clean_string($this->input->get('q'));

		$filter = '';

		$order_by = '';

		$category = '';

		$from_date = '';

		$to_date = '';

		switch ($this->input->get('order')) 
		{
			case 'latest':
				$order_by .= ' ORDER BY post_date DESC ';
				break;
			case 'relevance':
			case 'popular':
				$order_by .= ' ORDER BY viewer DESC ';
				break;
			default:
				$order_by .= ' ORDER BY post_date DESC ';
				break;
		}

		if( $this->input->get('from_date') != '')
			$from_date = " AND post_date >= '{$this->input->get('from_date')}' ";

		if( $this->input->get('to_date') != '')
			$to_date = " AND post_date <= '{$this->input->get('to_date')}' ";

		$inputCat = $this->input->get('category');
		
		if($this->input->get('category') != '')
			$category .= " AND category_id = '{$inputCat}' ";

		if($type == 'num')
		{
			$query = $this->db->query("
				SELECT ID, post_date, post_title, post_excerpt, post_content, image
				FROM postcategory 
					INNER JOIN posts ON postcategory.post_id = posts.ID
				WHERE
					post_title LIKE '%{$keyword}%'
					{$category}	
					{$from_date} 
					{$to_date}		
				GROUP BY post_id
			");
			return $query->num_rows();
		} else {
			$query = $this->db->query("
				SELECT ID, post_date, post_title, post_excerpt, post_content, image
				FROM postcategory 
					INNER JOIN posts ON postcategory.post_id = posts.ID
				WHERE
					post_title LIKE '%{$keyword}%'
					{$category}
					{$from_date} 
					{$to_date}
					GROUP BY post_id
				{$order_by}
				LIMIT {$limit} OFFSET {$offset}
			");
			return $query->result();
		}
	}

	public function clean_string($s) 
	{
	  $string = str_replace(')', '', str_replace('(', '', str_replace('-', '', str_replace('+', '', str_replace('<', '', str_replace('>', '', str_replace('@', '', str_replace("'", '', trim($s)))))))));
	  return $string;
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
		$this->db->select('name, slug, categories.category_id');

		$this->db->join('postcategory', 'categories.category_id = postcategory.category_id', 'left');

		$this->db->where('post_id', $post);

		$this->db->group_by('post_id');

		return $this->db->get('categories')->row();
	}

	public function next($post = 0)
	{
		$this->db->select('ID, post_title, post_slug');

		$this->db->where('ID >', $post);

		$this->db->order_by('post_date', 'desc');

		return $this->db->get('posts')->row();
	}

	public function prev($post = 0)
	{
		$this->db->select('ID, post_title, post_slug');

		$this->db->where('ID <', $post);

		$this->db->order_by('post_date', 'desc');

		return $this->db->get('posts')->row();
	}

	public function get_post_categories($post = 0)
	{
		$this->db->select('name, slug, categories.category_id');

		$this->db->join('postcategory', 'categories.category_id = postcategory.category_id', 'left');

		$this->db->where('post_id', $post);

		$this->db->group_by('category_id');

		return $this->db->get('categories')->result();
	}

	public function get_post_tags($post = 0)
	{
		$this->db->select('name, slug, tags.tag_id');

		$this->db->join('tags', 'tags.tag_id = posttags.tag_id', 'inner');

		$this->db->join('posts', 'posttags.post_id = posts.ID', 'inner');

		$this->db->where('post_id', $post);

		$this->db->order_by('post_date', 'desc');

		$this->db->group_by('tag_id');
		
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

		$this->db->where_not_in('post_type', 'page');

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
			case 'month':
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

	/**
	 * Get POSTpage type
	 *
	 * @var string
	 **/
	public function get_page()
	{
		$this->db->select('
			ID, post_title, post_slug, post_date, post_content, post_type, image, post_modified, post_excerpt, comment_status, poll_status
		');

		$this->db->where('post_slug', $this->permalink_page);

		return $this->db->get('posts')->row();
	}

	public function get_polling_post($param = 0)
	{
		$this->db->select('pollingquestion.question_id, pollingquestion.question, pollingpost.pollingpost_id');

		$this->db->join('pollingquestion', 'pollingpost.question_id = pollingquestion.question_id', 'inner');

		$this->db->where('post_id', $param);

		$this->db->where('polling_status', 'active');

		return $this->db->get('pollingpost')->row();
	}

	public function getmeta($meta = '', $post = 0)
	{
		return $this->db->get_where('postmeta', array('meta_key' => $meta, 'post_id' => $post))->row('meta_value');
	}

	public function getphoto($post = 0)
	{
		return $this->db->get_where('postmeta', array('meta_key' => 'photo', 'post_id' => $post))->result();
	}
}

/* End of file Posts.php */
/* Location: ./application/models/Posts.php */