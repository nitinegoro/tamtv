<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpost extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('upload','image_lib'));
	}

	public function get($param = 0)
	{
		return $this->db->get_where('posts', array('ID' => $param))->row();
	}

	public function create()
	{
		$object = array(
			'post_title' => $this->input->post('judul'), 
			'post_slug' => $this->create_post_slug(),
			'post_excerpt' => $this->input->post('excerpt'),
			'post_date' => date('Y-m-d H:i:s'),
			'post_content' => $this->input->post('content'),
			'post_status' => $this->input->post('status'),
			'comment_status' => (!$this->input->post('comment')) ? 'close' : $this->input->post('comment'),
			'poll_status' => (!$this->input->post('polling') )? 'close' : $this->input->post('polling'),
			'post_modified' => date('Y-m-d H:i:s'),
			'post_type' => 'default',
			'image' => $this->upload_image(),
			'post_author' => $this->session->userdata('user')->ID,
			'viewer' => 0
		);

		$this->db->insert('posts', $object);

		$post = $this->db->insert_id();

		$this->insert_categories($post);

		$this->insert_tags($post);

		return $post;
	}
	
	public function insert_categories($post = 0)
	{
		if( is_array($this->input->post('categories')) )
		{
			$object = array();

			foreach( $this->input->post('categories') as $key => $value)
			{
				$object[] = array(
					'post_id' => $post,
					'category_id' => $value 
				);
			}

			$this->db->insert_batch('postcategory', $object);

			return TRUE;
		}
	}

	public function insert_tags($post = 0)
	{
		# code...
	}

	public function create_post_slug( $param = 0)
	{
		$string = ( $this->input->post('slug') == FALSE ) ? $this->input->post('judul') : $this->input->post('slug');

		if( $param == FALSE )
		{
			$query = $this->db->query("
			SELECT post_slug FROM posts 
				WHERE post_slug = '{$this->slug->create_slug($string)}'
			");
		} else {
			$query = $this->db->query("
			SELECT post_slug FROM posts 
				WHERE post_slug = '{$this->slug->create_slug($string)}' AND ID NOT IN({$param})
			");
		}

		if( $query->num_rows() == TRUE )
		{
			return $this->slug->create_slug($string).'-'.$query->num_rows();
		} else {
			return $this->slug->create_slug($string);
		}
	}

	public function upload_image( $param = 0 )
	{
		$config['upload_path'] = './public/image/news';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '3000';
		$config['max_width']  = '3072';
		$config['max_height']  = '2160';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $this->create_post_slug();

		$this->upload->initialize( $config);

		if( $param == FALSE)
		{
			if ( $this->upload->do_upload('gambar') == TRUE )
			{
				$this->set_watermark($this->upload->file_name);

				$this->create_thumb($this->upload->file_name, 'large');

				$this->create_thumb($this->upload->file_name, 'small');

				$this->create_thumb($this->upload->file_name, 'x-small');

				return $this->upload->file_name;
			}
		} else {

		}
	}

	public function create_thumb($source = '', $type = 'large')
	{
		switch ($type) 
		{
			case 'small':
				$config['image_library'] = 'GD2';
				$config['source_image'] = './public/image/news/'.$source;
				$config['new_image'] = './public/image/news/small/'.$source;
				$config['width'] = 350;
				$config['height'] = 200;
				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();
				break;
			case 'x-small':
				$config['image_library'] = 'GD2';
				$config['source_image'] = './public/image/news/'.$source;
				$config['new_image'] = './public/image/news/x-small/'.$source;
				$config['width'] = 100;
				$config['height'] = 70;
				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();
		
				break;
			case 'large':
				$config['image_library'] = 'GD2';
				$config['source_image'] = './public/image/news/'.$source;
				$config['new_image'] = './public/image/news/'.$source;
				$config['width'] = 600;
				$config['height'] = 400;
				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();
				break;
			default:
				# code...
				break;
		}
	}

	public function set_watermark($source = '')
	{
		$imgConfig['image_library']   = 'GD2';                    
		$imgConfig['source_image'] = './public/image/news/'.$source;       
		$imgConfig['wm_overlay_path'] = './public/image/site/logo-watermark.png';            
		$imgConfig['wm_type'] = 'overlay';

        $imgConfig['padding'] = 20;
		$imgConfig['wm_hor_offset'] = 5;
		$imgConfig['wm_vrt_offset'] = 5;
		$imgConfig['wm_vrt_alignment'] = 'bottom';
		$imgConfig['wm_hor_alignment'] = 'right';
			                        
		$this->image_lib->initialize($imgConfig);
			                        
		$this->image_lib->watermark();
	}
}

/* End of file Cpost.php */
/* Location: ./application/models/Cpost.php */