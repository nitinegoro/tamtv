<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Headline News
 *
 * Displays all of the Content- Videos right element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$box = $this->themes->get('box-video-index');

$value = json_decode($box->meta_value);

if( $this->posts->get_type('video', 4, 0, 'result') ) :
?>
<section class="box-video-index">
	<div class="block-box">
		<h3 class="featured-heading"> 
			<?php echo $box->meta_name ?> 
			<a href="<?php echo base_url("video"); ?>" class="btn btn-read-all pull-right">Lihat Semua ..</a>
		</h3> 
		<div class="line"></div>
	</div>
	<?php foreach( $this->posts->get_type('video', 1, 0, 'result') as $row) : ?>
	<div class="box-vidio-one">
		<div class="cover-vidio">
			<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>">
				<img src="<?php echo $this->posts->get_thumbnail($row->image, 'small'); ?>" alt="<?php echo $row->post_title; ?>" class="img-reponsive">
			</a>
			<div class="video-icon">
				<img src="<?php echo base_url("public/image/site/video-icon.png") ?>" alt="<?php echo $row->post_title; ?>">
			</div>
		</div>
		<div class="video-title">
			<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>"><?php echo $row->post_title; ?></a>
			<p><?php echo ($row->post_excerpt != '') ? strip_tags($row->post_excerpt) : strip_tags(word_limiter($row->post_content, 20)) ?></p>
		</div>
	</div>
	<?php endforeach ?>
	<div class="clearfix"></div>
	<div class="box-video-thumbnail">
		<div class="video-thumbnail">
			<?php 
			foreach( $this->posts->get_type('video', --$value->limit, 1, 'result') as $key => $row) : 
				if( $key % 4 == 0)
					echo '<div class="clearfix bottom2x"></div>';
			?>
			<div class="video-item">
				<div class="video-cover">
					<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>">
						<img src="<?php echo $this->posts->get_thumbnail($row->image, 'x-small'); ?>" alt="<?php echo $row->post_title; ?>" height="90">
					</a>
					<div class="video-icon">
						<img src="<?php echo base_url("public/image/site/video-icon.png") ?>" alt="<?php echo $row->post_title; ?>">
					</div>
				</div>
				<div class="video-title">
					<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>"><?php echo $row->post_title; ?></a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php
endif;
/* End of file box-video-index.php */
/* Location: ./application/views/box-elements/box-video-index.php */