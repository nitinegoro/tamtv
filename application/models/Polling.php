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

	public function save_polling()
	{
		if( $this->valid_polling( $this->input->post('post') ) == FALSE)
		{
			$this->db->insert('pollingrespondent', array(
				'pollingpost_id' => $this->input->post('post'),
				'user_id' => $this->session->userdata('user')->ID,
				'answer_id' => $this->input->post('answer'),
				'response_date' => date('Y-m-d H:i:s')
			));
		} else {
			$this->db->update('pollingrespondent', array(
				'answer_id' => $this->input->post('answer'),
				'response_date' => date('Y-m-d H:i:s')
			), array(
				'pollingpost_id' => $this->input->post('post'),
				'user_id' => $this->session->userdata('user')->ID,
			));
		}

		return $this->db->affected_rows();
	}

	public function save_polling_session()
	{
		foreach( $this->cart->contents() as $data )
		{
			if( $this->valid_polling($data['post']) == FALSE)
			{
				$this->db->insert('pollingrespondent', array(
					'pollingpost_id' => $data['post'],
					'user_id' => $this->session->userdata('user')->ID,
					'answer_id' => $data['answer'],
					'response_date' => date('Y-m-d H:i:s')
				));
			} else {
				$this->db->update('pollingrespondent', array(
					'answer_id' => $data['answer'],
					'response_date' => date('Y-m-d H:i:s')
				), array(
					'pollingpost_id' => $data['post'],
					'user_id' => $this->session->userdata('user')->ID,
				));
			}
		}
		
		$this->cart->destroy();
	}

	public function valid_polling($post = 0)
	{
		return $this->db->get_where('pollingrespondent', array(
			'pollingpost_id' => $post,
			'user_id' => $this->session->userdata('user')->ID
		))->num_rows();
	}
}

/* End of file Polling.php */
/* Location: ./application/models/Polling.php */