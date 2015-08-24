<!-- start of content right -->
<div id="content_right">
	<h1><?php echo"$judul"; ?></h1>
	<div class="product_box_detail">
	<?php foreach($produk->result() as $row):?>	
		<div class="image_panel2">
		
		<img src="<?php 
		if ($row->image_produk) {
			echo base_url().'images/produk/'.($row->image_produk); 
		} else {
			echo base_url().'images/produk/photo_not_available.jpg';
		}?>" alt="" width="150" height="200" />
		</div>
	
		<h2><?php echo ucwords($row->nama_produk);?></h2>	
		  <table>
			<tr><td width="100px">Kategori</td><td width="20px"> : </td><td><?php echo($row->nama_kategori);?></td></tr>
			<tr><td>Harga</td><td> : </td><td>Rp. <?php echo $this->cart->format_number($row->harga_jual);?></td></tr>
			<tr><td>Kode Produk &nbsp;</td><td> : </td><td><?php echo($row->kode_produk);?></td></tr>
			<tr><td valign="top">Deskripsi</td><td valign="top"> : </td><td><?php if(!$row->deskripsi_produk) {echo 'Tidak ada deskripsi'; 
			  } else {
				echo $row->deskripsi_produk;
			  }?></td></tr>
			<tr><td><?php echo form_open('home/keranjang'); ?>
			  <input type="hidden" name="id_produk" value="<?php echo $row->id_produk; ?>"/>
			  <input type="hidden" name="kode_produk" value="<?php echo $row->kode_produk; ?>"/>
			  <input type="hidden" name="nama_produk" value="<?php echo $row->nama_produk; ?>"/>
			  <input type="hidden" name="harga_jual" value="<?php echo $row->harga_jual; ?>"/>
			  Jumlah</td><td> : </td><td>
			  <input name="jumlah" value="1" class="lekuk" size="15"/>
			  <button type="submit" class="add">Beli</button>
			  <?php  echo form_close();	  ?></td></tr>
		  </table>			  
    <div class="cleaner_with_height">&nbsp;</div>	
	<?php endforeach; ?>
	</div>
	  	  
    <div class="cleaner_with_height">&nbsp;</div>
	
	<?php $this->load->view('user/produk/produk_terbaru',$this->data) ?>	
</div>
<!-- end of content right -->