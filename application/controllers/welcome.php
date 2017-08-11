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
		$config['source_image'] = './public/bkkbn.png';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 700;
		$config['height']       = 550;

		$this->load->library('image_lib', $config);

		

		if ( ! $this->image_lib->resize())
		{
		    echo $this->image_lib->display_errors();
		} else {
                        
			$imgConfig['image_library']   = 'gd2';                    
			$imgConfig['source_image'] = './public/bkkbn_thumb.png';       
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

			echo "<img src='".base_url("public/bkkbn_thumb_thumb.png")."'/>";
		}
	}
}
