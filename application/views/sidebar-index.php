<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the sidebar right
 *
 * Displays all of the sidebar right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */
?>
		<div class="col-xs-4 box-sidebar">
			<?php  
			/**
			 * Load the elements sidebar
			 *
			 * @param string ( themes layout )
			 **/
			foreach ($this->themes->layout('sidebar-index') as $row) 
			{
				$this->load->view('box-elements/'.$row->meta_key);
			}
			?>
		</div>
	</div>
<?php
/* End of file right-sidebar.php */
/* Location: ./application/views/sidebar-index.php */