<!-- start of content right -->
<div id="content_right">
<h1><?php echo"$judul"; ?></h1>				

	<p align="center"><font color="red"><?php 
		if($this->session->flashdata('edit_pass')) {
			echo $this->session->flashdata('edit_pass'); 
		}?></font></p>
		
	<?php foreach($user as $row):?>	
	<?php echo form_open_multipart('user/edit_password') ?>
	<table style="width:90%" class="dua">
	<tr>
		<td colspan=4>&nbsp;</td>
	</tr>
	<tr>
		<td rowspan=6 width=10></td>
		<td valign="top"><label for="name">Nama User </label></td>
		<td><input disabled id="name" name="nama_user" class="lekuk" value="<?php echo($row->nama_user);?>" size="60" />
		<input hidden name="nama_user" value="<?php echo($row->nama_user);?>"/>
		<input hidden name="id_user" value="<?php echo($row->id_user);?>"/></td>
	</tr>
	<tr>
		<td valign="top"><label for="name">Password Lama</label></td>
		<td><?php echo form_error('pass_lama'); ?><input type="password" id="name" name="pass_lama" class="lekuk" value="" size="60" /></td>
	</tr>
	<tr>
		<td valign="top"><label for="name">Password Baru </label>
		<td><?php echo form_error('pass_baru'); ?><input type="password" name="pass_baru" value="" class="lekuk" value="" size="60" /></td>
	</tr>
	<tr>
		<td valign="top"><label for="name">Konfirmasi Password Baru </label></td>
		<td><?php echo form_error('conf_pass_baru'); ?><input type="password" name="conf_pass_baru" value="" class="lekuk" value="" size="60" /></td>
	</tr>
	<tr>
		<td colspan=2 align="right"><?php endforeach; ?>
		<button type="submit" class="add">Simpan</button> <button class="cancel">Cancel</button></td>
		<?php echo form_close(); ?>
	</tr>
	</table><br>
</div>
<!-- end of content right -->