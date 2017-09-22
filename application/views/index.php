<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The Bootstrapper Template
 *
 * Displays all of the element template.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */

if (isset($header))
{
    echo $header;
}

if (isset($navbar))
{
    echo $navbar;
}

if (isset($content))
{
    echo $content;
}

if( $this->router->fetch_class() == 'main' ) 
{
	switch ($this->router->fetch_method() ) 
	{
		case 'index':
			$this->load->view('sidebar-index', $this->data);
			break;
		case 'live':
			$this->load->view('sidebar-live', $this->data);
			break;
		case 'getpost':
			$this->load->view('sidebar-single', $this->data);
			break;
		case 'gettag':
		case 'page':
			break;
		default:
			$this->load->view('sidebar-index', $this->data);
			break;
	}
}


if (isset($footer))
{
    echo $footer;
}

/* End of file index.php */
/* Location: ./application/views/index.php */