<div class="row">
	<div class="col-md-6 col-md-offset-3 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<?php echo form_open(current_url(), array('method' => 'get')); ?>
	<div class="col-md-12 bottom2x">
		<div class="col-md-2">
			<a href="<?php echo base_url("administrator/pages/create"); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Buat Halaman</a>
		</div>
		<div class="col-md-4 pull-right">
            <div class="input-group input-group-sm">
            	<input type="text" name="query" class="form-control" value="<?php echo $this->input->get('query') ?>" placeholder="Pencarian ...">
            	<div class="input-group-btn">
                  	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari Halaman</button>
            	</div>
            </div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<div class="col-md-12">
		<div class="box box-default">
		<?php echo form_open(base_url("administrator/pages/bulkaction")); ?>
			<table class="table table-bordered table-hover checked">
				<thead>
					<tr>
						<th width="30">
			                <div class="checkbox checkbox-inline">
			                    <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
			                </div>
						</th>
						<th class="text-center">Judul</th>
						<th class="text-center">Penulis</th>
						<th class="text-center">Tanggal</th>
					</tr>
				</thead>
				<tbody>
				<?php  
				/**
				 * Loop Data Users
				 *
				 **/
				foreach( $posts as $row) :
				?>
					<tr>
						<td>
			                 <div class="checkbox checkbox-inline">
			                     <input id="checkbox1" type="checkbox" name="pages[]" value="<?php echo $row->ID ?>"> <label for="checkbox1"></label>
			                 </div>
						</td>
						<td class="td-action">
							<strong>
								<?php echo anchor(base_url("administrator/pages/update/{$row->ID}"), $row->post_title); ?>
							</strong>
							<div class="button-action">
								<a href="<?php echo base_url("administrator/pages/update/{$row->ID}") ?>">Edit</a> |
								<a href="#" data-action="delete" data-key="page" data-id="<?php echo $row->ID; ?>" class="red">Hapus</a> |
								<a href="<?php echo base_url("page/{$row->post_slug}"); ?>">Lihat</a> 
							</div>
						</td>
						<td width="150"><?php echo anchor(base_url('administrator/pages?author='.$row->user_id), $row->fullname); ?></td>
						<td width="180">
							<small>
								<time><?php echo $this->posts->date_format($row->post_date); ?></time><br>
							</small>
						</td>
					</tr>
				<?php endforeach; 
				if( $posts == FALSE ) echo '<tr><td colspan="4">Tidak ada pengguna yang ditemukan.</td></tr>';
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<label>Yang terpilih :</label>
							<a class="btn btn-xs btn-round btn-danger" data-toggle="modal" data-target="#modal-delete-page-selected"><i class="fa fa-trash-o"></i> Hapus</a>
							<small class="pull-right"><?php echo count($posts) ?> dari <?php echo $this->page->get_all(null, null, 'num') ?> data.</small>
						</td>
					</tr>
				</tfoot>
			</table>
			<div class="modal" id="modal-delete-page-selected">
				<div class="modal-dialog modal-sm modal-danger">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
							<span>Hapus data halaman yang terpilih dari database?</span>
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

<div class="modal" id="modal-delete-page">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus data halaman ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a href="#" id="btn-delete" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>