<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the account profile page
 *
 * Displays all of the account profile element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
?>
	<div class="container content-wrapper">
		<section class="col-md-3">
			<div id="sticker" class="box-sidebar top3x">
				<?php  
				/**
				 * Load Sidebar user
				 *
				 **/
				$this->load->view('box-elements/box-user-sidebar', $this->data);
				?>
			</div>
		</section>
		
		<div class="col-xs-9 tag-content top3x">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-comments-o fa-2x"></i> Komentar Terakhir
					</div>
					<div class="panel-body">
					<?php  
					/**
					 * Loop lates your comments
					 *
					 * @param Integer (limit)
					 * @param Integer (Offset)
					 **/
					foreach( $this->comment->get_user_comments($this->per_page,  $this->page) as $row) :
						$dateClass = new DateTime($row->comment_date);
					?>
						<div class="media">
							<div class="media-body">
								<a href="<?php echo $this->posts->permalink($row->comment_post_ID) ?>" title="<?php echo $row->post_title; ?>" class="media-heading">
									<?php echo $row->post_title; ?>
								</a> <br>
								<time itemprop="datePublished"><?php echo $dateClass->format('D, j F Y - g:i A'); ?></time>
								<?php  
									echo anchor(base_url("main/delete_comment/{$row->comment_id}?backTo=".current_url()), '<i class="fa fa-trash-o"></i> Hapus', array('class' => 'text-danger menu-comment'));
								?>
								<p><?php echo $row->comment_content ?></p>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
				<div class="col-md-12 text-center">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</div>
<?php
/* End of file account.php */
/* Location: ./application/views/pages/account.php */