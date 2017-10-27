<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Headline News
 *
 * Displays all of the headline News right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$box = $this->themes->get('recomended-slider');

$value = json_decode($box->meta_value);
?>
<div class="clearfix"></div>
<div class="box-thumbnail">
	<div class="block-box">
		<h3 class="featured-heading"> 
			<?php echo $box->meta_name ?> 
			<a href="<?php echo base_url("rekomendasi"); ?>" class="btn btn-read-all pull-right">Lihat Semua ..</a>
		</h3> 
		<div class="line"></div>
	</div>
	<div class="owl-carousel owl-theme owl-loaded">
	<?php  
	/**
	 * Get Post By Type
	 *
	 * @param String (post_type)
	 * @param Integer (limit)
	 * @param Integer (offset)
	 **/
	foreach( $this->posts->get_type('recomended', $value->limit, 1, 'result') as $post) :
	?>
	<div class="box-category-1">
		<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
			<img src="<?php echo $this->posts->get_thumbnail($post->image, 'small'); ?>" alt="<?php echo $post->post_title; ?>" class="img-responsive">
		</a>
		<div class="item-featured">
			<h4 class="item-heading">
				<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
					<?php echo $post->post_title; ?>
				</a>
			</h4>
		</div>
	</div>
	<?php endforeach; ?>
	    <div class="owl-controls"></div>
	</div>
</div>
<div class="clearfix"></div>
<?php
/* End of file headline-slider.php */
/* Location: ./application/views/box-elements/headline-slider.php */
?>
