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

	public function create_admin()
	{
		$object = array(
			'fullname' => $this->input->post('fullname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'registered' => date('Y-m-d H:i:s'),
			'avatar' => null,
			'status' => 1,
			'user_type' => $this->input->post('role')
		);

		$this->db->insert('users', $object);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Pengguna berhasil ditambahkan.', 
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
		$this->db->select('ID, fullname, username, email, last_login, user_type, password');
		
		$this->db->where('ID', $this->session->userdata('user')->ID);

		return $this->db->get('users')->row();
	}

	public function get($param = 0)
	{
		$this->db->select('ID, fullname, username, email, last_login,  user_type');
		
		$this->db->where('ID', $param );

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
				'password' => password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT),
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

	public function updateAdminAccount()
	{
		if( $this->input->post('newpassword') )
		{ 
			$object = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('newpassword'), PASSWORD_DEFAULT),
				'user_type' => $this->input->post('role')
			);
		} else {
			$object = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'user_type' => $this->input->post('role')
			);
		}

		$this->db->update('users', $object, array('ID' => $this->session->userdata('user')->ID));
	}

	public function update_user($param = 0)
	{
		$object = array(
			'fullname' => $this->input->post('fullname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'user_type' => $this->input->post('role')
		);

		$this->db->update('users', $object, array('ID' => $param));

		$this->template->alert(
			' Perubahan disimpan.', 
			array('type' => 'success','icon' => 'check')
		);
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

	public function get_user_email()
	{
		$this->db->where('email', $this->input->post('email'));

		$this->db->where('status', 1);

		$this->db->where('user_type =', 'reader');

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
		if( $this->input->post('ID') )
		{
			$akun = $this->get($this->input->post('ID'));
		} else {
			$akun = $this->getMe();
		}

		$this->db->where('email', $this->input->post('username') );

		$this->db->where_not_in('ID', $akun->ID);
		
		if( $this->db->get('users')->num_rows() == FALSE )
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function validate_username()
	{
		if( $this->input->post('ID') )
		{
			$akun = $this->get($this->input->post('ID'));
		} else {
			$akun = $this->getMe();
		}
			
		$this->db->where('username', $this->input->post('username') );

		$this->db->where_not_in('ID', $akun->ID);

		if( $this->db->get('users')->num_rows() == FALSE )
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getAll($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->select('ID, fullname, username, email, user_type');

		if( $this->input->get('role') != FALSE) 
		{
			$this->db->where('user_type =', $this->input->get('role'));
		} else {
			$this->db->like('fullname', $this->input->get('query'))
				->or_like('username', $this->input->get('query'));
		}

		$this->db->order_by('registered', 'desc');

		if( $type == 'num' )
		{
			return $this->db->get('users')->num_rows();
		} else {
			return $this->db->get('users', $limit, $offset)->result();
		}
	}

	public function count_posts($user = 0)
	{
		return $this->db->query("SELECT COUNT(*) AS jumlah FROM posts WHERE post_author = '{$user}'")->row('jumlah');
	}

	public function delete($param = 0)
	{
		$this->db->delete('pollingrespondent', array('user_id' => $param));

		$this->db->delete('comments', array('user_id' => $param));

		$this->db->delete('posts', array('post_author' => $param));

		$this->db->delete('users', array('ID' => $param));

		$this->template->alert(
			' Data pengguna berhasil dihapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function delete_multiple()
	{
		if( is_array($this->input->post('users')) )
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$this->db->delete('pollingrespondent', array('user_id' => $value));

				$this->db->delete('comments', array('user_id' => $value));

				$this->db->delete('posts', array('post_author' => $value));

				$this->db->delete('users', array('ID' => $value));
			}

			$this->template->alert(
				' Data pengguna berhasil dihapus.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada pengguna terpilih.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */