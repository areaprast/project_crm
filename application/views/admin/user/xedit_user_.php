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
					<label for="name">ID User </label>
					<input disabled name="id_user" value="<?php echo($row->id_user);?>" size="10" /> <!--<input name="level_user" value="<?php echo($row->level_user);?>" size="10" />-->
					<select name="level_user"> 
						<option value="0" <?php if(($row->level_user) == 0){ echo 'selected'; } ?>>Super Admin</option> 
						<option value="1" <?php if(($row->level_user) == 1){ echo 'selected'; } ?>>Admin</option>
						<option value="2" <?php if(($row->level_user) == 1){ echo 'selected'; } ?>>User/Member</option>
					</select> 
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Nama User <span class="red">(required)</span></label>
					<input type="hidden" name="id_user" value="<?php echo($row->id_user);?>" size="30" />
					<input id="name" name="nama_user" class="text err" value="<?php echo($row->nama_user);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Email User <span class="red">(required)</span></label>
					<input id="name" name="email_user" class="text err" value="<?php echo($row->email_user);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Status <span class="red">(required)</span></label>
					<!--<input id="name" name="status_user" class="text err" value="<?php echo($row->status_user);?>"/>-->
					<select name="status_user"> 
						<option value="0" <?php if(($row->status_user) == 0){ echo 'selected'; } ?>>Belum Aktif</option> 
						<option value="1" <?php if(($row->status_user) == 1){ echo 'selected'; } ?>>Aktif</option>
					</select> 
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
					<label for="name">Kunjungan Terakhir</label>
					<input disabled id="name" name="last_visit" value="<?php echo($row->last_visit);?>" size="50"	/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Password Lama</label>
					<input disabled type="password" id="name" name="password_user" value="<?php echo($row->password_user);?>" size="50"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Password Baru<span class="red"> (required)</span></label>
					<?php if(($row->level_user)== 2 ) { ?>
					<input disabled type="password" id="name" name="password_user" class="text err" value="<?php echo($row->password_user);?>"/>
					<?php } else { ?>
					<input type="password" id="name" name="password_user" class="text err" value="<?php echo($row->password_user);?>"/>
					<?php } ?>
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
