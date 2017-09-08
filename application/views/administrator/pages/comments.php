<div class="row">
	<div class="col-md-6 col-md-offset-3 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<?php echo form_open(current_url(), array('method' => 'get')); ?>
	<div class="col-md-12 bottom2x">
		<div class="col-md-4">
			<a href="" class="btn btn-link">(2) Semua</a> |
			<a href="" class="btn btn-link">(2) Tertunda</a> |
			<a href="" class="btn btn-link">(2) Disetujui</a> 
		</div>
		<div class="col-md-4 pull-right">
            <div class="input-group input-group-sm">
            	<input type="text" name="query" class="form-control" value="<?php echo $this->input->get('query') ?>" placeholder="Pencarian ...">
            	<div class="input-group-btn">
                  	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari Komentar</button>
            	</div>
            </div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<div class="col-md-12">
		<div class="box box-default">
		<?php echo form_open(base_url("administrator/post/bulkaction")); ?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="30">
			                <div class="checkbox checkbox-inline">
			                    <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
			                </div>
						</th>
						<th class="text-center">Penulis</th>
						<th class="text-center">Komentar</th>
						<th class="text-center">Berita</th>
						<th class="text-center">Tanggal</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td>
			                 <div class="checkbox checkbox-inline">
			                     <input id="checkbox1" type="checkbox" name="posts[]" value=""> <label for="checkbox1"></label>
			                 </div>
						</td>
						<td class="td-action">
							<strong>

							</strong>
							<div class="button-action">
								<a href="<?php echo base_url("administrator/post/update/{}") ?>">Edit</a> |
								<a href="#" data-action="delete" data-key="post" data-id="" class="red">Hapus</a> |
								<a href="">Lihat</a> 
							</div>
						</td>
						<td width="150"></td>
						<td width="200">

						</td>
						<td width="180">
							<small>
								<time></time><br>
							</small>
						</td>
					</tr>
				<?php
				echo '<tr><td colspan="6">Tidak ada pengguna yang ditemukan.</td></tr>';
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<label>Yang terpilih :</label>
							<a class="btn btn-xs btn-round btn-danger" data-toggle="modal" data-target="#modal-delete-post-selected"><i class="fa fa-trash-o"></i> Hapus</a>
							<small class="pull-right"><?php echo 2 ?> dari <?php echo 3 ?> data.</small>
						</td>
					</tr>
				</tfoot>
			</table>
			<div class="modal" id="modal-delete-post-selected">
				<div class="modal-dialog modal-sm modal-danger">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
							<span>Hapus data berita yang terpilih dari database?</span>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
							<button type="submit" name="action" value="delete" class="btn btn-outline">Hapus</button>
						</div>
					</div>
				</div>
			</div>
		<?php echo form_close(); ?>
		</div>
	</div>
	<div class="col-md-12 text-center">
		<?php echo $this->pagination->create_links(); ?>
	</div>
</div>

<div class="modal" id="modal-delete-post">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus data berita ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a href="#" id="btn-delete" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>