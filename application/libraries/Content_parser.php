<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_parser
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();

        $this->ci->load->model('posts');
	}

	
	public function related_news($post = 0, $limit = 3)
	{
		$inputTags = array_map(function ($object) { 
				return $object->tag_id; 
			}, 
			$this->ci->posts->get_post_tags($post)
		);

		$tags = implode(', ', $inputTags);

		$content  = '<div class="col-xs-6 box-sidebar pull-right">';
		$content .=	'<div class="box-category-1"><h3 class="sidebar-heading">Baca Juga</h3>';
		/**
		 * Get Similar Post by Tag
		 *
		 * @param String (IN tag_id)
		 **/
		foreach( $this->ci->posts->similar($tags, $post, $limit, NULL) as $row) 
		{
			$content .= '<div class="media-news"><div class="media-item"><div class="media-image hidden-xs">';
			$content .= '<a href="'.$this->ci->posts->permalink($row->ID).'" title="'.$row->post_title.'">';
			$content .='<img src="'.$this->ci->posts->get_thumbnail($row->image, 'x-small').'" alt="'.$row->post_title.'" class="img-responsive"></a>';
			$content .=	'</div> <div class="media-content">';
			$content .=	'<h4 class="media-title"><a href="'.$this->ci->posts->permalink($row->ID).'" title="'.$row->post_title.'">'.$row->post_title.'</a></h4>';
			$content .=	'</div></div></div>';
		}
		$content .=	'</div></div>';
		return $content;
	}
}

/* End of file Content_parser.php */
/* Location: ./application/libraries/Content_parser.php */
