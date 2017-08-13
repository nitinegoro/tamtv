<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the live streaming page
 *
 * Displays all of the live streaming element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
?>
	<?php  
	/**
	 * Content Index Live Streaming
	 *
	 * @var string
	 **/
	$this->load->view('box-elements/live-mode', $this->data);
	?>
	<!-- End mode vido -->
	<div class="container content-wrapper">
		<div class="col-xs-8">
			<?php  
			/**
			 * Load the elements content
			 *
			 * @param string ( themes layout )
			 **/
			foreach ($this->themes->layout('content-live') as $row) 
				$this->load->view('box-elements/'.$row->meta_key);
			?>
		</div>
<?php
/* End of file live-streaming.php */
/* Location: ./application/views/pages/live-streaming.php */