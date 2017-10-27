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
$box = $this->themes->get('box-thumbnail-foto');

$value = json_decode($box->meta_value);

if( $this->posts->get_type('photo', 1, 0, 'result') ) :
?>
<section class="box-foto">
	<div class="block-box">
		<h3 class="featured-heading"> 
			<?php echo $box->meta_name ?> 
			<a href="<?php echo base_url("photo"); ?>" class="btn btn-read-all pull-right">Lihat Semua ..</a>
		</h3> 
		<div class="line"></div>
	</div>
	<div class="photo-galery">
		<?php foreach( $this->posts->get_type('photo', 1, 0, 'result') as $post) : ?>
		<div class="one-photo">
  			<img alt="<?php echo $post->post_title; ?>" src="<?php echo $this->posts->get_thumbnail($post->image); ?>" class="imagepone">
  			<a href="<?php echo $this->posts->permalink($post->ID) ?>#lg=1&slide=0" title="<?php echo $post->post_title; ?>"> <?php echo $post->post_title; ?></a>
  			<span class="camera-icon"><i class="fa fa-camera"></i> <?php echo count($this->posts->getphoto($post->ID)) ?> Foto</span>
  			<div class="one-overlay"> </div>
		</div>
		<?php
		endforeach;  
		foreach( $this->posts->get_type('photo', 5, 1, 'result') as $post) :
		?>
		<div class="photo">
  			<img alt="<?php echo $post->post_title; ?>" src="<?php echo $this->posts->get_thumbnail($post->image); ?>" class="imagepone">
  			<a href="<?php echo $this->posts->permalink($post->ID) ?>#lg=1&slide=0" title="<?php echo $post->post_title; ?>"> <?php echo $post->post_title; ?></a>
  			<span class="camera-icon"><i class="fa fa-camera"></i> <?php echo count($this->posts->getphoto($post->ID)) ?> Foto</span>
  			<div class="one-overlay"> </div>
		</div>
		<?php
		endforeach;
		?>
	</div>
</section>
<div class="clearfix"></div>
<?php
endif;
/* End of file box-thumbnail-foto.php */
/* Location: ./application/views/box-elements/box-thumbnail-foto.php */