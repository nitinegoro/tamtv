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
	<div class="box-login" style="min-height: 450px;">
		<h1>Lupa Password?</h1>
		<div class="btn-social">
			<p>Masukkan email yang pernah Anda daftarkan untuk mendapatkan tautan pengubah password.</p>
		</div>
		<?php echo $this->session->flashdata('alert'); ?>
		<form class="form-login" method="post">
			<div class="form-group">
				<label for="">E-Mail</label>
				<input type="text" name="email" value="<?php echo set_value('email'); ?>" id="not-space" class="form-control" placeholder="Username / Alamat">
				<p class="help-block"><?php echo form_error('email', '<small class="text-danger">', '</small>'); ?></p>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-tamtv btn-block">Ubah Password</button>
			</div>
			<div class="form-group text-center">
				<p><a href="<?php echo base_url("login"); ?>">Kembali login</a></p>
			</div>
		</form>
	</div>
</div>
<?php
$this->load->view('mobile/footer', $this->data);
/* End of file login.php */
/* Location: ./application/views/mobile/login.php */