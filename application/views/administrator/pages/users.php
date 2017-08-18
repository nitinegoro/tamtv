<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12 bottom2x">
		<div class="col-md-6">
			<a href="" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Baru</a>
		</div>
		<div class="col-md-4 pull-right">
            <div class="input-group input-group-sm">
            	<input type="text" name="query" class="form-control" name="<?php echo $this->input->get('query') ?>" placeholder="Pencarian ...">
            	<div class="input-group-btn">
                  	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari pengguna</button>
            	</div>
            </div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-default">
			<table class="table table-bordered table-striped">
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
					<tr>
						<td>
			                 <div class="checkbox checkbox-inline">
			                     <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
			                 </div>
						</td>
						<td class="td-action">
							<a href="">Vicky Nitinegoro</a>
							<div class="button-action">
								<a href="">Edit</a> | 
								<a href="" class="red">Hapus</a> 
							</div>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<label>Yang terpilih :</label>
							<a class="btn btn-xs btn-round btn-danger get-delete-desa-multiple"><i class="fa fa-trash-o"></i> Hapus</a>
							<small class="pull-right">4 dari 4 data.</small>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>