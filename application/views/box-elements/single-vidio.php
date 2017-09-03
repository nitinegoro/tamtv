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


$inputTags = array_map(function ($object) { 
		return $object->tag_id; 
	}, 
	$this->posts->get_post_tags($post->ID)
);

$tags = implode(', ', $inputTags);

?>
<div class="container-fluid mode-vidio">
	<div class="container-fluid">
		<div class="col-xs-2">

		</div>
		<div class="col-xs-8 col-md-8 col-lg-8">
			<!-- <h1 class="live-title"><?php echo $post->post_title ?></h1> -->
			<iframe width="100%" height="550" src="https://www.youtube.com/embed/<?php echo $this->posts->getmeta('video', $post->ID) ?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
			<div class="col-md-8 text-white">
				<p><?php echo $post->post_excerpt ?></p>
			</div>
			<div class="col-md-4 pull-right">
				<div class="sharethis-inline-share-buttons" style="margin-top: 20px;"></div>
			</div>
		</div>
		<div class="col-xs-2">

		</div>
	</div>
</div>
<style>
	.ads-left, .ads-right {
		top:130px !important;
	} 
</style>