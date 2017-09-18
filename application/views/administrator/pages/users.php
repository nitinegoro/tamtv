<div class="row">
	<div class="col-md-6 col-md-offset-3 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<?php echo form_open(current_url(), array('method' => 'get')); ?>
	<div class="col-md-12 bottom2x">
		<div class="col-md-2">
			<a href="<?php echo base_url("administrator/users/create"); ?>" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Baru</a>
		</div>
		<div class="col-md-4">
			<div class="col-md-8">
				<select name="role" id="inputRole" class="form-control input-sm">
					<option value="">-- Semua peran --</option>
					<option value="administrator" <?php if($this->input->get('role')=='administrator') echo 'selected'; ?>>Administrator</option>
					<option value="writer" <?php if($this->input->get('role')=='writer') echo 'selected'; ?>>Penulis</option>
					<option value="reader" <?php if($this->input->get('role')=='reader') echo 'selected'; ?>>Pembaca</option>
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-filter"></i> Filter</button>
			</div>
		</div>
		<div class="col-md-4 pull-right">
            <div class="input-group input-group-sm">
            	<input type="text" name="query" class="form-control" value="<?php echo $this->input->get('query') ?>" placeholder="Pencarian ...">
            	<div class="input-group-btn">
                  	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari pengguna</button>
            	</div>
            </div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<div class="col-md-12">
		<div class="box box-default">
		<?php echo form_open(base_url("administrator/users/bulkaction")); ?>
			<table class="table table-bordered table-hover checked">
				<thead>
					<tr>
						<th width="30">
			                <div class="checkbox checkbox-inline">
			                    <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
			                </div>
						</th>
						<th class="text-center">Nama Lengkap</th>
						<th class="text-center">Username</th>
						<th class="text-center">E-Mail</th>
						<th class="text-center">Peran</th>
						<th class="text-center">Berita</th>
					</tr>
				</thead>
				<tbody>
				<?php  
				/**
				 * Loop Data Users
				 *
				 **/
				foreach( $users as $row) :
				?>
					<tr>
						<td>
			                 <div class="checkbox checkbox-inline">
			                     <input id="checkbox1" type="checkbox" name="users[]" value="<?php echo $row->ID ?>"> <label for="checkbox1"></label>
			                 </div>
						</td>
						<td class="td-action">
							<?php echo anchor(base_url("administrator/users/update/{$row->ID}"), $row->fullname); ?>
							<div class="button-action">
								<a href="<?php echo base_url("administrator/users/update/{$row->ID}") ?>">Edit</a>
							<?php if( $row->ID != 1 ) : ?> |
								<a href="#" data-action="delete" data-key="user" data-id="<?php echo $row->ID; ?>" class="red">Hapus</a> 
							<?php endif; ?>
							</div>
						</td>
						<td><?php echo $row->username; ?></td>
						<td>
							<?php echo mailto($row->email, $row->email) ?>
						</td>
						<td><?php echo user_role($row->user_type) ?></td>
						<td class="text-center">
							<?php echo anchor(base_url("administrator/post?author={$row->ID}"), $this->user->count_posts($row->ID)); ?>	
						</td>
					</tr>
				<?php endforeach; 
				if( $users == FALSE ) echo '<tr><td colspan="6">Tidak ada pengguna yang ditemukan.</td></tr>';
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<label>Yang terpilih :</label>
							<a class="btn btn-xs btn-round btn-danger" data-toggle="modal" data-target="#modal-delete-user-selected"><i class="fa fa-trash-o"></i> Hapus</a>
							<small class="pull-right"><?php echo count($users) ?> dari <?php echo $this->user->getAll(null, null, 'num') ?> data.</small>
						</td>
					</tr>
				</tfoot>
			</table>
			<div class="modal" id="modal-delete-user-selected">
				<div class="modal-dialog modal-sm modal-danger">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
							<span>Hapus data pengguna yang terpilih dari database?</span>
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

<div class="modal" id="modal-delete-user">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus data pengguna ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a href="#" id="btn-delete" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>