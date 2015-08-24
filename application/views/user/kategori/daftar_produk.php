<!-- start of content right -->
<div id="content_right">
	<h1>Daftar Produk <?php echo"$judul"; ?> Yang Tersedia</h1>
	
	<?php if(!$daftar) { 
		echo '<marquee behavior="alternate"><center><h2><font color="orange">Maaf untuk saat ini belum ada Produk untuk Kategori ini.</font></h2></center></marquee>'; 
		} else { foreach($daftar as $row):?>
	<div class="product_box">
        <h1><?php echo ucwords($row->nama_produk);?></h1>
        <img src="
		<?php if ($row->image_produk) {
				echo base_url().'images/produk/'.($row->image_produk); 
			} else {
				echo base_url().'images/produk/photo_not_available.jpg';
		}?>
		" width="100px" height="150px" alt="" />
        <div class="product_info">
		  <table>
		  <tr><td>Kode </td><td>:</td><td> <?php echo $row->kode_produk;?></td></tr>
		  <tr><td>Harga </td><td>:</td><td> Rp. <?php echo $this->cart->format_number($row->harga_jual);?></td></tr>
          <tr><td valign="top">Deskripsi </td><td valign="top">:</td><td><?php if(!$row->deskripsi_produk) {echo 'Tidak ada deskripsi'; 
		  } else {
			echo $row->deskripsi_produk;
		  }?></td></tr>
		  </table>
		  <br>		  
		  <?php echo form_open('home/keranjang'); ?>
		  <input type="hidden" name="id_produk" value="<?php echo $row->id_produk; ?>"/>
		  <input type="hidden" name="kode_produk" value="<?php echo $row->kode_produk; ?>"/>
		  <input type="hidden" name="nama_produk" value="<?php echo $row->nama_produk; ?>"/>
		  <input type="hidden" name="harga_jual" value="<?php echo $row->harga_jual; ?>"/>
		  <input name="jumlah" value="1" class="lekuk" size="5"/>
		  <button type="submit" class="add">Beli</button>
		  <?php  echo form_close();	  ?>
		  
          <div class="detail_button"><a href=<?php echo base_url().'index.php/produk/detail/'.$row->id_produk;?> >Detail</a></div>
        </div>
        <div class="cleaner">&nbsp;</div>
    </div>
	<div class="cleaner_with_width">&nbsp;</div>
	<?php endforeach; }?>
	
	<div class="cleaner">&nbsp;</div>
	<div class="pagination">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	
</div>
<!-- end of content right -->