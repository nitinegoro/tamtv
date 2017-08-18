<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Model 
{
	public function get_post_comments($post = 0, $limit = 10)
	{
		$this->db->select('comment_id, comment_parent, comment_date, comment_content, fullname, user_id');

		$this->db->join('users', 'comments.user_id = users.ID', 'inner');

		$this->db->where('comment_post_ID', $post);

		$this->db->where_in('comment_parent', 0);

		$this->db->order_by('comment_date', 'desc');

		return $this->db->get('comments', $limit)->result();
	}

	public function get_post_child_comments($parent = 0, $limit = 10)
	{
		$this->db->select('comment_id, comment_parent, comment_date, comment_content, fullname, user_id');

		$this->db->join('users', 'comments.user_id = users.ID', 'inner');

		$this->db->where('comment_parent', $parent);

		$this->db->order_by('comment_date', 'asc');

		return $this->db->get('comments', $limit)->result();
	}

	public function get_user_comments($limit = 15, $offset = 0, $type = 'result')
	{
		$this->db->select('comment_id, comment_parent, comment_date, comment_content, post_title, comment_post_ID');

		$this->db->join('posts', 'comments.comment_post_ID = posts.ID', 'inner');

		$this->db->where('user_id', $this->session->userdata('user')->ID);

		$this->db->order_by('comment_date', 'desc');

		if( $type == 'result')
		{
			return $this->db->get('comments', $limit, $offset)->result();
		} else {
			return $this->db->get('comments')->num_rows();
		}
	}

	public function user_create_comment()
	{
		$comment = array(
			'comment_post_ID' => $this->input->post('post'),
			'user_id' => $this->session->userdata('user')->ID,
			'comment_parent' => $this->input->get('parent'),
			'comment_approved' => $this->get_option('comment_auto_approved'),
			'comment_date' => date('Y-m-d H:i:s'),
			'comment_content' => strip_tags($this->input->post('comment'))
		);

		$this->db->insert('comments', $comment);
	}

	public function delete($param = 0)
	{
		$this->db->delete('comments', array('comment_parent' => $param));
		$this->db->delete('comments', array('comment_id' => $param));
	}
	
	public function get_option($param = 'comment_auto_approved')
	{
		return $this->db->query("SELECT option_value FROM options WHERE option_name = '{$param}'")->row('option_value');
	}
}

/* End of file Comment.php */
/* Location: ./application/models/Comment.php */