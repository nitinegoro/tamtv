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

	public function result($param = '')
	{
		return $this->db->get_where('options', array('option_name' => $param))->result();
	}

	public function update($paramater = '', $value = '')
	{
		$this->db->update('options', array('option_value' => $value), array('option_name' => $paramater));

		return $this->db->affected_rows();
	}

	public function update_social_media()
	{
		if( is_array($this->input->post('social')) )
		{
			foreach ($this->input->post('social') as $key => $value) 
			{
				$this->db->update('options', array('option_value' => json_encode($value)), array('option_id' => $key));
			}
		}
	}

}

/* End of file Options.php */
/* Location: ./application/models/Options.php */