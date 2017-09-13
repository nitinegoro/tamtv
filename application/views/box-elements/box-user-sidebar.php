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
				<div class="box-account">
					<div class="account-avatar text-center">
					<?php if( $this->session->userdata('user')->avatar != '') :  ?>
					<img class="img-circle" src="<?php echo $this->session->userdata('user')->avatar; ?>" alt="avatar " width="100">
					<?php else : ?>
						<img class="img-circle" src="<?php echo base_url("public/image/avatar/author.png"); ?>" alt="avatar " width="100">
					<?php endif; ?>
					</div>
					<div class="account-info">
						<h1><?php echo $this->session->userdata('user')->fullname ?> <br><small>@<?php echo $this->session->userdata('user')->username ?></small></h1>
					</div>
				</div>
				<ul class="menu-account">
	          		<li><a href="<?php echo base_url("me/{$this->session->userdata('user')->username}") ?>">Profil Saya</a></li>
	          		<li><a href="<?php echo base_url("me/change_password"); ?>">Ganti Password</a></li>
	          		<li><a href="<?php echo base_url("login/signout?back-to=".current_url()); ?>">Logout</a></li>
				</ul>
<?php
/* End of file box-user-sidebar.php */
/* Location: ./application/views/box-elements/box-user-sidebar.php */