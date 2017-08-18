<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Model 
{
	public $slug;

	public function __construct()
	{
		parent::__construct();
		
		$this->slug = $this->uri->segment(2);
	}

	public function get($param = NULL)
	{
		$this->db->select('tag_id, name, slug, description');

		if( is_null($param) == TRUE )
		{
			$this->db->where('slug', $this->slug);
		} else {
			$this->db->where('tag_id', $param);
		}

		return $this->db->get('tags')->row();
	}

	/**
	 * Select distinct tag from posttags
	 *
	 * @link https://dba.stackexchange.com/questions/60577/select-distinct-with-another-table
	 **/
	public function box($limit = 5)
	{
		return $this->db->query("
			SELECT tags.*, max(posttags.post_id) AS post FROM posttags 
				INNER JOIN tags ON posttags.tag_id = tags.tag_id
			GROUP BY tag_id
			ORDER BY post DESC
			LIMIT {$limit}
		")->result();
	}

	public function getAll($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->like('name', $this->input->get('query'))
				->or_like('description', $this->input->get('query'));

		$this->db->order_by('tag_id', 'desc');

		if( $type == 'num' )
		{
			return $this->db->get('tags')->num_rows();
		} else {
			return $this->db->get('tags', $limit, $offset)->result();
		}
	}

}

/* End of file Tags.php */
/* Location: ./application/models/Tags.php */

