<!-- start of content right -->
<div id="content_right">

   <h1>Profile</h1>
   <p align="justify">
		<?php echo $profile_website['isi_opt'] ?>
   </p>
   <!--<h2><?php echo $visi_website['deskripsi_opt'] ?></h2>
   <p align="justify">
		<?php echo $visi_website['isi_opt'] ?>
   </p><br>
   <h2><?php echo $misi_website['deskripsi_opt'] ?></h2>
   <p align="justify">
		<?php echo $misi_website['isi_opt'] ?>
   </p><br>-->

	<?php $this->load->view('user/produk/produk_terbaru',$this->data) ?>	
	
</div>
<!-- end of content right -->