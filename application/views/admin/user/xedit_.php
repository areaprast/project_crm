<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<h2><?php echo"$judul"; ?></h2>
			<p>Silahkan mengubah data user.</p>
			<div class="sep"></div>
			
		<?php echo validation_errors(); ?>	
		<?php echo form_open_multipart('admin/user/proses_edit') ?>
		<?php foreach($user->result() as $row):?>			
			<div class="left">
				<div class="element">
					<label for="name">Nama User <span class="red">(required)</span></label>
					<input type="hidden" name="id_user" value="<?php echo($row->id_user);?>" size="30" />
					<input id="name" name="nama_user" class="text err" value="<?php echo($row->nama_user);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Email User <span class="red">(required)</span></label>
					<input id="name" name="email_user" class="text err" value="<?php echo($row->email_user);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Level <span class="red">(required)</span></label>
					<input id="name" name="level_user" class="text err" value="<?php echo($row->level_user);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">No. Telp. </label>
					<input id="name" name="phone" class="text err" value="<?php echo($row->phone);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Nama Depan <span class="red">(required)</span></label>
					<input id="name" name="nama_depan" class="text err" value="<?php echo($row->nama_depan);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Nama Belakang <span class="red">(required)</span></label>
					<input id="name" name="nama_belakang" class="text err" value="<?php echo($row->nama_belakang);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<img src="<?php echo base_url().'images/user/'.($row->image_user); ?>" width="150px" height="150px"/><br><br>
					<!--<label for="attach">Upload Gambar Produk</label>
					<input type="file" name="image_produk" class="err" value="photo_not_available.jpg"/>-->
					<?php echo form_upload('nama_file')?>
					<?php echo $row->image_user; ?>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Alamat</label>
					<textarea name="alamat" class="textarea" rows="5"><?php echo($row->alamat);?></textarea>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kode Pos <span class="red">(required)</span></label>
					<input id="name" name="kode_pos" class="text err" value="<?php echo($row->kode_pos);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Propinsi <span class="red">(required)</span></label>
					<input id="name" name="propinsi" class="text err" value="<?php echo($row->propinsi);?>"/>
				</div>
			</div>
			<div class="entry">
				<button type="submit" class="add">Simpan User</button> <button class="cancel">Cancel</button>
			</div>
			<?php endforeach; ?>
		<?php echo form_close(); ?>
	</div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
