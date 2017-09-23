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
echo form_open(base_url("administrator/setting/set_general"), array('class' => 'form-horizontal'));
?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label class="control-label col-md-3 col-xs-12">Judul Website : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="options[sitename]" class="form-control" value="<?php echo $this->options->get('sitename'); ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="control-label col-md-3 col-xs-12">Deskripsi Website : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<textarea name="options[sitedescription]" class="form-control" rows="4"><?php echo $this->options->get('sitedescription'); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-xs-12">Format Tanggal : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="options[date_format]" class="form-control">
							<option value="d/m/Y" <?php if($this->options->get('date_format')=='d/m/Y') echo 'selected'; ?>><?php echo date('d/m/Y') ?></option>
							<option value="D, j F Y" <?php if($this->options->get('date_format')=='D, j F Y') echo 'selected'; ?>><?php echo date('D, j F Y') ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-xs-12">Format Waktu : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="options[time_format]" class="form-control">
							<option value="h:i:s" <?php if($this->options->get('time_format')=='h:i:s') echo 'selected'; ?>><?php echo date('h:i:s'); ?></option>
							<option value="h:i A" <?php if($this->options->get('time_format')=='h:i A') echo 'selected'; ?>><?php echo date('h:i A'); ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-xs-12">Permalink : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="options[permalink]" id="inputRole" class="form-control">
							<option value="slug" <?php if($this->options->get('permalink')=='slug') echo 'selected'; ?>>
								<?php echo base_url("contoh-permalink-judul-berita") ?>
							</option>
							<option value="date" <?php if($this->options->get('permalink')=='date') echo 'selected'; ?>>
								<?php echo base_url(date("Y/m/d")."/contoh-permalink-judul-berita") ?>
							</option>
							<option value="month" <?php if($this->options->get('permalink')=='month') echo 'selected'; ?>>
								<?php echo base_url(date("Y/m")."/contoh-permalink-judul-berita") ?>
							</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="options[comment_auto_approved]" class="control-label col-md-3 col-xs-12">Terima Komentar Secara Otomatis : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="" class="form-control">
							<option value="yes" <?php if($this->options->get('comment_auto_approved')=='yes') echo 'selected'; ?>>AKTIF</option>
							<option value="no" <?php if($this->options->get('comment_auto_approved')=='no') echo 'selected'; ?>>TIDAK</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-md-3 col-xs-12">Mode Streaming : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="options[live-mode]" class="form-control">
							<option value="enable" <?php if($this->options->get('live-mode')=='enable') echo 'selected'; ?>>AKTIF</option>
							<option value="disable" <?php if($this->options->get('live-mode')=='disable') echo 'selected'; ?>>TIDAK</option>
						</select>
					</div>
				</div>
			</div>
			<div class="box-footer with-border">
				<div class="col-md-9 col-xs-6">
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