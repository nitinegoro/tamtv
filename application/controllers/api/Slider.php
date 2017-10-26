<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends Web 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function headline()
	{
		$this->outputHtml = array();

		foreach (range(1, 5) as $key => $value) 
		{
			$this->outputHtml[$key]['content'] = '<div class="slide_inner"><a href="" class="text-slider">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, amet!</a><a class="photo_link" href="">';
			$this->outputHtml[$key]['content'] .= '<img class="" src="'.base_url("public/image/news/3-pemain-pilar-timnas-indonesia-u-22-absen-melawan-malaysia.jpg").'" alt=""></a><a class="caption" href="">';
			$this->outputHtml[$key]['content'] .= '<a class="caption" href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, eaque</a></div>';
			$this->outputHtml[$key]['content_button'] = '<div class="thumb"><img src="'.base_url("public/image/news/x-small/3-pemain-pilar-timnas-indonesia-u-22-absen-melawan-malaysia.jpg").'" alt="bike is nice"></div><p>Agile Carousel Place Holder</p>';
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->outputHtml, JSON_PRETTY_PRINT));
	}

}

/* End of file Slider.php */
/* Location: ./application/controllers/api/Slider.php */