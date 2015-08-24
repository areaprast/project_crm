&nbsp;<div class="cleaner_with_height"></div>
	
<h1>Produk Terbaru</h1>	
	<?php foreach($produk_baru as $row):?>
	<div class="product_box_main">
        <a href="<?php echo site_url().'/produk/detail/'.($row->id_produk); ?>"><h1 align="center"><?php echo ucwords($row->nama_produk);?></h1></a>
		<center>
        <a href="<?php echo site_url().'/produk/detail/'.($row->id_produk); ?>"><img src="
		<?php if ($row->image_produk) {
				echo base_url().'images/produk/'.($row->image_produk); 
			} else {
				echo base_url().'images/produk/photo_not_available.jpg';
		}?>
		" width="160px" height="180px" alt=""/></a>
		</center>
	</div>
	<?php endforeach; ?>&nbsp;<div class="cleaner_with_height"></div>
