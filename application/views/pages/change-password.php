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
				<form action="<?php echo current_url(); ?>" method="POST" role="form">
					<legend>Ganti Password</legend>
					<div class="form-group">
						<?php echo $this->session->flashdata('alert'); ?>
					</div>
					<div class="form-group">
						<label for="">Nama Lengkap :</label>
						<input type="text" name="fullname" class="form-control" value="<?php echo (set_value('fullname')) ? set_value('fullname') : $account->fullname; ?>">
						<p class="help-block"><?php echo form_error('fullname', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label for="">Username :</label>
						<input type="text" name="username" class="form-control" value="<?php echo (set_value('username')) ? set_value('username') : $account->username; ?>">
						<p class="help-block"><?php echo form_error('username', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label for="">E-Mail :</label>
						<input type="email" name="email" value="<?php echo (set_value('email')) ? set_value('email') : $account->email ?>" class="form-control">
						<p class="help-block"><?php echo form_error('email', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label for="">Password Baru :</label>
						<input type="password" name="newpassword" value="<?php echo set_value('newpassword'); ?>" class="form-control" placeholder="Masukkan password baru anda ...">
						<p class="help-block"><?php echo form_error('newpassword', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label for="">Ulangi Password Baru :</label>
						<input type="password" name="repeatpassword" value="<?php echo set_value('repeatpassword'); ?>" class="form-control" placeholder="Ulangi ...">
						<p class="help-block"><?php echo form_error('repeatpassword', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label for="">Password Lama :</label>
						<input type="password" name="oldpassword" value="<?php echo set_value('oldpassword'); ?>" class="form-control" placeholder="Masukkan password lama anda ...">
						<p class="help-block"><?php echo form_error('oldpassword', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
				</form>
			</div>
		</div>
	</div>
<?php
/* End of file change-password.php */
/* Location: ./application/views/pages/change-password.php */