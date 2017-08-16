<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -s
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');

		$config['image_library'] = 'GD2';
		$config['source_image'] = './public/image/site/2253-warga-belitung-terima-bantuan-pkh.jpg';
		$config['new_image'] = './public/image/news/2253-warga-belitung-terima-bantuan-pkh.jpg';
		//$config['create_thumb'] = TRUE;
		//$config['maintain_ratio'] = TRUE;
		$config['width'] = 600;
		$config['height'] = 400;

		$this->load->library('image_lib', $config);


		if ( ! $this->image_lib->resize())
		{
		    echo $this->image_lib->display_errors();
		} else {
                        
/*			$imgConfig['image_library']   = 'GD2';                    
			$imgConfig['source_image'] = './public/image/news/waspada-ini-3-tanda-mesin-atm-yang-diintai-penjahat.jpg';       
			$imgConfig['wm_overlay_path'] = './public/image/site/logo-watermark.png';            
			$imgConfig['wm_type'] = 'overlay';

            $imgConfig['padding'] = 20;
			$imgConfig['wm_hor_offset'] = 5;
			$imgConfig['wm_vrt_offset'] = 5;
			$imgConfig['wm_vrt_alignment'] = 'bottom';
			$imgConfig['wm_hor_alignment'] = 'right';
			                        
			$this->load->library('image_lib', $imgConfig);
			                        
			$this->image_lib->initialize($imgConfig);
			                        
			if( ! $this->image_lib->watermark() )
				echo $this->image_lib->display_errors(); 

			echo "<img src='".base_url("public/image/news/aktifitas-permainan-di-atm-dihentikan-demi-kenyamanan-100x70.jpg")."'/>";*/
		}
	}

	public function test($value='')
	{
		$query = $this->db->query("SELECT MATCH(post_title, post_excerpt, post_content) AGAINST ('endang' IN BOOLEAN MODE) AS relevance 
			FROM posts 
				WHERE post_date >= '2017-08-11' AND post_date <= '2017-08-17'
			AND MATCH(post_title, post_excerpt, post_content) AGAINST ('endang' IN BOOLEAN MODE)
			")->result();

		echo "<pre>";
		echo count($query);
	}
}
