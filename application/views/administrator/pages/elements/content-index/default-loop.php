<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Box elements trending tags
 *
 **/

$box = $this->themes->get('default-loop');

$json = json_decode($box->meta_value);

echo form_hidden('elements[]', 'default-loop');
?>		
<div class="box-header with-border">Berita Terbaru</div>
<div class="box-body">
	<div class="form-group">
		<label for="default-loop[name]" class="control-label col-md-3 col-xs-12">Nama Element : </label>
		<div class="col-md-8 bottom2x">
			<input type="text" name="default-loop[name]" class="form-control" value="<?php echo $box->meta_name; ?>">
		</div>
	</div>
	<div class="form-group ">
		<label class="control-label col-md-3">Jumlah Berita : </label>
		<div class="col-md-3">
			<select name="default-loop[json][limit]" id="input" class="form-control" required="required">
			<?php 
			$number = 3;
			while( $number <= 15  ) : ?>
				<option value="<?php echo $number; ?>" <?php if( $number==$json->limit) echo 'selected'; ?>><?php echo $number; ?></option>
			<?php 
			$number++;
			endwhile; ?>
			</select>
		</div>
		<label for="fullname" class="control-label col-md-2">Status : </label>
		<div class="col-md-3 bottom2x">
			<select name="default-loop[status]" id="input" class="form-control" required="required">
				<option value="yes" <?php if( $box->status == 'yes') echo 'selected'; ?>>AKTIF</option>
				<option value="no" <?php if( $box->status == 'no') echo 'selected'; ?>>NON AKTIF</option>
			</select>
		</div>
	</div>
</div>