<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Web 
{
	public function __construct()
	{
		parent::__construct();
		$this->meta_tags->set_meta_tag('canonical', current_url() );
		$this->meta_tags->set_meta_tag('type', 'article' );
	}

	public function index()
	{
		$this->meta_tags->set_meta_tag('title', $this->options->get('sitename') );
		$this->meta_tags->set_meta_tag('description', $this->options->get('sitedescription') );

		$this->data = array(
			'title' => $this->options->get('sitename')	
		);

		$this->template->view('account', $this->data);
	}

}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */