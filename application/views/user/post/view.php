<!-- start of content right -->
<div id="content_right">

   <?php foreach($post as $row) : ?>
   <h1><a href="<?php echo site_url().'/home/post/'.$row->id_post; ?>"><?php echo $row->judul_post; ?></a></h1>
   <h2>Diposting <?php //echo $row->id_user ?> pada <?php echo $row->tanggal_post ?></h2>
   <p align="justify">
		<?php if($row->image_post) { ?><img src="<?php echo base_url().'images/post/'.$row->image_post?>" width="100px" height="115px" style="float:left; margin:0 8px 4px 0;">
		<?php } echo $row->detail_post ?>
   </p>&nbsp;
	<div class="cleaner"></div>&nbsp;
	<div class="cleaner"></div>
   <?php endforeach; ?>

	<?php $this->load->view('user/produk/produk_terbaru',$this->data) ?>	
	
</div>
<!-- end of content right -->