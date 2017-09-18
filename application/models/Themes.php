<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Themes extends CI_Model 
{
	public $layout_aliases = array(
		'content-index' => "Konten Utama",
		'sidebar-index' => "Sidebar Utama",
		'sidebar-tag' => "Sidebar Topik",
		'sidebar-single' => 'Sidebar Detail',
		'content-single' => 'Konten Detail',
		'sidebar-live' => 'Sedebar Live',
		'content-live' => 'Konten Live',
		'content-category' => 'Konten Kategori',
		'content-tag' => 'Konten Topik',
		'top-index' => 'Atas Utama'
	);

	public function layout($layout = 'content-index')
	{
		return $this->db->query("
			SELECT meta_name, meta_key, meta_value FROM themesmeta 
				WHERE status = 'yes' AND layout = '{$layout}'
			ORDER BY position ASC
		")->result();
	}

	public function get_all_layout()
	{
		return $this->db->query("
			SELECT DISTINCT layout FROM themesmeta 
			WHERE  layout NOT IN('mobile-index','mobile-category','mobile-tag')
			ORDER BY tmeta_id ASC
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