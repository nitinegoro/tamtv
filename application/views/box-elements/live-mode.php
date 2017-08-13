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
<div class="container-fluid mode-vidio">
	<div class="container-fluid">
		<div class="col-xs-2">
			<?php  
			/**
			 * Get Post By Type Vidio
			 *
			 * @param String (post_type)
			 * @param Integer (limit)
			 * @param Integer (offset)
			 **/
			foreach( $this->posts->get_type('vidio', 4, 0, 'results') as $row) :
			?>
			<div class="item-vidio">
				<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>">
					<img src="<?php echo $this->posts->get_thumbnail($row->image, 'small'); ?>" alt="<?php echo $row->post_title; ?>" class="img-responsive">
				</a>
				<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>">
					<h2 class="item-vidio-title"><?php echo $row->post_title; ?></h2>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="col-xs-8 col-md-8 col-lg-8">
			<iframe width="100%" height="550" src="https://www.youtube.com/embed/9zsOo1yvgzI?autoplay=1" frameborder="0" allowfullscreen></iframe>
			<div class="col-md-8">
				<h1 class="live-title">LIVE STREAMING</h1>
			</div>
			<div class="col-md-4 pull-right">
				<div class="sharethis-inline-share-buttons" style="margin-top: 20px;"></div>
			</div>
		</div>
		<div class="col-xs-2">
			<?php  
			/**
			 * Get Post By Type Vidio
			 *
			 * @param String (post_type)
			 * @param Integer (limit)
			 * @param Integer (offset)
			 **/
			foreach( $this->posts->get_type('vidio', 4, 4, 'results') as $row) :
			?>
			<div class="item-vidio">
				<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>">
					<img src="<?php echo $this->posts->get_thumbnail($row->image, 'small'); ?>" alt="<?php echo $row->post_title; ?>" class="img-responsive">
				</a>
				<a href="<?php echo $this->posts->permalink($row->ID) ?>" title="<?php echo $row->post_title; ?>">
					<h2 class="item-vidio-title"><?php echo $row->post_title; ?></h2>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>