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

	public function layout_admin($layout = 'sidebar-index')
	{
		return $this->db->query("
			SELECT meta_name, meta_key, meta_value, status FROM themesmeta 
				WHERE layout = '{$layout}'
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
			SELECT meta_name, meta_key, meta_value, status FROM themesmeta WHERE meta_key = '{$param}'
		")->row();
	}

	public function update_layout()
	{
		foreach($this->input->post('elements') as $key => $value) 
		{
			$method = 'Update_'.str_replace('-', '_', $value);

			self::$method();
		}
	}
	/* METHOD UPDATE */
	public function Update_trending_tags()
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('trending-tags[name]'),
					'meta_value' => json_encode($this->input->post('trending-tags[json]')),
					'status' => $this->input->post('trending-tags[status]')
				),
				array(
					'meta_key' => 'trending-tags'
				)
		);
	}
	public function Update_ads_300x100()
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_value' => $this->input->post('ads-300x100[iklan]'),
					'status' => $this->input->post('ads-300x100[status]')
				),
				array(
					'meta_key' => 'ads-300x100'
				)
		);
	}
	public function Update_category_two()
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('category-two[name]'),
					'meta_value' => json_encode($this->input->post('category-two[json]')),
					'status' => $this->input->post('category-two[status]')
				),
				array(
					'meta_key' => 'category-two'
				)
		);
	}
	public function Update_ads_300x400()
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_value' => $this->input->post('ads-300x400[iklan]'),
					'status' => $this->input->post('ads-300x400[status]')
				),
				array(
					'meta_key' => 'ads-300x400'
				)
		);
	}
	public function Update_specific_one()
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('specific-one[name]'),
					'meta_value' => json_encode($this->input->post('specific-one[json]')),
					'status' => $this->input->post('specific-one[status]')
				),
				array(
					'meta_key' => 'specific-one'
				)
		);
	}
	public function Update_popular_sidebar()
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('popular-sidebar[name]'),
					'meta_value' => json_encode($this->input->post('popular-sidebar[json]')),
					'status' => $this->input->post('popular-sidebar[status]')
				),
				array(
					'meta_key' => 'popular-sidebar'
				)
		);
	}
}

/* End of file Themes.php */
/* Location: ./application/models/Themes.php */