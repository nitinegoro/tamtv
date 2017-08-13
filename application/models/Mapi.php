<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapi extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_category($param = NULL)
	{
		$this->db->select('category_id, name, slug, description, parent');

		$this->db->where('slug', $param);

		return $this->db->get('categories')->row();
	}

	public function category($category = 0, $limit = 2, $ID = 0)
	{
		$this->db->select('ID, post_title, post_slug, post_date, post_content, image, post_id');

		$this->db->join('posts', 'postcategory.post_id = posts.ID', 'inner');

		$this->db->where('category_id', $category);

		$this->db->where('post_id >', $ID);

		$this->db->order_by('post_id', 'asc');

		$this->db->group_by('post_id');
		
		return $this->db->get('postcategory', $limit, 0)->result();
	}
}

/* End of file Mapi.php */
/* Location: ./application/models/Mapi.php */