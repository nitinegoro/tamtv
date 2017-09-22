<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the category index page
 *
 * Displays all of the category index element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */

$adsleft = $this->themes->get('ads-120x600-left');

$asdtop = $this->themes->get('ads-980x90');
?>
	<div class="container content-wrapper" id="infinite">
        <?php if( $adsleft == 'yes' ) : ?>
		<div class="ads-left">
			<?php echo $adsleft->meta_value ?>
		</div>
		<?php endif; ?>
		<div class="col-xs-8">
			<div class="content-breadcrumb">
			<?php  
			/**
			 * Displayed Breadcrumbs
			 *
			 * @return string
			 **/
			echo $this->breadcrumbs->show();
			?>
			</div>
			<section class="page-cetegory">
				<h1 class="heding-page"><?php echo $category->name; ?></h1>
				<p><?php echo $category->description ?></p>
			</section>
			<?php  
			/**
			 * Load the elements sidebar
			 *
			 * @param string ( themes layout )
			 **/
			foreach ($this->themes->layout('content-category') as $row) 
				$this->load->view('box-elements/'.$row->meta_key);
			?>
		</div>
<?php
/* End of file category.php */
/* Location: ./application/views/pages/category.php */