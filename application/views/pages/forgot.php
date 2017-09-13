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
				<h1>Lupa Password?</h1>
				<p>Masukkan email yang pernah Anda daftarkan untuk mendapatkan tautan pengubah password.</p>
				<div class="col-md-12 text-left">
					<div class="form-group">
						<?php echo $this->session->flashdata('alert'); ?>
					</div>
					<div class="form-group">
						<label>E-Mail :</label>
						<input type="email" name="email" id="not-space" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Masukkan E-Mail ...">
						<p class="help-block"><?php echo form_error('email', '<small class="text-danger">', '</small>'); ?></p>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-block btn-primary">Ubah Password</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
<?php
/* End of file forgot.php */
/* Location: ./application/views/pages/forgot.php */