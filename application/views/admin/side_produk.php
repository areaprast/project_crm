<div class="box">
	<div class="h_title">&#8250;&nbsp Daftar Produk & Kategori</div>
	<?php
	if(($judul=='Produk') or ($judul=='Tambah Produk') or ($judul=='Edit Produk') or ($judul=='Detail Produk') or ($judul=='Kategori') or ($judul=='Tambah Kategori') or ($judul=='Edit Kategori')) 
	{ echo '<ul id="home">'; }
	else echo '<ul>';
	?>	
		<li class="b1"><?php echo anchor('admin/produk','Produk','class="icon page" title="Produk"');?></li>
		<li class="b2"><?php echo anchor('admin/produk/proses_tambah','Tambah Produk','class="icon add_page" title="Tambah Produk"');?></li>
		<li class="b1"><?php echo anchor('admin/kategori','Kategori','class="icon category" title="Kategori"');?></li>
		<li class="b2"><?php echo anchor('admin/kategori/tambah','Tambah Kategori','class="icon add_page" title="Tambah Kategori"');?></li>
	</ul>
</div>