<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Model {

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

}

/* End of file Tags.php */
/* Location: ./application/models/Tags.php */

