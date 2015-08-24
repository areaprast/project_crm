<!-- start of content right -->
<div id="content_right">
<h1><?php echo"$judul"; ?></h1>		
	<?php if (($this->session->userdata('level') == 1) OR ($this->session->userdata('level') == 0)){  
		echo 'MAAF. Anda tidak diperbolehkan edit akun anda disini, silahkan login di halaman <a href="'.site_url().'/admin">admin</a>.';
	 } else {  ?>
	<?php echo validation_errors(); ?>
	<h2><center>
		<?php 
			if($this->session->flashdata('sukses_edit')) {
				echo $this->session->flashdata('sukses_edit'); 
			}
		?>
	</center></h2>
	
	<?php foreach($user as $row):?>	
	<?php echo form_open_multipart('user/proses_edit') ?>
	<table style="width:90%" class="dua">
	<tr>
		<td colspan=4>&nbsp;</td>
	</tr>
	<tr>
		<td rowspan=13 width=10></td>
		<td><label for="name">Nama User </label></td>
		<td><input disabled name="id_user" value="<?php echo 'ID User : '.($row->id_user);?>" size="10" class="lekuk" />
		<input disabled id="name" name="nama_user" class="lekuk" value="<?php echo($row->nama_user);?>" size="43" />
		<input hidden name="nama_user" value="<?php echo($row->nama_user);?>"/></td>
	</tr>
	<tr>
		<td><label for="name">Email User </label></td>
		<td><input id="name" name="email_user" class="lekuk" value="<?php echo($row->email_user);?>" size="60" /></td>
	</tr>
	<tr>
		<td><label for="name">Status User </label>
		<td><select disabled name="status_user" class="lekuk"> 
				<option value="0" <?php if(($row->status_user) == 0){ echo 'selected'; } ?>> Belum Aktif </option> 
				<option value="1" <?php if(($row->status_user) == 1){ echo 'selected'; } ?>> Aktif</option>
		</select>
		<input hidden name="status_user" value="<?php echo($row->status_user);?>"/></td>
	</tr>
	<tr>
		<td colspan=2 align="center"><img src="<?php echo base_url().'images/user/'.($row->image_user);?>" class="lekuk" width="180px" height="198px"/><br><br>					<?php echo form_upload('nama_file')?>
		</td>
	</tr>
	<tr>
		<td><label for="name">Level User </label></td>
		<td><select disabled name="level_user" class="lekuk" > 
				<option value="0" <?php if(($row->level_user) == 0){ echo 'selected'; } ?>> Administrator </option> 
				<option value="1" <?php if(($row->level_user) == 1){ echo 'selected'; } ?>> Customer Service (CS) </option>
				<option value="2" <?php if(($row->level_user) == 2){ echo 'selected'; } ?>> User/Member </option>
		</select><input hidden name="level_user" value="<?php echo($row->level_user);?>"/>
		</td>
	</tr>
	<tr>
		<td><label for="name">Kunjungan Terakhir</label></td>
		<td><input disabled id="name" name="last_visit" value="<?php echo($row->last_visit);?>" size="30" class="lekuk"/></td>
	</tr>
	<tr>
		<td><label for="name">Password</label></td>
		<td><input disabled type="password" id="name" name="password_user" value="<?php echo($row->password_user);?>" class="lekuk" size="30"/> <a href="edit_password"> Ubah Password </a></td>
	</tr>
	<tr>
		<td><input type="hidden" name="id_user" value="<?php echo($row->id_user);?>" size="30" />
			<label for="name">Nama Lengkap <font color="red">(required)</font></label></td>
		<td><input id="name" name="nama_depan2" class="lekuk" value="<?php echo $nama_depan2;?>" size="20"/>
			<input id="name" name="nama_belakang2" class="lekuk" value="<?php echo $nama_belakang2;?>" size="33"/>
		</td>
	</tr>
	<tr>
		<td valign="top"><label for="name">Alamat <font color="red">(required)</font></label></td>
		<td><textarea name="alamat2" class="lekuk" cols="46" rows="6" size="200"><?php echo $alamat2;?></textarea></td>
	</tr>
	<tr>
		<td><label for="name">Kode Pos</label></td>
		<td><input id="name" name="kode_pos2" class="lekuk" value="<?php echo $kode_pos2;?>" size="30"/></td>
	</tr>
	<tr>
		<td><label for="name">Kota/Kab.</label></td>
		<td><input id="name" name="kota2" class="lekuk" value="<?php echo($kota2);?>" size="30"/></td>
	</tr>
	<tr>
		<td><label for="name">Propinsi</label></td>
		<td><select name="id_propinsi2" class="lekuk" > 
			<?php foreach ($propinsi->result() as $pro) { ?>	
				<option value="<?php echo $pro->id_propinsi; ?>" <?php if($pro->id_propinsi == $id_propinsi2){ echo 'selected'; } ?> > <?php echo $pro->nama_propinsi; ?> </option> 
			<?php } ?>
		</select>
		</td>
	</tr>
	<tr>
		<td><label for="name">No. Telp. <font color="red">(required)</font></label></td>
		<td><input id="name" name="phone2" class="lekuk" value="<?php echo($phone2);?>" size="30"/></td>
	</tr>
	<tr>
		<td colspan=2 align="right">
		<?php endforeach; ?>
		<button type="submit" class="add">Simpan</button> <button class="cancel">Cancel</button></td>
		<?php echo form_close(); ?>
	</tr>
	</table><br><?php } ?>
</div>
<!-- end of content right -->