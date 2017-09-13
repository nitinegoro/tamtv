<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login Mobile Template
 *
 *
 * @package Codeigniter
 * @subpackage Tamtv Template
 * @since Tamtv 1.0
 */

$this->load->view('mobile/header', $this->data);
?>
<div class="start"></div>
<div class="container-fluid">
	<div class="box-login">
		<h1>Daftar</h1>
		<div class="btn-social">
			<p>Gunakan akun media sosial Anda untuk dapat mengakses seluruh fitur.</p>
			<button type="button" class="btn btn-primary btn-social facebook login-facebook">
				<i class="fa fa-facebook"></i> Facebook
			</button>
 			<a href="<?php echo base_url("api/google/log_google?back-to=".current_url()) ?>" class="btn google btn-danger btn-social ">
				<i class="fa fa-google-plus"></i> Google
			</a>
			<p>Atau miliki akun dengan mendaftarkan email Anda.</p>
		</div>
		<?php echo $this->session->flashdata('alert'); ?>
		<form class="form-login" method="post">
			<div class="form-group">
				<input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>" class="form-control" placeholder="Nama Lengkap">
				<p class="help-block"><?php echo form_error('fullname', '<small class="text-danger">', '</small>'); ?></p>
			</div>
			<div class="form-group">
				<input type="text" name="username" value="<?php echo set_value('username'); ?>" id="not-space" class="form-control" placeholder="Username">
				<p class="help-block"><?php echo form_error('username', '<small class="text-danger">', '</small>'); ?></p>
			</div>
			<div class="form-group">
				<input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="E-Mail">
				<p class="help-block"><?php echo form_error('email', '<small class="text-danger">', '</small>'); ?></p>
			</div>
			<div class="form-group">
				<input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Kata Sandi">
				<p class="help-block"><?php echo form_error('password', '<small class="text-danger">', '</small>'); ?></p>
			</div>
			<div class="form-group">
				<span>
					<input type="checkbox" value="setuju" name="condition">
						Dengan mendaftar, Anda telah setuju dengan syarat dan ketentuan yang berlaku
				</span>
				<p class="help-block"><?php echo form_error('condition', '<small class="text-primary">', '</small>'); ?></p>

			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-tamtv btn-block">Daftar</button>
			</div>
			<div class="form-group text-center">
				<p>Sudah Punya Akun? Masuk <a href="<?php echo base_url("login"); ?>">Disini</a></p>
			</div>
		</form>
	</div>
</div>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file login.php */
/* Location: ./application/views/mobile/login.php */