<!-- start of content right -->
<div id="content_right">
   <p align="center"><font color="red">
		<?php 
			if($this->session->flashdata('sukses_edit')) {
				echo $this->session->flashdata('sukses_edit'); 
			}
		?></font>
   </p>
	<?php foreach($post as $row) : ?>
	   <h1><a href="<?php echo site_url().'/home/post/'.$row->id_post; ?>"><?php echo $row->judul_post; ?></a></h1>
	   <h2>Diposting <?php //echo $row->id_user ?> pada <?php echo $row->tanggal_post ?></h2>
	   <p align="justify">
			<?php if($row->image_post) { ?><img src="<?php echo base_url().'images/post/'.$row->image_post?>" width="100px" height="115px" style="float:left; margin:0 8px 4px 0;"> 
			<?php } echo ' '.substr($row->detail_post,0,500).'..... '; ?><a href="<?php echo site_url().'/home/view_post/'.$row->id_post; ?>">Baca Selengkapnya</a>
	   </p>&nbsp;<div class="cleaner_with_height"></div>

	<?php endforeach; ?>   
	<!-- <h2><?php echo $this->session->flashdata('pesan_level'); ?></h2> -->
	<?php if(($judul == 'Selamat Datang') OR ($judul == 'Baca Berita')) { ?>	
		<?php $this->load->view('user/produk/produk_terbaru',$this->data) ?>	
	<?php } ?>
</div>
<!-- end of content right -->