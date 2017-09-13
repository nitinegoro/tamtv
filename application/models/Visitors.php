<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitors extends CI_Model 
{
	public function visitor_create()
	{
		if( $this->valid_visitor() == FALSE)
			$this->db->insert('visitors', array(
				'visitor_date' => date('Y-m-d H:i:s'),
				'ip_address' => $this->input->ip_address(),
				'platform' => $this->agent->platform(),
				'browser' => $this->agent->browser(),
				'ci_session' => $this->input->cookie('tamnews'),
				'post_id' => $this->getpostid()
			)
		);
	}

	protected function valid_visitor()
	{
		if( $this->router->fetch_method() != 'getpost')
		{
			return $this->db->get_where('visitors', array(
				'ip_address' => $this->input->ip_address(),
				'DATE(visitor_date)' => date('Y-m-d'), 
				'ci_session' => $this->input->cookie('tamnews')
			))->num_rows();
		} else {
			return $this->db->get_where('visitors', array(
				'ip_address' => $this->input->ip_address(),
				'DATE(visitor_date)' => date('Y-m-d'), 
				'ci_session' => $this->input->cookie('tamnews'),
				'post_id' => $this->getpostid()
			))->num_rows();
		}
	}

	protected function getpostid()
	{
		if( $this->router->fetch_method() == 'getpost')
		{
	        $CI =& get_instance();

	        $CI->load->model('posts');

	        $post = $this->posts->get();

	        return $post->ID;
	    }
	}

	/**
	 * Hitung Jumlah Pengunjung
	 *
	 * @param date (tanggal)
	 * @param String (jenis tanggal)
	 * @return Integer
	 **/
	public function count_by_date($date = NULL)
	{
		return $this->db->query("
			SELECT DISTINCT ip_address, platform, browser, post_id, ci_session
				FROM visitors  
			WHERE DATE(visitor_date) = '{$date}'
		")->num_rows();
	}
}

/* End of file Visitors.php */
/* Location: ./application/models/Visitors.php */