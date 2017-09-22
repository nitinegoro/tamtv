<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Box elements trending tags
 *
 **/

$box = $this->themes->get('category-two', 'sidebar-live');

$json = json_decode($box->meta_value);

echo form_hidden('elements[]', 'category-two');
?>		
<div class="box-header with-border"> Berita Kategori </div>
<div class="box-body">
	<div class="form-group">
		<label for="category-two[name]" class="control-label col-md-3 col-xs-12">Nama Element : </label>
		<div class="col-md-8 bottom2x">
			<input type="text" name="category-two[name]" class="form-control" value="<?php echo $box->meta_name; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3">Kategori Berita : </label>
		<div class="col-md-8 bottom2x">
			<select name="category-two[json][category]" class="form-control" required="required">
				<?php foreach( $this->category->getall() as $row)    
				{
					$selected = ($json->category== $row->category_id) ? 'selected' : '';
					echo '<option value="'.$row->category_id.'" '.$selected.'>'.$row->name.'</option>';
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group ">
		<label class="control-label col-md-3">Jumlah Berita : </label>
		<div class="col-md-3">
			<select name="category-two[json][limit]" id="input" class="form-control" required="required">
			<?php for( $number = 3; $number <=10; $number++ ) : ?>
				<option value="<?php echo $number; ?>" <?php if( $number==$json->limit) echo 'selected'; ?>><?php echo $number; ?></option>
			<?php endfor; ?>
			</select>
		</div>
		<label for="fullname" class="control-label col-md-2">Status : </label>
		<div class="col-md-3 bottom2x">
			<select name="category-two[status]" id="input" class="form-control" required="required">
				<option value="yes" <?php if( $box->status == 'yes') echo 'selected'; ?>>AKTIF</option>
				<option value="no" <?php if( $box->status == 'no') echo 'selected'; ?>>NON AKTIF</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="fullname" class="control-label col-md-3">Fixed Scroll : </label>
		<div class="col-md-3">
			<select name="category-two[json][sticky]" class="form-control" required="required">
				<option value="yes" <?php if( $json->sticky == 'yes') echo 'selected'; ?>>AKTIF</option>
				<option value="no" <?php if( $json->sticky == 'no') echo 'selected'; ?>>NON AKTIF</option>
			</select>
		</div>
	</div>
</div>