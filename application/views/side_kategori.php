<div class="content_left_section">
	<h1>Kategori Produk</h1>
	<ul>
	<?php foreach($kategori as $row):?>
		<li><a href="<?php echo base_url() ?>index.php/kategori/<?php echo $row->id_kategori;?>"><?php echo ucwords($row->nama_kategori);?></a></li>
	<?php endforeach; ?>
	</ul>
</div>