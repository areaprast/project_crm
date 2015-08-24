<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<h2><?php echo"$judul"; ?></h2>
			<p>Silahkan mengubah data user.</p>
			<div class="sep"></div>
			
		<?php echo validation_errors(); ?>	
		<?php echo form_open_multipart('admin/user/proses_edit_detail') ?>
		<?php foreach($user->result() as $row):?>			
			<div class="element">
				<label for="name">Nama dan Email User</label>
				<input type="hidden" name="id_user" value="<?php echo($row->id_user);?>" size="30" />
				<input disabled id="name" name="nama_user" value="<?php echo($row->nama_user);?>" size="30"/> - 
				<input disabled id="name" name="email_user" value="<?php echo($row->email_user);?>" size="50"/>
			</div>
		<?php endforeach; ?>
		<?php foreach($userdata->result() as $row):?>
			<input type="hidden" name="id_user" value="<?php echo($row->id_user);?>" size="30" />
			<div class="element">
				<label for="name">Nama Lengkap <span class="red">(required)</span></label>
				<input id="name" name="nama_depan" class="err" value="<?php echo($row->nama_depan);?>" size="30"/>
				<input id="name" name="nama_belakang" class="err" value="<?php echo($row->nama_belakang);?>" size="51"/>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Alamat</label>
					<textarea name="alamat" class="textarea err" rows="11"><?php echo($row->alamat);?></textarea>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">No. Telp. <span class="red">(required)</span></label>
					<input id="name" name="phone" class="text err" value="<?php echo($row->phone);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kode Pos <span class="red">(required)</span></label>
					<input id="name" name="kode_pos" class="text err" value="<?php echo($row->kode_pos);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Propinsi <span class="red">(required)</span></label>
					<input id="name" name="propinsi" class="text err" value="<?php echo($row->propinsi);?>"/>
				</div>
			</div>
			<div class="entry">&nbsp;<br>
				<button type="submit" class="add">Simpan User</button> <button class="cancel">Cancel</button>
			</div>
			<?php endforeach; ?>
		<?php echo form_close(); ?>
	</div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
