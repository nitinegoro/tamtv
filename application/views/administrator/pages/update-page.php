<div class="row">
	<?php echo form_open_multipart(current_url()); ?>
	<div class="col-md-10">
		<div class="form-group">
			<div class="col-md-10 col-md-offset-2">
				<?php echo $this->session->flashdata('alert'); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2">Judul</label>
				<div class="col-md-10">
				<input type="text" name="judul" class="form-control" value="<?php echo (set_value('judul')) ? set_value('judul') : $page->post_title; ?>" placeholder="Masukkan Judul Disini ..." autofocus>
				<p class="help-block"><?php echo form_error('judul', '<small class="text-red">', '</small>'); ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2">Slug</label>
			<div class="col-md-10">
				<input type="text" name="slug" class="form-control" value="<?php echo (set_value('slug')) ? set_value('slug') : $page->post_slug; ?>">
				<p class="help-block"><?php echo form_error('slug', '<small class="text-red">', '</small>'); ?></p>
				<p class="help-block"><small><i>"Slug" ialah versi ramah-URL dari nama. Biasanya seluruhnya merupakan huruf kecil dan hanya mengandung huruf, angka, dan tanda strip.</i></small></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2">Isi Halaman</label>
			<div class="col-md-10 col-md-offset-2">
				<textarea name="content" rows="20" class="tinymce"><?php echo (set_value('content')) ? set_value('content') : $page->post_content; ?></textarea>
				<p class="help-block"><?php echo form_error('content', '<small class="text-red">', '</small>'); ?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-4 top2x">
				<a href="<?php echo base_url("administrator/pages"); ?>" class="btn btn-app bg-red"><i class="fa fa-times"></i> Batal</a>
				<button class="btn btn-app bg-blue pull-right"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>
