<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for displaying the login page
 *
 * Displays all of the login element.
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @since Tamtv 1.0
 */
?>
	<div class="container content-wrapper">
		<!-- Single Content -->
		<div class="col-xs-6 col-md-offset-3">
			<form action="" method="post">
			<div class="box-login text-center">
				<h1>Masuk</h1>
				<p>Gunakan akun media sosial Anda untuk dapat mengakses seluruh fitur domain-ini.com.</p>
				<div class="btn-social">
					<a href="" class="btn btn-primary btn-social">
						<i class="fa fa-facebook"></i> Facebook
					</a>
					<a href="" class="btn btn-danger btn-social">
						<i class="fa fa-google-plus"></i> Google
					</a>
				</div>
				<p>Atau masuk dengan akun yang sudah ada :</p>
				<div class="col-md-12 text-left">
					<div class="form-group">
						<?php echo $this->session->flashdata('alert'); ?>
					</div>
					<div class="form-group">
						<label>Username / E-Mail :</label>
						<input type="text" name="username" id="not-space" value="<?php echo set_value('username'); ?>" class="form-control" placeholder="Masukkan E-Mail / Username anda ...">
						<p class="help-block"><?php echo form_error('username', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<label>Password : </label>
						<a href="" class="link pull-right">Lupa?</a>
						<input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Masukkan Paswird anda ...">
						<p class="help-block"><?php echo form_error('password', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-block btn-primary">Masuk</button>
					</div>
				</div>
				<p><a href="">Daftar Akun</a></p>
			</div>
			</form>
		</div>
	</div>
<?php
/* End of file login.php */
/* Location: ./application/views/pages/login.php */