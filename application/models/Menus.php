<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Model 
{
	public function get($param = 'primary_menu', $parent = 0)
	{
		$this->db->select('ID, label, url, target');

		$this->db->where('key_menu', $param);

		if( $parent == TRUE )
		{
			$this->db->where('parent', $parent);
		} else {
			$this->db->where('parent', 0);
		}
			
		$this->db->order_by('position', 'asc');

		return $this->db->get('menus')->result();
	}
}

/* End of file Menus.php */
/* Location: ./application/models/Menus.php */