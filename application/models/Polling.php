<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polling extends CI_Model 
{
	public function get_question($param = 0)
	{
		$this->db->where('question_id', $param);
		return $this->db->get('pollingquestion')->row();
	}

	public function get_answers($param = 0)
	{
		$this->db->where('question_id', $param);
		return $this->db->get('pollinganswer')->result();
	}

}

/* End of file Polling.php */
/* Location: ./application/models/Polling.php */