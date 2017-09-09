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
			'poll_status' => (!$this->input->post('polling') ) ? 'close' : $this->input->post('polling'),
			'post_modified' => date('Y-m-d H:i:s'),
			'post_type' => $this->input->post('type'),
			'image' => $this->upload_image(),
			'post_author' => $this->session->userdata('user')->ID,
			'viewer' => 0
		);

		$this->db->insert('posts', $object); 

		$post = $this->db->insert_id();

		$this->insert_vidio($post);

		$this->insert_categories($post);

		$this->insert_tags($post);

		$this->insert_polling($post);

		$this->insert_image_caption($post); 

		$this->insert_image_galery($post);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Berita berhasil ditambahkan.'.anchor(base_url("administrator/post"), 'kembali ke Berita', array('class' => 'text-green')),  
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat menyimpan data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}

		return $post;
	}


	public function update( $param  = 0)
	{
		$object = array(
			'post_title' => $this->input->post('judul'), 
			'post_slug' => $this->create_post_slug( $param ),
			'post_excerpt' => $this->input->post('excerpt'),
			'post_content' => $this->input->post('content'),
			'post_status' => $this->input->post('status'),
			'post_type' => $this->input->post('type'),
			'comment_status' => (!$this->input->post('comment')) ? 'close' : $this->input->post('comment'),
			'poll_status' => (!$this->input->post('polling') ) ? 'close' : $this->input->post('polling'),
			'post_modified' => date('Y-m-d H:i:s'),
			'image' => $this->upload_image( $param ),
		);

		$this->db->update('posts', $object, array('ID' => $param));

		$this->insert_categories($param);

		$this->insert_vidio($param);

		$this->insert_tags($param);

		$this->insert_polling($param);

		$this->insert_image_caption($param);

		$this->insert_image_galery($param);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Berita berhasil diperbarui.'.anchor(base_url("administrator/post"), 'kembali ke Berita', array('class' => 'text-green')),  
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat menyimpan data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function insert_image_caption($post = 0)
	{
		if( $this->input->post('figure_caption') != '')
		{
			if( $this->db->get_where('postmeta', array('post_id' => $post,'meta_key' => 'figure_caption'))->num_rows() == FALSE ) 
			{
				$this->db->insert('postmeta', array(
					'post_id' => $post,
					'meta_key' => 'figure_caption',
					'meta_value' => $this->input->post('figure_caption')
					)
				);
			} else {
				$this->db->update('postmeta', array(
						'meta_value' => $this->input->post('figure_caption')
					),
					array(
						'post_id' => $post,
						'meta_key' => 'figure_caption'
					)
				);
			}
		}
	}

	public function insert_vidio($post = 0)
	{
		if( $this->input->post('video') != '' ) 
		{
			if( $this->db->get_where('postmeta', array('post_id' => $post,'meta_key' => 'video'))->num_rows() == FALSE ) 
			{
				$this->db->insert('postmeta', array(
					'post_id' => $post,
					'meta_key' => 'video',
					'meta_value' => $this->input->post('video')
					)
				);
			} else {
				$this->db->update('postmeta', array(
						'meta_value' => $this->input->post('video')
					),
					array(
						'post_id' => $post,
						'meta_key' => 'video'
					)
				);
			}
		}
	}
	
	public function insert_polling($post = 0)
	{
		if( $this->input->post('polling') == 'open' AND $this->input->post('pollingquestion') != FALSE)
		{
			$this->db->update('pollingpost', 
				array(
					'polling_status' => 'deactive'
				),
				array(
					'post_id' => $post
				)
			);

			$query = $this->db->get_where('pollingpost', 
				array(
					'post_id' => $post,
					'question_id' => $this->input->post('pollingquestion'),
				)
			);

			if( $query->num_rows() == FALSE )
			{
				$object = array(
					'post_id' => $post,
					'question_id' => $this->input->post('pollingquestion'),
					'polling_status' => 'active'
				);

				$this->db->insert('pollingpost', $object);
			} else {
				$this->db->update('pollingpost', 
					array(
						'polling_status' => 'active'
					),
					array(
						'post_id' => $post,
						'question_id' => $this->input->post('pollingquestion'),
						'polling_status' => 'deactive'
					)
				);
			}
		}
	}

	public function insert_categories($post = 0)
	{
		if( is_array($this->input->post('categories')) )
		{
			$object = array();

			foreach( $this->input->post('categories') as $key => $value)
			{
				$this->db->delete('postcategory', array(
					'post_id' => $post,
					'category_id != ' => $value 
				));

				if( $this->db->get_where('postcategory', array('post_id' => $post,'category_id' => $value ))->num_rows() )
					continue;

				$object[] = array(
					'post_id' => $post,
					'category_id' => $value 
				);
			}

			if( count($object) >= 1)
				$this->db->insert_batch('postcategory', $object);

			return TRUE;
		} else {
			$this->db->delete('postcategory', array(
				'post_id' => $post
			));
		}
	}

	public function insert_tags($post = 0)
	{
		if( is_array($this->input->post('topik')) )
		{
			$object = array();

			foreach ($this->input->post('topik') as $key => $value) 
			{
				$this->db->delete('posttags', array(
					'post_id' => $post,
					'tag_id != ' => $value 
				));

				if( $this->db->get_where('posttags', array('post_id' => $post,'tag_id' => $value ))->num_rows() )
					continue;

				$object[] = array(
					'post_id' => $post,
					'tag_id' => $value 
				);
			}

			if( count($object) >= 1)
				$this->db->insert_batch('posttags', $object);

			return TRUE;
		} else {
			$this->db->delete('posttags', array(
				'post_id' => $post
			));
		} 
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
		$config['max_size']  = '4000';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $this->create_post_slug();

		$this->upload->initialize( $config);

		if ( $this->upload->do_upload('gambar') == TRUE )
		{
			if( $this->input->post('watermark') != 'no')	
				$this->set_watermark($this->upload->file_name);

			$this->create_thumb($this->upload->file_name, 'large');

			$this->create_thumb($this->upload->file_name, 'small');

			$this->create_thumb($this->upload->file_name, 'x-small');

			return $this->upload->file_name;
		} else {
			if( $param == TRUE )
			{
				$post = $this->get( $param );

				if( $post->image != FALSE AND $this->upload->do_upload('gambar') == TRUE)
				{
					@unlink("./public/image/news/{$post->image}");
					@unlink("./public/image/news/small/{$post->image}");
					@unlink("./public/image/news/x-small/{$post->image}");
				}

				//$this->set_watermark($post->image);

				$this->create_thumb($post->image, 'large');

				$this->create_thumb($post->image, 'small');

				$this->create_thumb($post->image, 'x-small');

				return $post->image;
			}
		}
	}

	public function insert_image_galery($post = 0)
	{
	    $jumlahfiles = count($_FILES['photo']['name']);
	    // Faking upload calls to $_FILE
	    for ($i = 0; $i < $jumlahfiles; $i++) 
	    {
	    	$_FILES['userfile']['name']     = $_FILES['photo']['name'][$i];
	    	$_FILES['userfile']['type']     = $_FILES['photo']['type'][$i];
	    	$_FILES['userfile']['tmp_name'] = $_FILES['photo']['tmp_name'][$i];
	    	$_FILES['userfile']['error']    = $_FILES['photo']['error'][$i];
	    	$_FILES['userfile']['size']     = $_FILES['photo']['size'][$i];
	    	$config = array(
	        	'file_name'     => $_FILES['photo']['name'][$i],
	        	'allowed_types' => 'jpg|jpeg|png|gif',
	        	'max_size'      => 20000,
	        	'overwrite'     => FALSE,
	        	'upload_path' =>'./public/image/news/photos'
	    	);
	      
	      	$this->upload->initialize($config);
	      
	      	if ( ! $this->upload->do_upload()) 
	      	{
		        continue;
	      	} else {
	      		$hasilUpload[] = $this->upload->data();

				if( $this->input->post('watermark') != 'no')	
					$this->set_watermark($hasilUpload[$i]['file_name'], TRUE);

				$config['image_library'] = 'GD2';
				$config['source_image'] = './public/image/news/photos/'.$hasilUpload[$i]['file_name'];
				$config['new_image'] = './public/image/news/photos/'.$hasilUpload[$i]['file_name'];
				$config['width'] = 1080;
				$config['height'] = 720;
				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();

				$this->db->insert('postmeta', array(
					'post_id' => $post,
					'meta_key' => 'photo',
					'meta_value' => json_encode(array(
							'image' => $hasilUpload[$i]['file_name'],
							'caption' => $this->input->post('caption')[$i]
						))
					)
				);
	      	}
	    }
	}

	public function delete_image_in_galery($param = 0)
	{
		$photo = $this->db->get_where('postmeta', array('meta_id' => $param))->row('meta_value');

		$img = json_decode($photo);

		@unlink("./public/image/news/photos/{$img->image}");

		$this->db->delete('postmeta', array('meta_id' => $param));

		return $this->db->affected_rows();
	}

	public function create_thumb($source = '', $type = 'large')
	{
		switch ($type) 
		{
			case 'small':
				$config['image_library'] = 'GD2';
				$config['source_image'] = './public/image/news/'.$source;
				$config['maintain_ratio'] = FALSE;
				$config['new_image'] = './public/image/news/small/'.$source;
				$config['width'] = 350;
				$config['height'] = 200;
				$config['quality'] = '70%';
				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();
				break;
			case 'x-small':
				$config['image_library'] = 'GD2';
				$config['source_image'] = './public/image/news/'.$source;
				$config['maintain_ratio'] = FALSE;
				$config['new_image'] = './public/image/news/x-small/'.$source;
				$config['width'] = 100;
				$config['height'] = 60;
				$config['quality'] = '70%';
				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();
				break;
			case 'large':
				$config['image_library'] = 'GD2';
				$config['source_image'] = './public/image/news/'.$source;
				$config['new_image'] = './public/image/news/'.$source;
				$config['width'] = 1080;
				$config['height'] = 720;
				$this->image_lib->initialize($config);

				$this->image_lib->resize();

				$this->image_lib->clear();
				break;
			default:
				# code...
				break;
		}
	}

	public function set_watermark($source = '', $photo = FALSE)
	{
		$imgConfig['image_library']   = 'GD2';                    
		
		if( $photo == TRUE) 
		{
			$imgConfig['source_image'] = './public/image/news/photos/'.$source; 
		} else {
			$imgConfig['source_image'] = './public/image/news/'.$source; 
		}

		switch ($this->input->post('watermark')) 
		{
		  	case 'putih':
		  		$imgConfig['wm_overlay_path'] = './public/image/site/logo-watermark-putih.png';   
		  		break;
		  	case 'abu-abu':
		  		$imgConfig['wm_overlay_path'] = './public/image/site/logo-watermark-abu.png';  
		  		break;
		  	case 'hitam':
		  		$imgConfig['wm_overlay_path'] = './public/image/site/logo-watermark-hitam.png';  
		  		break;
		  }  
		         
		$imgConfig['wm_type'] = 'overlay';

        $imgConfig['padding'] = 100;
		$imgConfig['wm_hor_offset'] = 20;
		$imgConfig['wm_vrt_offset'] = 20;
		$imgConfig['wm_vrt_alignment'] = 'bottom';
		$imgConfig['wm_hor_alignment'] = 'right';
			                        
		$this->image_lib->initialize($imgConfig);
			                        
		$this->image_lib->watermark();
	}

	public function valid_category($post = 0, $category = 0)
	{
		$query = $this->db->get_where('postcategory', array('post_id' => $post, 'category_id' => $category))->num_rows();

		if( $query )
			echo "checked";
	}

	public function valid_topik($post = 0, $topik = 0)
	{
		$query = $this->db->get_where('posttags', array('post_id' => $post, 'tag_id' => $topik))->num_rows();

		if( $query )
			echo "selected";
	}

	public function valid_question($post = 0, $question = 0)
	{
		$query = $this->db->get_where('pollingpost', array(
			'post_id' => $post, 
			'question_id' => $question,
			'polling_status' => 'active'
		))->num_rows();

		if( $query )
			echo "selected";
	}

	public function delete($param = 0)
	{
		$post = $this->get( $param );

		if( $post->image != FALSE)
		{
			@unlink("./public/image/news/{$post->image}");
			@unlink("./public/image/news/small/{$post->image}");
			@unlink("./public/image/news/x-small/{$post->image}");
		}

		$this->db->delete('posttags', array('post_id' => $param));

		$this->db->delete('pollingpost', array('post_id' => $param));

		$this->db->delete('postcategory', array('post_id' => $param));

		$this->db->delete('pollingrespondent', array('pollingpost_id' => $param));

		$this->db->delete('comments', array('comment_post_ID' => $param));

		$this->db->delete('posts', array('ID' => $param));

        $CI =& get_instance();

        $CI->load->model('posts');

        foreach( $CI->posts->getphoto($param) as $row)
        {
        	$img = json_decode($row->meta_value);

        	@unlink("./public/image/news/photos/{$img->image}");
        }

        $this->db->delete('postmeta', array('post_id' => $param));

		$this->template->alert(
			' Berita berhasil dihapus. ', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function delete_multiple()
	{
		if( is_array($this->input->post('posts')))
		{
			foreach( $this->input->post('posts') as $key => $value) 
			{
				$post = $this->get( $value );

				if( $post->image != FALSE)
				{
					@unlink("./public/image/news/{$post->image}");
					@unlink("./public/image/news/small/{$post->image}");
					@unlink("./public/image/news/x-small/{$post->image}");
				}

				$this->db->delete('posttags', array('post_id' => $value));

				$this->db->delete('pollingpost', array('post_id' => $value));

				$this->db->delete('postcategory', array('post_id' => $value));

				$this->db->delete('pollingrespondent', array('pollingpost_id' => $value));

				$this->db->delete('comments', array('comment_post_ID' => $value));

				$this->db->delete('posts', array('ID' => $value));
			}

			$this->template->alert(
				' Berita berhasil dihapus. ', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada berita yang dipilih. ', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function add_new_category()
	{
        $CI =& get_instance();

        $CI->load->model('category');

		$object = array(
			'name' => $this->input->post('nama'),
			'slug' => $CI->category->create_new_slug(),
			'description' => null,
			'parent' => $this->input->post('parent')
		);

		$this->db->insert('categories', $object);

		return $this->db->insert_id();
	}

	public function add_new_tag()
	{
        $CI =& get_instance();

        $CI->load->model('tags');

		$object = array(
			'name' => $this->input->post('nama'),
			'slug' => $CI->tags->create_new_slug(),
			'description' => null
		);

		$this->db->insert('tags', $object);

		return $this->db->insert_id();
	}

	public function count_all()
	{
		return $this->db->get_where('posts', array('post_type !=' => 'page'))->num_rows();
	}
}

/* End of file Cpost.php */
/* Location: ./application/models/Cpost.php */