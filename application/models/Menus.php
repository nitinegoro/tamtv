<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Model 
{
	public $menu_type;

	public function __construct()
	{
		parent::__construct();
		
		$this->menu_type = array('primary_menu', 'sticky_menu', 'footer_menu');
	}

	public function get($param = 'primary_menu', $parent = 0)
	{
		$this->db->select('ID, label, url, target');

		$this->db->where('key_menu', $param);

		if( $parent == TRUE )
		{
			$this->db->where('parent', $parent);
		} else {
			$this->db->where('parent', 0);
		}
			
		$this->db->order_by('position', 'asc');

		return $this->db->get('menus')->result();
	}

	public function update($param = 0)
	{
		$object = array(
			'label' => $this->input->post('label'),
			'target' => $this->input->post('target'),
			'url' => $this->input->post('url')
		);

		$this->db->update('menus', $object, array('ID' => $param));
	}

	public function delete($param = 0)
	{
		$this->db->delete('menus', array('ID' => $param));

		$this->db->update('menus', array('parent' => 0), array('parent' => $param));

		return TRUE;
	}

	public function create_custom()
	{
		$object = array(
			'key_menu' => $this->input->post('key'), 
			'parent' => 0,
			'label' => $this->input->post('label'),
			'url' => $this->input->post('url'),
			'target' => $this->input->post('target'),
			'position' => $this->last_position($this->input->post('key'))
		);

		$this->db->insert('menus', $object);
	}

	public function create_category()
	{
		if( is_array($this->input->post('categories')))
		{
			$object = array();

			foreach( $this->input->post('categories') as $key => $value)
			{
				$category = $this->db->query("SELECT name, slug FROM categories WHERE category_id = '{$value}'")->row();

				$object[] = array(
					'key_menu' => $this->input->post('key'), 
					'parent' => 0,
					'label' => $category->name,
					'url' => base_url("kategori/{$category->slug}"),
					'target' => '_self',
					'position' => $this->last_position($this->input->post('key'))
				);	
			}

			$this->db->insert_batch('menus', $object);
		}
	}

	public function create_page()
	{
		if( is_array($this->input->post('pages')))
		{
			$object = array();

			foreach( $this->input->post('pages') as $key => $value)
			{
				$page = $this->db->query("SELECT post_title, post_slug FROM posts WHERE ID = '{$value}'")->row();

				$object[] = array(
					'key_menu' => $this->input->post('key'), 
					'parent' => 0,
					'label' => $page->post_title,
					'position' => $this->last_position($this->input->post('key'))
				);	
			}

			$this->db->insert_batch('menus', $object);
		}
	}

	private function last_position($key = 'primary_menu')
	{
		$lastposition = $this->db->query("SELECT MAX(position) AS lastposition FROM menus WHERE key_menu = '{$key}'")->row('lastposition');

		if( $lastposition == FALSE)
			return 1;

		return $lastposition;
	}

	/**
	 * Update Structure menu
	 *
	 * @param Integer (link_menu_id)
	 * @see http://stackoverflow.com/questions/32255773/jquery-nestable-output-into-mysql-database
	 **/
	public function updatestructure($param = 0)
	{
	    //Creating from_db unnested array
	    $from_db = array();

	    $query = $this->db->query("SELECT * FROM menus WHERE key_menu = '{$this->input->post('key')}' AND parent != '0'");

	    foreach($query->result() as $row ) 
	    {
	        $from_db[$row->ID] = ['parent'=>$row->parent,'order'=>$row->position];
	    }

	    //Creating the post_db unnested array
	    $post_db = array();
	    $array = json_decode($this->input->post('output'));
	  	$post_db = $this->run_array_parent($array,'0');

	    //Comparing the arrays and adding changed values to $to_db
	    $to_db =array();

	    foreach($post_db as $key => $value)
	    {
	        if( !array_key_exists($key,$from_db) || ($from_db[$key]['parent'] != $value['parent']) || ($from_db[$key]['order'] != $value['order']))
	        {
	            $to_db[$key] = $value;
	        }   
	    }

	    // Generate Query 
	    if (count($to_db) > 0)
	    {
	        $query 			= "UPDATE menus";
	        $query_parent 	= " SET parent = CASE ID";
	        $query_order 	= " position = CASE ID";
	        $query_ids 		= " WHERE ID IN (".implode(", ",array_keys($to_db)).") AND key_menu = '".$this->input->post('key')."'";

	        foreach ($to_db as $id => $value)
	        {
	            $query_parent .= " WHEN ".$id." THEN ".$value['parent'];
	            $query_order  .= " WHEN ".$id." THEN ".$value['order'];
	        }

	        $query_parent .= " END,";
	        $query_order  .= " END"; 

	        $query = $query.$query_parent.$query_order.$query_ids;

	        //Executing query
	     	$this->db->query($query);
	    }
	}

	/**
	 * Function to create id =>[ order , parent] unnested array
	 *
	 * @return Array
	 **/
	private function run_array_parent($array, $parent){  
	    $post_db = array();     
	    foreach(@$array as $head => $body)
	    {
	       	if(isset($body->children))
	       	{
	           	$head++;
	           	$post_db[$body->id] = ['parent'=>$parent,'order'=>$head];
	           	$post_db = $post_db + $this->run_array_parent($body->children, $body->id);
	       	} else {
	           	$head++;
	           	$post_db[$body->id] = ['parent'=>$parent,'order'=>$head]; 
	       	}
	    }

	    return $post_db;
	}
}

/* End of file Menus.php */
/* Location: ./application/models/Menus.php */