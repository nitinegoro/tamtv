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
echo form_open(base_url("administrator/setting/set_socialmedia"), array('class' => 'form-horizontal'));
?>
			<div class="box-body" style="margin-top: 10px;">
			<?php  
			foreach( $this->options->result('socialmedia') as $row) :

				$social = json_decode($row->option_value);

				echo form_hidden("social[{$row->option_id}][media]", $social->media);
			?>
				<div class="form-group">
					<label class="control-label col-md-3 col-xs-12"><?php echo ucfirst($social->media); ?> : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="url" name="social[<?php echo $row->option_id ?>][url]" class="form-control" value="<?php echo $social->url; ?>">
					</div>
				</div>
			<?php  
			endforeach;
			?>
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