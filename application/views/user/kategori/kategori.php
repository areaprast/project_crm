<!-- start of content right -->
<div id="content_right">
	<h1><?php echo"$judul"; ?></h1>
	
	<?php foreach($kategori as $row):?>
	<div class="product_box">
        <h1><?php echo ucwords($row->nama_kategori);?></h1>
        <img src="
		<?php if ($row->image) {
				echo base_url().'images/produk/'.($row->image); 
			} else {
				echo base_url().'images/produk/photo_not_available.jpg';
		}?>
		" width="100px" height="150px" alt="" />
        <div class="product_info">
          <p><?php if(!$row->deskripsi) {echo 'Tidak ada deskripsi'; 
		  } else {
			echo $row->deskripsi;
		  }?></p>
          <div class="buy_now_button"><a href="<?php echo $row->id_kategori;?>">Lihat Produk</a></div>
        </div>
        <div class="cleaner">&nbsp;</div>
    </div>
	<div class="cleaner_with_width" >&nbsp;</div>
	<?php endforeach; ?>
	<div class="cleaner">&nbsp;</div>&nbsp;
	
</div>
<!-- end of content right -->