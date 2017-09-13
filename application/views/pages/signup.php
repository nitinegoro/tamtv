<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the signup page
 *
 * Displays all of the signup element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
?>
	<div class="container content-wrapper">
		<div class="col-xs-6 col-md-offset-3">
			<form action="<?php echo current_url(); ?>" method="post">
			<div class="box-login text-center">
				<h1>Daftar</h1>
 				<p>Gunakan akun media sosial Anda untuk mendaftar.</p>
				<div class="btn-social">
					<a href="" class="btn btn-primary btn-social login-facebook">
						<i class="fa fa-facebook"></i> Facebook
					</a>
					<a href="<?php echo base_url("api/google/log_google?back-to=".current_url()) ?>" class="btn btn-danger btn-social login-google">
						<i class="fa fa-google-plus"></i> Google
					</a>
				</div>
				<p>Atau miliki akun dengan mendaftarkan email Anda.</p>
				<div class="col-md-12 text-left">
					<div class="form-group">
						<?php echo $this->session->flashdata('alert'); ?>
					</div>
					<div class="form-group">
						<label>Nama Lengkap :</label>
						<input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>" class="form-control" placeholder="Masukkan Nama Lengkap anda ...">
						<p class="help-block"><?php echo form_error('fullname', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label>Username :</label>
						<input type="text" name="username" value="<?php echo set_value('username'); ?>" id="not-space" class="form-control" placeholder="Tentukan username yang akan digunakan ...">
						<p class="help-block"><?php echo form_error('username', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label>E-Mail :</label>
						<input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Masukkan E-Mail anda ...">
						<p class="help-block"><?php echo form_error('email', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label>Password : </label>
						<input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Tentukan password yang akan digunakan ...">
						<p class="help-block"><?php echo form_error('password', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox" value="setuju" name="condition">
								Dengan mendaftar, Anda telah setuju dengan syarat dan ketentuan yang berlaku
							</label>
							<p class="help-block"><?php echo form_error('condition', '<small class="text-primary">', '</small>'); ?></p>
						</div>
						<button type="submit" class="btn btn-block btn-primary">Daftar</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
<?php
/* End of file signup.php */
/* Location: ./application/views/pages/signup.php */