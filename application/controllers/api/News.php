<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends web 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mapi', 'api');
	}

	public function category($param = '')
	{

	}

}

/* End of file News.php */
/* Location: ./application/controllers/api/News.php */