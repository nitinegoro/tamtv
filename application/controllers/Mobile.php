<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends Mobile_site 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->meta_tags->set_meta_tag('title', $this->options->get('sitename') );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->data = array(
			'title' => $this->options->get('sitename')	
		);

		$this->load->view('mobile/main', $this->data);
	}

}

/* End of file Mobile.php */
/* Location: ./application/controllers/Mobile.php */