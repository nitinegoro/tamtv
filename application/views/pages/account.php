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
				<div class="box-account">
					<div class="account-avatar text-center">
						<img class="img-circle" src="<?php echo base_url("public/image/avatar/author.png"); ?>" alt="avatar " width="100">
					</div>
					<div class="account-info">
						<h1>Vicky Nitinegoro <br><small>@sira898</small></h1>
					</div>
				</div>
				<ul class="menu-account">
					<li><a href="">Profil Saya</a></li>
					<li><a href="">Ganti Password</a></li>
					<li><a href="">Logout</a></li>
				</ul>
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
					 **/
					
					?>
						<div class="media">
							<div class="media-body">
								<a href="" class="media-heading">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, quaerat.</a> <br>
								<time itemprop="datePublished"><?php echo date('D, j F Y - g:i A'); ?></time>
								<a href="" class="menu-comment text-danger"><i class="fa fa-trash-o"></i> Hapus</a>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, ducimus.</p>
							</div>
						</div>
						<div class="media">
							<div class="media-body">
								<a href="" class="media-heading">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, harum.</a> <br>
								<time itemprop="datePublished"><?php echo date('D, j F Y - g:i A'); ?></time>
								<a href="" class="menu-comment text-danger"><i class="fa fa-trash-o"></i> Hapus</a>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, ducimus.</p>
							</div>
						</div>
					<?php  ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
/* End of file account.php */
/* Location: ./application/views/pages/account.php */