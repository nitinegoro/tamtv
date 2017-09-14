<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Respondent extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function count($question = 0, $answer = 0)
	{
		$this->db->select('COUNT(pollingrespondent.response_date) AS jumlah');

		$this->db->join('pollingpost', 'pollingrespondent.pollingpost_id = pollingpost.pollingpost_id', 'left');

		$this->db->where('pollingpost.question_id', $question);

		$this->db->where('pollingrespondent.answer_id', $answer);

		return $this->db->get('pollingrespondent')->row('jumlah');
	}

	public function count_question_resp($question = 0)
	{
		$this->db->join('pollingpost', 'pollingrespondent.pollingpost_id = pollingpost.pollingpost_id', 'left');

		$this->db->select('COUNT(pollingrespondent.response_date) AS jumlah');

		$this->db->where('question_id', $question);

		return $this->db->get('pollingrespondent')->row('jumlah');
	}
}

/* End of file Respondent.php */
/* Location: ./application/models/Respondent.php */