<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<h2>Tambah Produk</h2>
			<p>Silahkan menambah produk untuk di masukkan ke dalam daftar.</p>			
		<div class="sep"></div>					
			<?php echo form_open_multipart('admin/produk/proses_tambah') ?>		
		<div class="left">
			<div class="element">
				<label for="name">Nama Produk <span class="red">(required)</span></label>
				<?php echo form_error('nama_produk'); ?>
				<input id="name" name="nama_produk" class="text err" value="<?php echo set_value('nama_produk'); ?>"/>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Kode Produk <span class="red">(required)</span></label>
				<?php echo form_error('kode_produk'); ?>
				<input id="name" name="kode_produk" class="text err" value="<?php echo set_value('kode_produk'); ?>"/>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Kategori <span class="red">(required)</span></label>
				<?php echo form_dropdown('kategori_id',$kategori_options,@$kategori_id); ?>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Stok </label>
				<input id="name" name="stok_produk" class="text err"/>
			</div>
		</div>
		<div class="left">
			<div class="element">
				<label for="name">Harga Jual <span class="red">(required)</span></label>
				<?php echo form_error('harga_jual'); ?>
				<input id="name" name="harga_jual" class="text err" value="<?php echo set_value('harga_jual'); ?>"/>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Harga Baru <span class="red">(required)</span></label>
				<?php echo form_error('harga_baru'); ?>
				<input id="name" name="harga_baru" class="text err" value="<?php echo set_value('harga_baru'); ?>"/>
			</div>
		</div>
		<div class="left">
			<div class="element">
				<img src="<?php echo base_url().'images/produk/photo_not_available.jpg'; ?>" width="150px" height="150px"/><br><br>
				<?php echo form_upload('nama_file')?>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Deskripsi</label>
				<textarea name="deskripsi_produk" class="textarea" rows="10"></textarea>
			</div>
		</div>
		<div class="entry">
			<button type="submit" class="add">Tambah Produk</button> <button class="cancel">Cancel</button>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
