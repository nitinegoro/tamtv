<div class="row">
	<?php echo form_open(current_url()); ?>
	<div class="col-md-3">
		<?php echo $this->session->flashdata('alert'); ?>
		<div class="sticker">
		<legend>Pilih Tata Letak</legend>
		<div class="form-group">
			<select name="layout" class="form-control" onchange="return location.href = '<?php echo base_url("administrator/theme?layout=") ?>' + $(this).val();">
				<option value="">-- PILIH --</option>
			<?php foreach($this->themes->get_all_layout() as $row) : ?>
				<option value="<?php echo $row->layout; ?>" <?php if($this->layout==$row->layout)echo 'selected'; ?>><?php echo @$this->themes->layout_aliases[$row->layout]; ?></option>
			<?php endforeach; ?>
			</select>
			<p class="help-block"><small><i>Silahkan pilih jenis tata letak yang akan diatur.</i></small></p>
		</div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<div class="col-md-9">
		<?php echo form_open(base_url("administrator/theme/update/{$this->layout}")); ?>
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h4 class="box-heading"><?php echo @$this->themes->layout_aliases[$this->layout]; ?></h4>
				</div>
				<?php 
				/**
				  * Form-form Elements
				  *
				  * @return Including Html Form
				  **/ 
				foreach($this->themes->layout_admin( $this->layout ) as $row) :
					/**
					 * undocumented class variable
					 *
					 * @var string
					 **/
					$this->load->view('administrator/pages/elements/'.$this->layout.'/'.$row->meta_key);
				endforeach;
				?>
				<div class="box-footer with-border">
					<div class="col-md-3 pull-right">
						<button type="submit" class="btn btn-app bg-blue"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>