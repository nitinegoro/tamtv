<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the index page
 *
 * Displays all of the index element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */
?>
	<div class="container content-wrapper">
		<div class="col-xs-8">
			<?php  
			/**
			 * Load the elements sidebar
			 *
			 * @param string ( themes layout )
			 **/
			foreach ($this->themes->layout('content-index') as $row) 
			{
				$this->load->view('box-elements/'.$row->meta_key);
			}
			?>
		</div>
<?php
/* End of file index.php */
/* Location: ./application/views/pages/index.php */