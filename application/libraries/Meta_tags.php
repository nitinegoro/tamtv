<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meta_tags
{
	protected $ci;

	public $tags;

	public $output;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

    /**
     * Sets a meta tag with name and content
     * @param $name string
     * @param $content string
     */
    public function set_meta_tag($name = '', $content = '')
    {
    	$this->tags[$name] = $content;
    }

	public function generate_meta_tags()
	{
		$output = "\n";

		if(is_array($this->tags))
		{
			foreach ($this->tags as $key => $value) 
			{
				if($key == 'title')
					continue;
				
				$output .= "\t";
				$output .= '<meta name="' . $key . '" content="' . $value . '" />' . PHP_EOL;
			}
		} 

		return $output;
	}

	public function generate_meta_social()
	{
		$output = "\n";

		if(is_array($this->tags))
		{
			foreach ($this->tags as $key => $value) 
			{
				$output .= "\t";
				$output .= '<meta name="og:' . $key . '" content="' . $value . '" />' . PHP_EOL;
				$output .= "\t";
				$output .= '<meta property="twitter:' . $key . '" content="' . $value . '" />' . PHP_EOL;
			}
		} 

		return $output;
	}
}

/* End of file Meta_tags.php */
/* Location: ./application/libraries/Meta_tags.php */
