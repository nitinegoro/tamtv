<div class="row">
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-gray">
			<div class="inner"> <h3><?php echo $this->cpost->count_all(); ?></h3> <p>Berita</p> </div>
			<div class="icon"> <i class="fa fa-pencil"></i> </div>
			<a href="<?php echo base_url("administrator/post"); ?>" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-gray">
			<div class="inner"> <h3><?php echo $this->db->count_all('comments'); ?></h3> <p>Komentar</p> </div>
			<div class="icon"> <i class="fa fa-comments"></i> </div>
			<a href="<?php echo base_url("administrator/cm"); ?>" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-gray">
			<div class="inner"> <h3><?php echo $this->db->count_all('categories'); ?></h3> <p>Kategori</p> </div>
			<div class="icon"> <i class="fa fa-tags"></i> </div>
			<a href="<?php echo base_url("administrator/post_category"); ?>" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-gray">
			<div class="inner"> <h3><?php echo $this->db->count_all('users'); ?></h3> <p>Pengguna</p> </div>
			<div class="icon"> <i class="fa fa-users"></i> </div>
			<a href="<?php echo base_url("administrator/users"); ?>" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="box box-default">
			<div class="box-header with-border">
				<strong class="box-heading">Youtube Live Streaming</strong>
			</div>
			<div class="box-body">
				<form id="save-streaming" method="post">
				<div class="col-md-10">
					<input type="text" name="live" class="form-control" placeholder="Masukkan URL youtube" value="<?php echo $this->options->get('live-streaming') ?>">
				</div>
				<div class="col-md-2">
					<button type="submit" id="saveStreaming" class="btn btn-primary">Simpan</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>