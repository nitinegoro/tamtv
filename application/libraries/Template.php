<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function view($content, $data = NULL)
	{
        if ( ! $content)
        {
            return NULL;
        }  else  {
            $this->template['header'] = $this->ci->load->view('header', $data, TRUE);
            $this->template['navbar'] = $this->ci->load->view('navbar', $data, TRUE);
            $this->template['content'] = $this->ci->load->view('pages/'.$content, $data, TRUE);
            $this->template['footer'] = $this->ci->load->view('footer', $data, TRUE);

            return $this->ci->load->view('index', $this->template);
        }
	}

    public function admin($content, $data = NULL)
    {
        if ( ! $content)
        {
            return NULL;
        }  else  {
            $this->template['header'] = $this->ci->load->view('administrator/header', $data, TRUE);
            $this->template['navbar'] = $this->ci->load->view('administrator/navbar', $data, TRUE);
            $this->template['leftsidebar'] = $this->ci->load->view('administrator/left_sidebar', $data, TRUE);
            $this->template['content'] = $this->ci->load->view('administrator/pages/'.$content, $data, TRUE);
            $this->template['footer'] = $this->ci->load->view('administrator/footer', $data, TRUE);

            return $this->ci->load->view('administrator/index', $this->template);
        }
    }
	
    public function alert($message, $config)
    {
        $alert  = "<div class='alert alert-{$config['type']} animated'>";
        $alert .= "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
        $alert .= "<small><strong><i class='ace-icon fa fa-{$config['icon']}'></i> </strong>{$message}</small>";
        $alert .= "</div>";
        $this->ci->session->set_flashdata('alert', $alert);
    }

    public function pagination_list()
    {
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = "&larr; ".lang('pagination_first_link');
        $config['first_tag_open'] = '<li class="">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = lang('pagination_last_link')." &rarr;";
        $config['last_tag_open'] = '<li class="">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = lang('pagination_next_link')." &rarr;";
        $config['next_tag_open'] = '<li class="">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = "&larr; ".lang('pagination_prev_link'); 
        $config['prev_tag_open'] = '<li class="">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="">';
        $config['num_tag_close'] = '</li>'; 
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        return $config;
    }

}

/* End of file Template.php */
/* Location: ./application/modules/administrator/libraries/Template.php */
