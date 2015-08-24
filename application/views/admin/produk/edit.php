<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<h2>Edit Produk</h2>
			<p>Silahkan mengubah data produk.</p>
			<div class="sep"></div>
			
		<?php echo validation_errors(); ?>	
		<?php echo form_open_multipart('admin/produk/proses_edit') ?>
		<?php foreach($produk->result() as $row):?>			
			<div class="left">
				<div class="element">
					<label for="name">Nama Produk <span class="red">(required)</span></label>
					<input type="hidden" name="id_produk" value="<?php echo($row->id_produk);?>" size="30" />
					<input id="name" name="nama_produk" class="text err" value="<?php echo($row->nama_produk);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kode Produk <span class="red">(required)</span></label>
					<input id="name" name="kode_produk" class="text err" value="<?php echo($row->kode_produk);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kategori <span class="red">(required)</span></label>
					<?php 
						$kategori_id = $row->id_kategori;
						echo form_dropdown('kategori_id',$kategori_options,@$kategori_id);
					?>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Stok </label>
					<input id="name" name="stok_produk" class="text err" value="<?php echo($row->stok_produk);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Harga Jual <span class="red">(required)</span></label>
					<input id="name" name="harga_jual" class="text err" value="<?php echo($row->harga_jual);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Harga Baru <span class="red">(required)</span></label>
					<input id="name" name="harga_baru" class="text err" value="<?php echo($row->harga_baru);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<img src="<?php echo base_url().'images/produk/'.($row->image_produk); ?>" width="150px" height="150px"/><br><br>
					<!--<label for="attach">Upload Gambar Produk</label>
					<input type="file" name="image_produk" class="err" value="photo_not_available.jpg"/>-->
					<?php echo form_upload('nama_file')?>
					<?php echo $row->image_produk; ?>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Deskripsi</label>
					<textarea name="deskripsi_produk" class="textarea" rows="10"><?php echo($row->deskripsi_produk);?></textarea>
				</div>
			</div>
			<div class="entry">
				<button type="submit" class="add">Simpan Produk</button> <button class="cancel">Cancel</button>
			</div>
			<?php endforeach; ?>
		<?php echo form_close(); ?>
	</div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
