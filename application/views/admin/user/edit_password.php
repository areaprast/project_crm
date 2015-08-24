<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>									
	<?php 
	if($this->session->flashdata('edit_pass')) {
		echo '<div class="n_error"><p><font color="red">&nbsp;'.$this->session->flashdata('edit_pass').'</font></p></div>'; 
	}?>
		
	<?php foreach($user as $row):?>	
	<?php echo form_open_multipart('admin/user/edit_password') ?>
	<div class="element">
		<label for="name">Nama User</label>
		<input disabled id="name" name="nama_user" class="lekuk" value="<?php echo($row->nama_user);?>" size="60" />
		<input hidden name="nama_user" value="<?php echo($row->nama_user);?>"/>
		<input hidden name="id_user" value="<?php echo($row->id_user);?>"/>
	</div>
	<div class="element">
		<label for="name">Password Lama</label>
		<?php echo form_error('pass_lama'); ?><input type="password" id="name" name="pass_lama" class="lekuk" value="" size="60" />
	</div>
	<div class="element">
		<label for="name">Password Baru </label>
		<?php echo form_error('pass_baru'); ?><input type="password" name="pass_baru" value="" class="lekuk" value="" size="60" />
	</div>
	<div class="element">
		<label for="name">Konfirmasi Password Baru </label>
		<?php echo form_error('conf_pass_baru'); ?><input type="password" name="conf_pass_baru" value="" class="lekuk" value="" size="60" />
	</div>
	<div class="entry">
		<?php endforeach; ?>
		<button type="submit" class="add">Simpan</button> <button class="cancel">Cancel</button></td>
		<?php echo form_close(); ?>
	</div>
<div class="clear"></div>
<br><br><br>	
<div class="clear"></div>
</div>