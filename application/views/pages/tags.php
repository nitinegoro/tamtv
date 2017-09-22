<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the topic page
 *
 * Displays all of the topic element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
?>
	<div class="container content-wrapper">
		<section class="col-md-4">
			<div id="sticker">
			<div class="page-tag box-sidebar">
				<h1><?php echo $tag->name; ?></h1>
				<p><?php echo $tag->description; ?></p>
				<?php  
				/**
				 * Load the elements sidebar
				 *
				 * @param string ( themes layout )
				 **/
				foreach ($this->themes->layout('sidebar-tag') as $row) 
				{
					$this->load->view('box-elements/'.$row->meta_key);
				}
				?>
			</div>
			</div>
		</section>
		<div class="col-xs-8 tag-content">
			<?php  
			/**
			 * Load the elements content
			 *
			 * @param string ( themes layout )
			 **/
			foreach ($this->themes->layout('content-tag') as $row) 
				$this->load->view('box-elements/'.$row->meta_key);
			?>
		</div>
	</div>
<?php
/* End of file tags.php */
/* Location: ./application/views/pages/tags.php */