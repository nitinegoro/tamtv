<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Themes extends CI_Model 
{
	public function layout($layout = 'content-index')
	{
		return $this->db->query("
			SELECT meta_name, meta_key, meta_value FROM themesmeta 
				WHERE status = 'yes' AND layout = '{$layout}'
			ORDER BY position ASC
		")->result();
	}

	public function get_element($layout = '', $key = '')
	{
		return $this->db->query("
			SELECT meta_name, meta_key, meta_value FROM themesmeta 
				WHERE status = 'yes' AND layout = '{$layout}' AND meta_key = '{$key}'
		")->row('meta_value');
	}
	
	public function get($param = '')
	{
		return $this->db->query("
			SELECT meta_name, meta_key, meta_value, status FROM themesmeta WHERE meta_key = '{$param}' AND status = 'yes'
		")->row();
	}
}

/* End of file Themes.php */
/* Location: ./application/models/Themes.php */