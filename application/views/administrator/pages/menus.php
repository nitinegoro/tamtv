<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Get Menu Type
 *
 * @return string
 **/
$menu_type = ( $this->input->get('menu') != '') ? $this->menus->menu_type[$this->input->get('menu')] : 'primary_menu';
?>
<div class="row">
	<div class="col-md-4">
		<div class="box box-default">
			<div class="box-body">
				<div class="form-group">
					<?php 
					/**
					 * Get AvailableMenu Type
					 *
					 **/
					echo form_dropdown(
						'menu', 
						$this->menus->menu_type, 
						$this->input->get('menu'), 
						array('class' => 'form-control', 'onchange' => "return window.location = '?menu=' + $(this).val();")
					);
					?>
				</div>
			</div>
			<div class="list-group">
			  	<a data-toggle="collapse" data-target="#page" class="list-group-item"><strong>Halaman</strong></a>
			  	<div id="page" class="collapse pad">
			  		<form action="<?php echo current_url() ?>" method="post">
					<div class="box-select-category">
					<?php foreach( $this->page->getall() as $row)  : ?>
						<div class="checkbox">
						    <input type="checkbox" name="pages[]" value="<?php echo $row->ID ?>"> <label><?php echo $row->post_title ?></label>
						</div>
					<?php endforeach; ?>
					</div>
					<?php echo form_hidden('key', $menu_type); ?>
					<button type="submit" name="action" value="page" class="btn btn-default top2x">Tambahkan ke menu</button>
					</form>
			  	</div>
			  	<a data-toggle="collapse" data-target="#category" class="list-group-item"><strong>Kategori</strong></a>
			  	<div id="category" class="collapse pad">
			  		<form action="<?php echo current_url() ?>" method="post">
					<div class="box-select-category">
					<?php foreach( $this->category->get_parent() as $row)  : ?>
						<div class="checkbox">
						    <input type="checkbox" name="categories[]" value="<?php echo $row->category_id ?>"> <label><?php echo $row->name ?></label>
						</div>
						<?php foreach( $this->category->get_child($row->category_id) as $child) : ?>
						<div class="checkbox left3x">
						    <input type="checkbox" name="categories[]" value="<?php echo $child->category_id ?>"> <label><?php echo $child->name ?></label>
						</div>
						<?php endforeach; ?>
					<?php endforeach; ?>
					</div>
					<?php echo form_hidden('key', $menu_type); ?>
					<button type="submit" name="action" value="category" class="btn btn-default top2x">Tambahkan ke menu</button>
					</form>
			  	</div>
			  	<a data-toggle="collapse" data-target="#custom" class="list-group-item"><strong>Kustomisasi</strong></a>
			  	<div id="custom" class="collapse pad in">
			  		<form action="<?php echo current_url() ?>" method="post">
					<div class="form-group">
						<small><i>Label</i></small>
						<input type="text" name="label" class="form-control input-sm" required>
					</div>
					<div class="form-group">
						<small><i>Target</i></small>
						<select name="target" class="form-control input-sm">
							<option value="_self">_self</option>
							<option value="_blank">_blank</option>
						</select>
					</div>
					<div class="form-group">
						<small><i>Url</i></small>
						<input type="url" name="url" class="form-control input-sm" placeholder="http://">
					</div>
					<?php echo form_hidden('key', $menu_type); ?>
					<button type="submit" name="action" value="custom" class="btn btn-default top2x">Tambahkan ke menu</button>
					</form>
			  	</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<h4><?php echo $menu_type; ?></h4>
		<p>Geser masing-masing item sesuai urutan yang Anda inginkan. Klik tombol-tombol di sebelah kanan item untuk melakukan konfigurasi tambahan.</p>
        <div class="dd" id="nestable2">
        	<input type="hidden" name="output" id="nestable-output" data-key="<?php echo $menu_type ?>">
            <ol class="dd-list">
			<?php  
			/**
			 * Get Parent Menu
			 *
			 * @var string
			 **/
			foreach( $this->menus->get($menu_type) as $row) :
			?>
                <li class="dd-item" data-id="<?php echo $row->ID; ?>">
                    <div class="dd-handle">
                    	<span id="label-<?php echo $row->ID; ?>"><?php echo $row->label; ?></span>
						<div class="button-action pull-right">
							<a data-toggle="collapse" data-target="#collapse-<?php echo $row->ID; ?>">Edit</a> |
							<a data-action="delete" data-key="menu" data-id="<?php echo $row->ID; ?>" class="red">Hapus</a>
						</div>
                    </div>
                    <div id="collapse-<?php echo $row->ID; ?>" class="collapse">
                    	<form id="save-menu" data-id="<?php echo $row->ID; ?>" method="post">
						<div class="form-group">
							<small>Label</small>
							<input type="text" name="label" id="label-<?php echo $row->ID; ?>" class="form-control input-sm" onkeyup=" return getlabelstring('<?php echo $row->ID; ?>', this.value)" value="<?php echo $row->label; ?>">
						</div>
						<div class="form-group">
							<small>Target</small>
							<select name="target" id="target-<?php echo $row->ID; ?>" class="form-control input-sm">
								<option value="_self" <?php if($row->target=='_self') echo 'selected'; ?>>_self</option>
								<option value="_blank" <?php if($row->target=='_blank') echo 'selected'; ?>>_blank</option>
							</select>
						</div>
						<div class="form-group">
							<small>Url</small>
							<input type="url" name="url" id="url-<?php echo $row->ID; ?>" class="form-control input-sm" placeholder="http://" value="<?php echo $row->url; ?>">
						</div>
						<div class="form-group">
							<button id="save-menu" type="submit" data-id="<?php echo $row->ID; ?>" class="btn btn-default">Simpan</button>
							<a href="#" data-action="delete" data-key="menu" data-id="<?php echo $row->ID ?>" class="text-red left2x">Hapus</a>
						</div>
 						</form>
					</div>
				<?php if( $this->menus->get($menu_type, $row->ID) ) : ?>
					<ol class="dd-list">
				<?php  
				/**
				 * Get Child Menu
				 *
				 * @var string
				 **/
				foreach( $this->menus->get($menu_type, $row->ID) as $child) :
				?>
		            <li class="dd-item" data-id="<?php echo $child->ID; ?>">
		               <div class="dd-handle">
		               		<span id="label-<?php echo $child->ID; ?>"><?php echo $child->label; ?></span>
							<div class="button-action pull-right">
								<a data-toggle="collapse" data-target="#collapse-<?php echo $child->ID; ?>">Edit</a> |
								<a data-action="delete" data-key="menu" data-id="<?php echo $child->ID; ?>" class="red">Hapus</a>
							</div>
						</div>
		                <div id="collapse-<?php echo $child->ID; ?>" class="collapse">
		                   	<form id="save-menu" data-id="<?php echo $child->ID; ?>" method="post">
							<div class="form-group">
								<small>Label</small>
								<input type="text" name="label" id="label-<?php echo $child->ID; ?>" class="form-control input-sm" onkeyup=" return getlabelstring('<?php echo $child->ID; ?>', this.value)" value="<?php echo $child->label; ?>">
							</div>
							<div class="form-group">
								<small>Target</small>
								<select name="target" id="target-<?php echo $child->ID; ?>" class="form-control input-sm">
									<option value="_self" <?php if($child->target=='_self') echo 'selected'; ?>>_self</option>
									<option value="_blank" <?php if($child->target=='_blank') echo 'selected'; ?>>_blank</option>
								</select>
							</div>
							<div class="form-group">
								<small>Url</small>
								<input type="url" name="url" id="url-<?php echo $child->ID; ?>" class="form-control input-sm" placeholder="http://" value="<?php echo $child->url; ?>">
							</div>
							<div class="form-group">
								<button id="save-menu" type="submit" data-id="<?php echo $child->ID; ?>" class="btn btn-default">Simpan</button>
								<a href="#" data-action="delete" data-key="menu" data-id="<?php echo $child->ID ?>" class="text-red left2x">Hapus</a>
							</div>
		 					</form>
						</div>
		            </li>
				<?php endforeach; ?>
					</ol>
				<?php endif; ?>
                </li>
  			<?php endforeach; ?>
  			</ol>
		</div>
	</div>
</div>

<div class="modal" id="modal-delete-menu">
	<div class="modal-dialog modal-sm modal-danger">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"></i> Hapus!</h4>
				<span>Hapus menu ini dari database?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
				<a id="btn-delete" class="btn btn-outline">Hapus</a>
			</div>
		</div>
	</div>
</div>
<?php
/* End of file menus.php */
/* Location: ./application/views/administrator/pages/menus.php */