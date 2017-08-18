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

	public function getMe()
	{
		$this->db->select('ID, fullname, username, email, last_login, avatar, password');
		
		$this->db->where('ID', $this->session->userdata('user')->ID);

		return $this->db->get('users')->row();
	}

	public function updateAccount()
	{
		if( $this->input->post('newpassword') )
		{ 
			$object = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			);
		} else {
			$object = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
			);
		}

		$this->db->update('users', $object, array('ID' => $this->session->userdata('user')->ID));
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

	public function get_admin_login()
	{
		if (filter_var($this->input->post('username'), FILTER_VALIDATE_EMAIL)) 
		{
			$this->db->where('email', $this->input->post('username'));
		} else {
			$this->db->where('username', $this->input->post('username'));
		}

		$this->db->where('status', 1);

		$this->db->where('user_type !=', 'reader');

		return $this->db->get('users')->row();
	}

	public function update_last_login($param = 0)
	{
		$this->db->update('users', array('last_login' => date('Y-m-d H:i:s')), array('ID' => $param));

		return $this->db->affected_rows();
	}

	public function validate_password()
	{
		$akun = $this->getMe();

		if( password_verify($this->input->post('oldpassword'), $akun->password) )
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function validate_email()
	{
		$akun = $this->getMe();

		$this->db->where('email', $this->input->post('username') );

		$this->db->where_not_in('ID', $this->session->userdata('user')->ID);
		
		if( $this->db->get('users')->num_rows() == FALSE )
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function validate_username()
	{
		$akun = $this->getMe();
			
		$this->db->where('username', $this->input->post('username') );

		$this->db->where_not_in('ID', $this->session->userdata('user')->ID);

		if( $this->db->get('users')->num_rows() == FALSE )
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */