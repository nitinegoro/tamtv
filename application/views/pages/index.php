<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the index page
 *
 * Displays all of the index element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$adsleft = $this->themes->get('ads-120x600-left', 'top-index');

$asdtop = $this->themes->get('ads-980x90', 'top-index');
?>	
	<div class="container content-wrapper">
        <?php
        if( $asdtop->status == 'yes' ) :
        ?>
        <div class="col-xs-12 text-center">
        	<div class="adsvertising">
        		<?php echo $asdtop->meta_value; ?>
        	</div>
        </div>
        <?php endif; 
        if( $adsleft == 'yes') : ?>
		<div class="ads-left">
			<?php echo $adsleft->meta_value ?>
		</div>
		<?php endif; ?>
		<div class="col-xs-8">
			<?php  
			/**
			 * Load the elements sidebar
			 *
			 * @param string ( themes layout )
			 **/
			foreach ($this->themes->layout('content-index') as $row) 
				$this->load->view('box-elements/'.$row->meta_key);
			?>
		</div>
<?php
/* End of file index.php */
/* Location: ./application/views/pages/index.php */