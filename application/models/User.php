<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model 
{
	public function create()
	{
		$object = array(
			'fullname' => $this->input->post('fullname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'registered' => date('Y-m-d H:i:s'),
			'avatar' => null,
			'status' => 1
		);

		$this->db->insert('users', $object);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Silahkan login untuk berpartisipasi kepada kami.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat menyimpan data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}
	
	public function get_user_login()
	{
		if (filter_var($this->input->post('username'), FILTER_VALIDATE_EMAIL)) 
		{
			$this->db->where('email', $this->input->post('username'));
		} else {
			$this->db->where('username', $this->input->post('username'));
		}

		$this->db->where('status', 1);

		return $this->db->get('users')->row();
	}

	public function update_last_login($param = 0)
	{
		$this->db->update('users', array('last_login' => date('Y-m-d H:i:s')), array('ID' => $param));

		return $this->db->affected_rows();
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */