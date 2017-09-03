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
		<h3 class="featured-heading"> <?php echo $box->meta_name ?> </h3> 
		<div class="line"></div>
	</div>
	<?php foreach( $this->posts->get_type('photo', 1, 0, 'result') as $post) : ?>
	<div class="left-foto">
		<div class="foto-icon">
			<img src="<?php echo base_url("public/image/site/foto-icon.png"); ?>" alt="<?php echo $post->post_title; ?>" width="12" height="12">
		</div>
		<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>">
			<img alt="<?php echo $post->post_title; ?>" src="<?php echo $this->posts->get_thumbnail($post->image); ?>">
		</a>
		<div class="text-foto">
            <h2 class="title">
            	<a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>"> <?php echo $post->post_title; ?> </a>
            </h2>
        </div>
	</div>
	<?php  
	endforeach;
	?>
	<div class="right-foto">
		<ul class="foto-other">
			<?php foreach( $this->posts->get_type('photo', 2, 1, 'result') as $post) : ?>
			<li>
                <div class="cover-foto">
                    <div class="foto-icon">
                    	<img src="<?php echo base_url("public/image/site/foto-icon.png"); ?>" alt="<?php echo $post->post_title; ?>"  width="12" height="12">
                    </div>
                    <a href="<?php echo $post->post_title; ?>" title="<?php echo $post->post_title; ?>">
                    	<img alt="<?php echo $post->post_title; ?>" src="<?php echo $this->posts->get_thumbnail($post->image, 'x-small'); ?>">
                    </a>
                </div>
                <h2 class="title">
                   <a href="<?php echo $this->posts->permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a>
                </h2>
            </li>
        	<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php
endif;
/* End of file box-thumbnail-foto.php */
/* Location: ./application/views/box-elements/box-thumbnail-foto.php */