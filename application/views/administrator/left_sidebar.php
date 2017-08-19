<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   		<aside class="main-sidebar">
      	<section class="sidebar">

      		<ul class="sidebar-menu">
	        	<li class="<?php echo active_link_controller('administrator'); ?>">
	            	<a href="<?php echo base_url('administrator') ?>">
	               		<i class="fa fa-dashboard"></i> <span>Dashboard</span>
	            	</a>
	        	</li>
	        	<li class="treeview <?php echo active_link_multiple(array('post','post_tags','post_category')); ?>">
	            	<a href="#">
	               		<i class="fa fa-pencil"></i> <span>Berita</span>
	               		<span class="pull-right-container">
	                  		<i class="fa fa-angle-right pull-right"></i>
	               		</span>
	            	</a>
	          		<ul class="treeview-menu">
	            		<li class="<?php echo active_link_method('create','post') ?>">
	              			<a href="<?php echo base_url("administrator/post/create"); ?>"><i class="fa fa-angle-double-right"></i> Tulis Berita</a>
	            		</li>
	            		<li class="<?php echo active_link_method('index','post') ?>">
	              			<a href="<?php echo base_url("administrator/post") ?>"><i class="fa fa-angle-double-right"></i> Semua Berita</a>
	            		</li>
	            		<li class="<?php echo active_link_controller('post_category') ?>">
	              			<a href="<?php echo base_url("administrator/post_category") ?>"><i class="fa fa-angle-double-right"></i> Kategori</a>
	            		</li>
	            		<li class="<?php echo active_link_controller('post_tags') ?>">
	              			<a href="<?php echo base_url("administrator/post_tags"); ?>"><i class="fa fa-angle-double-right"></i> Topik</a>
	            		</li>
	          		</ul>
	        	</li>
	        	<li class="treeview <?php echo active_link_multiple(array('setting','role','penilaian', 'user')); ?>">
	            	<a href="#">
	               		<i class="fa fa-file-text"></i> <span>Halaman</span>
	               		<span class="pull-right-container">
	                  		<i class="fa fa-angle-right pull-right"></i>
	               		</span>
	            	</a>
	          		<ul class="treeview-menu">
	            		<li class="<?php echo active_link_controller('setting') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Buat Baru</a>
	            		</li>
	            		<li class="<?php echo active_link_controller('user') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Semua Halaman</a>
	            		</li>
	          		</ul>
	        	</li>
	        	<li class="treeview <?php echo active_link_multiple(array('setting','role','penilaian', 'user')); ?>">
	            	<a href="#">
	               		<i class="fa fa-comments"></i> <span>Komentar</span>
	            	</a>
	        	</li>
	        	<li class="treeview <?php echo active_link_multiple(array('setting','role','penilaian', 'user')); ?>">
	            	<a href="#">
	               		<i class="fa fa-line-chart"></i> <span>Statistik</span>
	               		<span class="pull-right-container">
	                  		<i class="fa fa-angle-right pull-right"></i>
	               		</span>
	            	</a>
	          		<ul class="treeview-menu">
	            		<li class="<?php echo active_link_controller('setting') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Pengunjung</a>
	            		</li>
	            		<li class="<?php echo active_link_controller('user') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Polling Berita</a>
	            		</li>
	          		</ul>
	        	</li>
	        	<li class="treeview <?php echo active_link_multiple(array('users')); ?>">
	            	<a href="#">
	               		<i class="fa fa-users"></i> <span>Pengguna</span>
	               		<span class="pull-right-container">
	                  		<i class="fa fa-angle-right pull-right"></i>
	               		</span>
	            	</a>
	          		<ul class="treeview-menu">
	            		<li class="<?php echo active_link_method('index','users') ?>">
	              			<a href="<?php echo base_url("administrator/users"); ?>"><i class="fa fa-angle-double-right"></i> Semua Pengguna</a>
	            		</li>
	            		<li class="<?php echo active_link_method('create','users') ?>">
	              			<a href="<?php echo base_url("administrator/users/create"); ?>"><i class="fa fa-angle-double-right"></i> Buat Baru</a>
	            		</li>
	            		<li class="<?php echo active_link_method('account','users') ?>">
	              			<a href="<?php echo base_url("administrator/users/account"); ?>"><i class="fa fa-angle-double-right"></i> Profil Anda</a>
	            		</li>
	          		</ul>
	        	</li>
	        	<li class="treeview <?php echo active_link_multiple(array('setting','role','penilaian', 'user')); ?>">
	            	<a href="#">
	               		<i class="fa fa-wrench"></i> <span>Pengaturan</span>
	               		<span class="pull-right-container">
	                  		<i class="fa fa-angle-right pull-right"></i>
	               		</span>
	            	</a>
	          		<ul class="treeview-menu">
	            		<li class="<?php echo active_link_controller('setting') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Umum</a>
	            		</li>
	            		<li class="<?php echo active_link_controller('setting') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Sosial Media</a>
	            		</li>
	            		<li class="<?php echo active_link_controller('setting') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Live Sreaming</a>
	            		</li>
	            		<li class="<?php echo active_link_controller('setting') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Permalink</a>
	            		</li>
	            		<li class="<?php echo active_link_controller('user') ?>">
	              			<a href=""><i class="fa fa-angle-double-right"></i> Elemen</a>
	            		</li>
	          		</ul>
	        	</li>
	        	<li class="<?php echo active_link_controller('userguide'); ?>">
	            	<a href="">
	               		<i class="fa fa-info-circle"></i> <span> Panduan Penggunaan</span>
	            	</a>
	        	</li>
      		</ul>
      	</section>
   	</aside>
   	<div class="content-wrapper">
      	<section class="content-header">
        <?php 
        /**
         * Generated Page Title
         *
         * @return string
         **/
         echo $this->page_title->show();

        /**
         * Generate Breadcrumbs from library
         *
         * @var string
         **/
          echo $this->breadcrumbs->show();
        ?>
      	</section>
      	<section class="content">
<?php
/* End of file left_sidebar.php */
/* Location: ./application/views/administrator/left_sidebar.php */