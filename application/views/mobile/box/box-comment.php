<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the Comments Box
 *
 * Displays all of the Comments Box element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
$author = $this->posts->get_post_author($post->ID);
?>
<section class="box-comments padding" name="#comment-list">
	<h3 class="featured-heading padding"> Komentar </h3>
	<section class="comment-list">
		<?php  
		/**
		 * Loop Comment post list
		 *
		 * @param Integer (post ID)
		 * @param Integer (limit)
		 **/
		foreach( $this->comment->get_post_comments($post->ID, 10) as $row) :
			$dateClass = new DateTime($row->comment_date);
		?>
		<div class="media">
			<div class="media-left media-middle">
			<?php if( $row->avatar == FALSE) : ?>
				<img class="media-object img-circle" src="<?php echo base_url("public/image/avatar/author.png"); ?>" alt="avatar " width="40">
			<?php else : ?>
				<img class="media-object img-circle" src="<?php echo $row->avatar; ?>" alt="avatar " width="40">
			<?php endif; ?>
			</div>
			<div class="media-body">
				<strong class="media-heading"><?php echo $row->fullname; ?></strong>
				<time itemprop="datePublished"><?php echo $dateClass->format('D, j F Y - g:i A'); ?></time>
				<p><?php echo $row->comment_content; ?></p>
			</div>
		</div>
		<?php  
		/**
		 * Loop Child Comment post list
		 *
		 * @param Integer (post ID)
		 * @param Integer (limit)
		 **/
		foreach( $this->comment->get_post_child_comments($row->comment_id, 10) as $child) :
			$datechildClass = new DateTime($child->comment_date);
		?>
		<div class="media left" style="margin-bottom: 20px;">
			<div class="media-left media-middle">
			<?php if( $child->avatar == FALSE) : ?>
				<img class="media-object img-circle" src="<?php echo base_url("public/image/avatar/author.png"); ?>" alt="avatar " width="40">
			<?php else : ?>
				<img class="media-object img-circle" src="<?php echo $child->avatar; ?>" alt="avatar " width="40">
			<?php endif; ?>
			</div>
			<div class="media-body">
				<strong class="media-heading"><?php echo $child->fullname; ?></strong>
				<time itemprop="datePublished"><?php echo $datechildClass->format('D, j F Y - g:i A'); ?></time>
				<p><?php echo $child->comment_content; ?></p>
			</div>
		</div>
	<?php 
	endforeach; 
	endforeach;
	?>
	</section>
	<form action="<?php echo base_url("comments/submit?parent={$this->input->get('parent')}") ?>" method="post">
		<?php if($this->user_login) : 
		echo form_hidden('post', $post->ID);
		echo form_hidden('backTo', current_url());
		?>
		<div class="form-group">
			<textarea name="comment" class="input" rows="2" placeholder="Tuliskan Komentar anda ..."></textarea>
		</div>
		<button type="submit" class="btn btn-block btn-primary"> <i class="fa fa-comments"></i> Tulis Komentar</button>
		<?php else : ?>
		<a href="<?php echo base_url("login?back-to=".current_url()) ?>" class="btn btn-block btn-primary"> 
			<i class="fa fa-comments"></i> Login untuk menulis komentar!
		</a>
		<?php endif; ?>
	</form>
</section>
<div class="clearfix"></div>
<?php
/* End of file comments.php */
/* Location: ./application/views/box-elements/comments.php */