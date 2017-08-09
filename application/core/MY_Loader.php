<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Custom Loader Codeigniter
 *
 * @var string
 **/

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader
{
	private $javascripts = array();

	private $css = array();

	private $cached_css = array();

	private $cached_js = array();

	private $_inline_scripting = array("infile"=>"", "stripped"=>"", "unstripped"=>"");

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function js()
	{
		$script_files = func_get_args();

		foreach($script_files as $script_file){
			$script_file = substr($script_file,0,1) == '/' ? substr($script_file,1) : $script_file;

			$is_external = false;
			if(is_bool($script_file))
				continue;

			$is_external = preg_match("/^https?:\/\//", trim($script_file)) > 0 ? true : false;

			if(!$is_external)
				if(!file_exists($script_file))
					show_error("Cannot locate javascript file: {$script_file}");

			$script_file = $is_external == FALSE ?  base_url() . $script_file : $script_file;

			if(!in_array($script_file, $this->javascripts))
				$this->javascripts[] = $script_file;
		}

		return;
	}

	public function start_inline_scripting()
	{
		ob_start();
	}

	public function end_inline_scripting($strip_tags = TRUE, $append_to_file = TRUE)
	{
		$source = ob_get_clean();

		 if($strip_tags)
		 {
			 $source = preg_replace("/<script.[^>]*>/", '', $source);
			 $source = preg_replace("/<\/script>/", '', $source);
		 }

		 if($append_to_file)
		 {
		 	$this->_inline_scripting['infile'] .= $source;
		 } else {
		 	if($strip_tags) {
		 		$this->_inline_scripting['stripped'] .= $source;
		 	} else {
		 		$this->_inline_scripting['unstripped'] .= $source;
		 	}
		 }
	}

	public function get_css_files()
	{
		return $this->css;
	}

	public function get_cached_css_files()
	{
		return $this->cached_css;
	}

	public function get_js_files()
	{
		return $this->javascripts;
	}

	public function get_cached_js_files()
	{
		return $this->cached_js;
	}

	public function get_inline_scripting()
	{
		return $this->_inline_scripting;
	}


}

/* End of file MY_loader.php */
/* Location: ./application/core/MY_loader.php */