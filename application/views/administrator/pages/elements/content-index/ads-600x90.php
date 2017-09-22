<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Box elements trending tags
 *
 **/

$box = $this->themes->get('ads-600x90', 'content-index');

echo form_hidden('elements[]', 'ads-600x90');
?>		
<div class="box-header with-border"> Iklan 600x90 Pixel</div>
<div class="box-body">
	<div class="form-group">
		<label for="ads-600x90[name]" class="control-label col-md-3 col-xs-12">Element : </label>
		<div class="col-md-8 bottom2x">
			<textarea name="ads-600x90[iklan]" rows="5" placeholder="Masukkan Kode Javascript Google Adsense..." class="form-control"><?php echo $box->meta_value ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="fullname" class="control-label col-md-3">Status : </label>
		<div class="col-md-3">
			<select name="ads-600x90[status]" id="input" class="form-control" required="required">
				<option value="yes" <?php if( $box->status == 'yes') echo 'selected'; ?>>AKTIF</option>
				<option value="no" <?php if( $box->status == 'no') echo 'selected'; ?>>NON AKTIF</option>
			</select>
		</div>
	</div>
</div>