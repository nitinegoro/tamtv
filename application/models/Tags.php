<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Model 
{
	public $sluguri;

	public function __construct()
	{
		parent::__construct();
		
		$this->sluguri = $this->uri->segment(2);

		$this->load->library(array('slug'));
	}

	public function get($param = NULL)
	{
		$this->db->select('tag_id, name, slug, description');

		if( is_null($param) == TRUE )
		{
			$this->db->where('slug', $this->sluguri);
		} else {
			$this->db->where('tag_id', $param);
		}

		return $this->db->get('tags')->row();
	}

	/**
	 * Select distinct tag from posttags
	 *
	 * @link https://dba.stackexchange.com/questions/60577/select-distinct-with-another-table
	 **/
	public function box($limit = 5)
	{
		return $this->db->query("
			SELECT tags.*, max(posttags.post_id) AS post FROM posttags 
					INNER JOIN tags ON posttags.tag_id = tags.tag_id
				GROUP BY tag_id
				ORDER BY post DESC
			LIMIT {$limit}
		")->result();
	}

	public function getAll($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->like('name', $this->input->get('query'))
				->or_like('description', $this->input->get('query'));

		$this->db->order_by('tag_id', 'desc');

		if( $type == 'num' )
		{
			return $this->db->get('tags')->num_rows();
		} else {
			return $this->db->get('tags', $limit, $offset)->result();
		}
	}

	public function get_all()
	{
		$this->db->select('tag_id, name');
		
		return $this->db->get('tags')->result();
	}

	public function count_posttags($tag = 0)
	{
		return $this->db->query("
			SELECT COUNT(posttags.tag_id) AS jumlah_posts FROM posttags 
				WHERE tag_id = '{$tag}'
		")->row('jumlah_posts');
	}

	public function create()
	{
		$object = array(
			'name' => $this->input->post('nama'),
			'slug' => $this->create_new_slug(),
			'description' => $this->input->post('deskripsi') 
		);

		$this->db->insert('tags', $object);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Topik berhasil ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat menyimpan data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function update($param = 0)
	{
		$object = array(
			'name' => $this->input->post('nama'),
			'slug' => $this->create_new_slug($param),
			'description' => $this->input->post('deskripsi') 
		);

		$this->db->update('tags', $object, array('tag_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Topik berhasil diperbarui. &larr; '.anchor(base_url("administrator/post_tags"), 'kembali ke Topik', array('class' => 'text-green')), 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat menyimpan data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function create_new_slug( $param = 0)
	{
		$string = ( $this->input->post('slug') == FALSE ) ? $this->input->post('nama') : $this->input->post('slug');

		if( $param == FALSE )
		{
			$query = $this->db->query("
			SELECT slug FROM tags 
				WHERE slug = '{$this->slug->create_slug($string)}'
			");
		} else {
			$query = $this->db->query("
			SELECT slug FROM tags 
				WHERE slug = '{$this->slug->create_slug($string)}' AND tag_id NOT IN({$param})
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
		$this->db->delete('posttags', array('tag_id' => $param));
		$this->db->delete('tags', array('tag_id' => $param));

		$this->template->alert(
			' Topik berhasil dihapus. ', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function delete_multiple()
	{
		if( is_array($this->input->post('tags')))
		{
			foreach ($this->input->post('tags') as $key => $value) 
			{
				$this->db->delete('posttags', array('tag_id' => $value));
				$this->db->delete('tags', array('tag_id' => $value));
			}

			$this->template->alert(
				' Topik berhasil dihapus. ', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Tidak ada topik yang dipilih. ', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}
}

/* End of file Tags.php */
/* Location: ./application/models/Tags.php */

