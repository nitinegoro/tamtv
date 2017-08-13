<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model 
{
	public $slug;

	public function __construct()
	{
		parent::__construct();
		
		$this->slug = $this->uri->segment(2);
	}
	
	public function get($param = NULL)
	{
		$this->db->select('category_id, name, slug, description, parent');

		if( is_null($param) == TRUE )
		{
			$this->db->where('slug', $this->slug);
		} else {
			$this->db->where('category_id', $param);
		}

		return $this->db->get('categories')->row();
	}

	public function getall()
	{
		return $this->db->get('categories')->result();
	}
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */