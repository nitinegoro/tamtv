<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model 
{
	public $sluguri;

	public function __construct()
	{
		parent::__construct();
		
		$this->sluguri = $this->uri->segment(2);
	}
	
	public function get($param = NULL)
	{
		$this->db->select('category_id, name, slug, description, parent');

		if( is_null($param) == TRUE )
		{
			$this->db->where('slug', $this->sluguri);
		} else {
			$this->db->where('category_id', $param);
		}

		return $this->db->get('categories')->row();
	}

	public function getallpg($limit = 20, $offset = 0, $type = 'result')
	{
		$this->db->like('name', $this->input->get('query'))
				->or_like('description', $this->input->get('query'));

		$this->db->order_by('category_id', 'desc');

		if( $type == 'num' )
		{
			return $this->db->get('categories')->num_rows();
		} else {
			return $this->db->get('categories', $limit, $offset)->result();
		}
	}

	public function get_parent()
	{
		return $this->db->get_where('categories', array('parent' => 0))->result();
	}

	public function get_child( $parent = 0 )
	{
		return $this->db->get_where('categories', array('parent' => $parent))->result();
	}

	public function create()
	{
		$object = array(
			'name' => $this->input->post('nama'),
			'slug' => $this->create_new_slug(),
			'description' => $this->input->post('deskripsi'),
			'parent' => $this->input->post('parent')
		);

		$this->db->insert('categories', $object);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Kategori berhasil ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal saat menyimpan data.', 
				array('type' => 'warning','icon' => 'warning')
			);
		}
	}

	public function update( $param  = 0)
	{
		$object = array(
			'name' => $this->input->post('nama'),
			'slug' => $this->create_new_slug($param),
			'description' => $this->input->post('deskripsi'),
			'parent' => $this->input->post('parent')
		);

		$this->db->update('categories', $object, array('category_id' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Kategori berhasil diperbarui.'.anchor(base_url("administrator/post_category"), 'kembali ke Kategori', array('class' => 'text-green')),  
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
			SELECT slug FROM categories 
				WHERE slug = '{$this->slug->create_slug($string)}'
			");
		} else {
			$query = $this->db->query("
			SELECT slug FROM categories 
				WHERE slug = '{$this->slug->create_slug($string)}' AND category_id NOT IN({$param})
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
		$this->db->delete('postcategory', array('category_id' => $param));
		$this->db->delete('categories', array('category_id' => $param));

		$this->template->alert(
			' Kategori berhasil dihapus. ', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function delete_multiple()
	{
		if( is_array($this->input->post('categories')) )
		{
			foreach ($this->input->post('categories') as $key => $value) 
			{
				$this->db->delete('postcategory', array('category_id' => $value));
				$this->db->delete('categories', array('category_id' => $value));
			}

			$this->template->alert(
				' Kategori berhasil dihapus. ', 
				array('type' => 'success','icon' => 'check')
			);
		}
	}

	public function count_postcategory($category = 0)
	{
		return $this->db->query("
			SELECT COUNT(postcategory.category_id) AS jumlah_posts FROM postcategory 
				WHERE category_id = '{$category}'
		")->row('jumlah_posts');
	}

	public function getall()
	{
		return $this->db->get('categories')->result();
	}

	public function get_category_uri($category = 0)
	{
		$cat = $this->get($category);

		return base_url("kategori/{$cat->slug}");
	}
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */