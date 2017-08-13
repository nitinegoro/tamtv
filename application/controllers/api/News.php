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
		$box = $this->themes->get('infinite-loop');

		$value = json_decode($box->meta_value);

		$category = $this->api->get_category($param);

		$this->data = array(
			'content' => $this->api->category($category->category_id, 2)
		);

		$this->load->view('box-elements/ajax-loop-infinite', $this->data );
	}

}

/* End of file News.php */
/* Location: ./application/controllers/api/News.php */