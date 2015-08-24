<div class="box">
	<div class="h_title">&#8250;&nbsp Daftar Post</div>
	<?php
	if(($judul=='Daftar Post') OR ($judul=='Edit Post') OR ($judul=='Tambah Post')) 
	{ echo '<ul id="home">'; }
	else echo '<ul>';
	?>	
		<li class="b1"><?php echo anchor('admin/post','Daftar Post','class="icon category" title="Daftar Post"');?></li>
		<li class="b2"><?php echo anchor('admin/post/tambah','Tambah Post','class="icon add_page" title="Tambah Post"');?></li>
		<!--<li class="b1"><a class="icon photo" href="">Galeri</a></li>
		<li class="b2"><a class="icon category" href="">Kategori Konten</a></li>-->
	</ul>
</div>