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
		'top-index' => 'Iklan Atas, Kiri dan Kanan'
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
			ORDER BY position ASC
		")->result();
	}

	public function get_all_layout()
	{
		return $this->db->query("
			SELECT DISTINCT layout FROM themesmeta 
			WHERE  layout NOT IN('mobile-index','mobile-category','mobile-tag','content-live','content-category','content-tag')
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
	
	public function get($param = '', $layout = FALSE)
	{
		if( $layout == FALSE)
		{
			return $this->db->query("
				SELECT meta_name, meta_key, meta_value, status FROM themesmeta WHERE meta_key = '{$param}'
			")->row();
		} else {
			return $this->db->query("
				SELECT meta_name, meta_key, meta_value, status FROM themesmeta WHERE meta_key = '{$param}' AND layout = '{$layout}'
			")->row();
		}
	}

	public function update_layout($param  = 'sidebar-index')
	{
		foreach($this->input->post('elements') as $key => $value) 
		{
			$method = 'Update_'.str_replace('-', '_', $value);

			self::$method( $param );
		}
	}
	/* METHOD UPDATE */
	public function Update_trending_tags($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('trending-tags[name]'),
					'meta_value' => json_encode($this->input->post('trending-tags[json]')),
					'status' => $this->input->post('trending-tags[status]')
				),
				array(
					'meta_key' => 'trending-tags',
					'layout' => $layout
				)
		);
	}
	public function Update_ads_300x100($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_value' => $this->input->post('ads-300x100[iklan]'),
					'status' => $this->input->post('ads-300x100[status]')
				),
				array(
					'meta_key' => 'ads-300x100',
					'layout' => $layout
				)
		);
	}
	public function Update_category_two($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('category-two[name]'),
					'meta_value' => json_encode($this->input->post('category-two[json]')),
					'status' => $this->input->post('category-two[status]')
				),
				array(
					'meta_key' => 'category-two',
					'layout' => $layout
				)
		);
	}
	public function Update_ads_300x400($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_value' => $this->input->post('ads-300x400[iklan]'),
					'status' => $this->input->post('ads-300x400[status]')
				),
				array(
					'meta_key' => 'ads-300x400',
					'layout' => $layout
				)
		);
	}
	public function Update_specific_one($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('specific-one[name]'),
					'meta_value' => json_encode($this->input->post('specific-one[json]')),
					'status' => $this->input->post('specific-one[status]')
				),
				array(
					'meta_key' => 'specific-one',
					'layout' => $layout
				)
		);
	}
	public function Update_popular_sidebar($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('popular-sidebar[name]'),
					'meta_value' => json_encode($this->input->post('popular-sidebar[json]')),
					'status' => $this->input->post('popular-sidebar[status]')
				),
				array(
					'meta_key' => 'popular-sidebar',
					'layout' => $layout
				)
		);
	}
	public function Update_headline_slider($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('headline-slider[name]'),
					'meta_value' => json_encode($this->input->post('headline-slider[json]')),
					'status' => $this->input->post('headline-slider[status]')
				),
				array(
					'meta_key' => 'headline-slider',
					'layout' => $layout
				)
		);
	}
	public function Update_headline_news($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('headline-news[name]'),
					'meta_value' => json_encode($this->input->post('headline-news[json]')),
					'status' => $this->input->post('headline-news[status]')
				),
				array(
					'meta_key' => 'headline-news',
					'layout' => $layout
				)
		);
	}
	public function Update_most_viewer($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('most-viewer[name]'),
					'meta_value' => json_encode($this->input->post('most-viewer[json]')),
					'status' => $this->input->post('most-viewer[status]')
				),
				array(
					'meta_key' => 'most-viewer',
					'layout' => $layout
				)
		);
	}
	public function Update_ads_600x90($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_value' => $this->input->post('ads-600x90[iklan]'),
					'status' => $this->input->post('ads-600x90[status]')
				),
				array(
					'meta_key' => 'ads-600x90',
					'layout' => $layout
				)
		);
	}
	public function Update_category_loop_index($layout='')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('category-loop-index[name]'),
					'meta_value' => json_encode($this->input->post('category-loop-index[json]')),
					'status' => $this->input->post('category-loop-index[status]')
				),
				array(
					'meta_key' => 'category-loop-index',
					'layout' => $layout
				)
		);
	}
	public function Update_recomended_loop($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('recomended-loop[name]'),
					'meta_value' => json_encode($this->input->post('recomended-loop[json]')),
					'status' => $this->input->post('recomended-loop[status]')
				),
				array(
					'meta_key' => 'recomended-loop',
					'layout' => $layout
				)
		);
	}
	public function Update_box_thumbnail_foto($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('box-thumbnail-foto[name]'),
					'meta_value' => json_encode($this->input->post('box-thumbnail-foto[json]')),
					'status' => $this->input->post('box-thumbnail-foto[status]')
				),
				array(
					'meta_key' => 'box-thumbnail-foto',
					'layout' => $layout
				)
		);
	}
	public function Update_box_video_index($layout='')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('box-video-index[name]'),
					'meta_value' => json_encode($this->input->post('box-video-index[json]')),
					'status' => $this->input->post('box-video-index[status]')
				),
				array(
					'meta_key' => 'box-video-index',
					'layout' => $layout
				)
		);
	}
	public function Update_default_loop($layout='')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('default-loop[name]'),
					'meta_value' => json_encode($this->input->post('default-loop[json]')),
					'status' => $this->input->post('default-loop[status]')
				),
				array(
					'meta_key' => 'default-loop',
					'layout' => $layout
				)
		);
	}
	public function Update_specific_two($layout='')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('specific-two[name]'),
					'meta_value' => json_encode($this->input->post('specific-two[json]')),
					'status' => $this->input->post('specific-two[status]')
				),
				array(
					'meta_key' => 'specific-two',
					'layout' => $layout
				)
		);
	}
	public function Update_similar_one($layout='')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('similar-one[name]'),
					'meta_value' => json_encode($this->input->post('similar-one[json]')),
					'status' => $this->input->post('similar-one[status]')
				),
				array(
					'meta_key' => 'similar-one',
					'layout' => $layout
				)
		);
	}
	public function Update_most_popular_single($value='')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_name' => $this->input->post('most-popular-single[name]'),
					'meta_value' => json_encode($this->input->post('most-popular-single[json]')),
					'status' => $this->input->post('most-popular-single[status]')
				),
				array(
					'meta_key' => 'most-popular-single',
					'layout' => $layout
				)
		);
	}
	public function Update_ads_980x90($layout = '')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_value' => $this->input->post('ads-980x90[iklan]'),
					'status' => $this->input->post('ads-980x90[status]')
				),
				array(
					'meta_key' => 'ads-980x90',
					'layout' => $layout
				)
		);
	}
	public function Update_ads_120x600_left($layout='')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_value' => $this->input->post('ads-120x600-left[iklan]'),
					'status' => $this->input->post('ads-120x600-left[status]')
				),
				array(
					'meta_key' => 'ads-120x600-left',
					'layout' => $layout
				)
		);
	}
	public function Update_ads_120x600_right($layout='')
	{
		return $this->db->update('themesmeta', 
				array(
					'meta_value' => $this->input->post('ads-120x600-right[iklan]'),
					'status' => $this->input->post('ads-120x600-right[status]')
				),
				array(
					'meta_key' => 'ads-120x600-right',
					'layout' => $layout
				)
		);
	}
}

/* End of file Themes.php */
/* Location: ./application/models/Themes.php */