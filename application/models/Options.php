<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Options extends CI_Model 
{

	public function get($param = '', $json = FALSE)
	{
		$this->db->select('option_value');

		$this->db->where('option_name', $param);

		if( $json == TRUE)
		{
			return json_decode($this->db->get('options')->row('option_value'));
		} else {
			return $this->db->get('options')->row('option_value');
		}
	}

}

/* End of file Options.php */
/* Location: ./application/models/Options.php */