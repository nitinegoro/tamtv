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
		$config['image_library'] = 'gd2';
		$config['source_image'] = './public/image/gambar.jpg';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 600;
		$config['height']       = 450;

		$this->load->library('image_lib', $config);

		

		if ( ! $this->image_lib->resize())
		{
		    echo $this->image_lib->display_errors();
		} else {
                        
			$imgConfig['image_library']   = 'gd2';                    
			$imgConfig['source_image'] = './public/image/gambar_thumb.jpg';       
			$imgConfig['wm_overlay_path'] = './public/image/site/logo.png';            
			$imgConfig['wm_type'] = 'overlay';
			$imgConfig['wm_opacity'] = 50;

            $imgConfig['padding'] = 90;
			$imgConfig['wm_hor_offset'] = 5;
			$imgConfig['wm_vrt_offset'] = 5;
			$imgConfig['wm_vrt_alignment'] = 'bottom';
			$imgConfig['wm_hor_alignment'] = 'left';
			                        
			$this->load->library('image_lib', $imgConfig);
			                        
			$this->image_lib->initialize($imgConfig);
			                        
			if( ! $this->image_lib->watermark() )
				echo $this->image_lib->display_errors(); 

			echo "<img src='".base_url("public/image/gambar_thumb_thumb.jpg")."'/>";
		}
	}
}
