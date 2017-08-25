<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function create()
	{
		$object = array(
			'post_title' => $this->input->post('judul'), 
			'post_slug' => $this->create_post_slug(),
			'post_excerpt' => $this->input->post('excerpt'),
			'post_date' => date('Y-m-d H:i:s'),
			'post_content' => $this->input->post('content'),
			'post_status' => 'publish',
			'comment_status' => 'close',
			'poll_status' => 'close',
			'post_modified' => date('Y-m-d H:i:s'),
			'post_type' => 'page',
			'image' => NULL,
			'post_author' => $this->session->userdata('user')->ID,
			'viewer' => 0
		);

		$this->db->insert('posts', $object);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Halaman berhasil ditambahkan.'.anchor(base_url("administrator/pages"), 'kembali ke semua halaman', array('class' => 'text-green')),  
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat menyimpan data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}

		return $this->db->insert_id();
	}

	public function update($param = 0)
	{
		$object = array(
			'post_title' => $this->input->post('judul'), 
			'post_slug' => $this->create_post_slug($param),
			'post_excerpt' => $this->input->post('excerpt'),
			'post_content' => $this->input->post('content'),
			'post_modified' => date('Y-m-d H:i:s')
		);

		$this->db->update('posts', $object, array('ID' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Halaman berhasil diperbarui.'.anchor(base_url("administrator/pages"), 'kembali ke semua halaman', array('class' => 'text-green')),  
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat menyimpan data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}

		return $param;
	}

	public function get($param = 0)
	{
		return $this->db->get_where('posts', array('ID' => $param, 'post_type' => 'page'))->row();
	}

	public function get_all( $limit = 15, $offset = 0, $type = 'result' )
	{
		$this->db->select('post_title, fullname, post_date, posts.ID, users.ID AS user_id, post_slug');

		if( $this->input->get('query') != '')
			$this->db->like('post_title', $this->input->get('query'));

		if( $this->input->get('author') != '')
			$this->db->where('post_author', $this->input->get('author'));

		$this->db->join('users', 'posts.post_author = users.ID', 'left');

		$this->db->where('post_type', 'page');

		$this->db->order_by('post_date', 'desc');

		if( $type == 'num')
		{
			return $this->db->get('posts')->num_rows();
		} else {
			return $this->db->get('posts', $limit, $offset)->result();
		}
	}

	public function getall()
	{
		$this->db->where('post_type', 'page');
		return $this->db->get('posts')->result();
	}

	public function create_post_slug( $param = 0)
	{
		$string = ( $this->input->post('slug') == FALSE ) ? $this->input->post('judul') : $this->input->post('slug');

		if( $param == FALSE )
		{
			$query = $this->db->query("
			SELECT post_slug FROM posts 
				WHERE post_slug = '{$this->slug->create_slug($string)}'
				AND post_type = 'page'
			");
		} else {
			$query = $this->db->query("
			SELECT post_slug FROM posts 
				WHERE post_slug = '{$this->slug->create_slug($string)}' AND ID NOT IN({$param})
				AND post_type = 'page'
			");
		}

		if( $query->num_rows() == TRUE )
		{
			return $this->slug->create_slug($string).'-'.$query->num_rows();
		} else {
			return $this->slug->create_slug($string);
		}
	}

	public function delete($param = 0)
	{
		$this->db->delete('posts', array('ID' => $param, 'post_type' => 'page'));


		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Halaman berhasil dihapus.',  
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat mengapus data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function delete_multiple($param = 0)
	{
		if( is_array($this->input->post('pages')) )
		{
			foreach ($this->input->post('pages') as $key => $value)
				$this->db->delete('posts', array('ID' => $value, 'post_type' => 'page'));

			if($this->db->affected_rows())
			{
				$this->template->alert(
					' Halaman berhasil dihapus.',  
					array('type' => 'success','icon' => 'check')
				);
			} else {
				$this->template->alert(
					' Gagal saat mengapus data.', 
					array('type' => 'warning','icon' => 'warning')
				);
			}
		} else {
			$this->template->alert(
				' Tidak ada halaman yang dipilih.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}
}

/* End of file Page.php */
/* Location: ./application/models/Page.php */