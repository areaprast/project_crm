<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<div class="sep"></div>
		<?php foreach($produk->result() as $row):?>		
		<?php echo form_open_multipart('admin/produk/edit/'.$row->id_produk) ?>	
			<div class="left">
				<div class="element">
					<label for="name">Nama Produk </label>
					<input type="hidden" name="id_produk" value="<?php echo($row->id_produk);?>" size="30" />
					<input disabled id="name" name="nama_produk" class="text err" value="<?php echo($row->nama_produk);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kode Produk </label>
					<input disabled id="name" name="kode_produk" class="text err" value="<?php echo($row->kode_produk);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kategori </label>
					<input disabled id="name" name="id_kategori" class="text err" value="<?php echo($row->nama_kategori);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Stok </label>
					<input disabled id="name" name="stok_produk" class="text err" value="<?php echo($row->stok_produk);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Harga Jual </label>
					<input disabled id="name" name="harga_jual" class="text err" value="<?php echo($row->harga_jual);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Harga Baru </label>
					<input disabled id="name" name="harga_baru" class="text err" value="<?php echo($row->harga_baru);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Deskripsi</label>
					<textarea disabled name="deskripsi_produk" class="textarea" rows="10"><?php echo($row->deskripsi_produk);?></textarea>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<img src="<?php echo base_url().'images/produk/'.($row->image_produk); ?>" width="130px" height="130px"/>
					<?php echo $row->image_produk; ?>
				</div>
			</div>
			<div class="entry">
				<button type="submit" class="add">Ubah Produk</button> <button class="cancel">Cancel</button>
			</div>
			<?php endforeach; ?>
		<?php echo form_close(); ?>
	</div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
