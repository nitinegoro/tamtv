<div class="row">
	<div class="col-md-6 col-md-offset-3 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<?php echo form_open(current_url(), array('method' => 'get')); ?>
	<div class="col-md-12 bottom2x">
		<div class="col-md-2">
			<a href="<?php echo base_url("administrator/post/create"); ?>" class="btn btn-default"><i class="fa fa-pencil"></i> Tulis Berita</a>
		</div>
		<div class="col-md-4">
			<div class="col-md-8">
				<select name="category" id="input" class="form-control input-sm">
					<option value=""> -- Suluruh Kategori --</option>
				<?php foreach( $this->category->getall() as $row)    
				{
					$selected = (set_value('parent')== $row->category_id) ? 'selected' : '';
					echo '<option value="'.$row->category_id.'" '.$selected.'>'.$row->name.'</option>';
				}
				?>
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
                  	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari Berita</button>
            	</div>
            </div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<div class="col-md-12">
		<div class="box box-default">
		<?php echo form_open(base_url("administrator/post/bulkaction")); ?>
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
						<th class="text-center">Kategori</th>
						<th class="text-center">Topik</th>
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
			                     <input id="checkbox1" type="checkbox" name="posts[]" value="<?php echo $row->ID ?>"> <label for="checkbox1"></label>
			                 </div>
						</td>
						<td class="td-action">
							<strong>
								<?php echo anchor(base_url("administrator/post/update/{$row->ID}"), $row->post_title); ?>
							</strong>
							<div class="button-action">
								<a href="<?php echo base_url("administrator/post/update/{$row->ID}") ?>">Edit</a> |
								<a href="#" data-action="delete" data-key="post" data-id="<?php echo $row->ID; ?>" class="red">Hapus</a> |
								<a href="<?php echo $this->posts->permalink($row->ID) ?>">Lihat</a> 
							</div>
						</td>
						<td width="150"><?php echo anchor(base_url('administrator/post?author='.$row->user_id), $row->fullname); ?></td>
						<td width="200">
						<?php  
						/**
						 * Get displaye post tag
						 *
						 * @param Integer
						 **/
						foreach($this->posts->get_post_categories($row->ID) as $key => $category)
						{
							echo anchor(base_url("administrator/post?category={$category->category_id}"), $category->name);
							if( ++$key < count($this->posts->get_post_categories($row->ID)))
								echo ', ';
						}
						?>
						</td>
						<td width="200">
						<?php  
						/**
						 * Get displaye post tag
						 *
						 * @param Integer
						 **/
						foreach($this->posts->get_post_tags($row->ID) as $key => $tag)
						{
							echo anchor(base_url("administrator/post?tag={$tag->tag_id}"), $tag->name);
							if( ++$key < count($this->posts->get_post_tags($row->ID)))
								echo ', ';
						}
						?>
						</td>
						<td width="180">
							<small>
								<time><?php echo $this->posts->date_format($row->post_date); ?></time><br>
							</small>
						</td>
					</tr>
				<?php endforeach; 
				if( $posts == FALSE ) echo '<tr><td colspan="6">Tidak ada berita yang ditemukan.</td></tr>';
				?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<label>Yang terpilih :</label>
							<a class="btn btn-xs btn-round btn-danger" data-toggle="modal" data-target="#modal-delete-post-selected"><i class="fa fa-trash-o"></i> Hapus</a>
							<small class="pull-right"><?php echo count($posts) ?> dari <?php echo $this->posts->getall(null, null, 'num') ?> data.</small>
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