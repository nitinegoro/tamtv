<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the sidebar right
 *
 * Displays all of the sidebar right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */

$box = $this->themes->get('ads-120x600-right');
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
		<?php if( $box == 'yes' AND $this->posts->getmeta('vidio', @$post->ID) == FALSE) : ?>
		<div class="ads-right">
			<?php echo $box->meta_value ?>
		</div>
		<?php endif; ?>
	</div>
<?php
/* End of file right-sidebar.php */
/* Location: ./application/views/sidebar-index.php */