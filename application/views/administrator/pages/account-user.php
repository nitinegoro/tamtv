<div class="row">
	<div class="col-md-6 col-md-offset-3 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-8 col-md-offset-2 col-xs-12">
		<div class="box box-default">
<?php  
/**
 * Open Form
 *
 * @var string
 **/
echo form_open(current_url(), array('class' => 'form-horizontal'));

?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label for="fullname" class="control-label col-md-3 col-xs-12">Nama Lengkap : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="fullname" class="form-control" value="<?php echo (set_value('fullname')) ? set_value('fullname') : $user->fullname; ?>">
						<p class="help-block"><?php echo form_error('fullname', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="control-label col-md-3 col-xs-12">Username : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="username" class="form-control" value="<?php echo (set_value('username')) ? set_value('username') : $user->username; ?>">
						<p class="help-block"><?php echo form_error('username', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-3 col-xs-12">E-Mail : <strong class="text-primary">*</strong></label>
					<div class="col-md-8">
						<input type="email" name="email" class="form-control" value="<?php echo (set_value('email')) ? set_value('email') : $user->email; ?>">
						<p class="help-block"><?php echo form_error('email', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-md-3 col-xs-12">Password Baru : <strong class="text-primary">*</strong></label>
					<div class="col-md-8">
						<input type="password" name="newpassword" class="form-control" value="<?php echo set_value('newpassword'); ?>">
						<p class="help-block"><?php echo form_error('newpassword', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-md-3 col-xs-12">Ulangi Password baru : <strong class="text-primary">*</strong></label>
					<div class="col-md-8">
						<input type="password" name="repeatpassword" class="form-control" value="<?php echo set_value('repeatpassword'); ?>">
						<p class="help-block"><?php echo form_error('repeatpassword', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="control-label col-md-3 col-xs-12">Peran : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="role" id="inputRole" class="form-control">
							<option value="">-- Pilih peran --</option>
							<option value="administrator" <?php if($user->user_type =='administrator') echo 'selected'; ?>>Administrator</option>
							<option value="writer" <?php if($user->user_type =='writer') echo 'selected'; ?>>Penulis</option>
							<option value="reader" <?php if($user->user_type =='reader') echo 'selected'; ?>>Pembaca</option>
						</select>
						<p class="help-block"><?php echo form_error('role', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="oldpassword" class="control-label col-md-3 col-xs-12">Password : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="password" name="oldpassword" class="form-control" value="<?php echo set_value('oldpassword'); ?>">
						<p class="help-block"><?php echo form_error('oldpassword', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>
			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('administrator/users') ?>" class="btn btn-app pull-right">
						<i class="fa fa-reply"></i> Kembali
					</a>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-app pull-right">
						<i class="fa fa-save"></i> Simpan
					</button>
				</div>
			</div>
			<div class="box-footer with-border">
					<small><strong class="text-red">*</strong>	Field wajib diisi!</small> <br>
					<small><strong class="text-blue">*</strong>	Field Optional</small>
			</div>
<?php  
// End Form
echo form_close();
?>
		</div>
	</div>
</div>