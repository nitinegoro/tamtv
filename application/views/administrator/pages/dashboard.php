<div class="row">
	<div class="col-md-6">
		<div class="box box-default">
			<div class="box-header with-border">
				<strong class="box-heading">Youtube Live Streaming</strong>
			</div>
			<div class="box-body">
				<form id="save-streaming" method="post">
				<div class="col-md-10">
					<input type="text" class="form-control" placeholder="Masukkan URL youtube" value="<?php echo $this->options->get('live-streaming') ?>">
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>