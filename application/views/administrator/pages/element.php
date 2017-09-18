<div class="row">
	<?php echo form_open(current_url()); ?>
	<div class="col-md-3">
		<?php echo $this->session->flashdata('alert'); ?>
		<legend>Pilih Tata Letak</legend>
		<div class="form-group">
			<select name="layout" class="form-control">
			<?php foreach($this->themes->get_all_layout() as $row) : ?>
				<option value="<?php echo $row->layout; ?>"><?php echo @$this->themes->layout_aliases[$row->layout]; ?></option>
			<?php endforeach; ?>
			</select>
			<p class="help-block"><small><i>Silahkan pilih jenis tata letak yang akan diatur.</i></small></p>
		</div>

	</div>
</div>