<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<h2><p>Silahkan menambah user untuk di masukkan ke dalam daftar.</p></h2>
			<p align="center"><?php if($this->session->flashdata('error_tambah')) {
				echo $this->session->flashdata('error_tambah'); 
			}?></p>
		<div class="sep"></div>					
			<?php echo form_open_multipart('admin/user/proses_tambah') ?>		
		<div class="left">
			<div class="element">
				<label for="name">Nama User <span class="red">(required)</span></label>
				<?php echo form_error('nama_user'); ?>
				<input id="name" name="nama_user" class="text err" value="<?php echo set_value('nama_user'); ?>"/>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Email User <span class="red">(required)</span></label>
				<?php echo form_error('email_user'); ?>
				<input id="name" name="email_user" class="text err" value="<?php echo set_value('email_user'); ?>"/>
			</div>
		</div>
		<div class="left">
			<div class="element">
				<img src="<?php echo base_url().'images/user/photo_not_available.jpg'; ?>" width="167px" height="182px"/><br><br>
				<?php echo form_upload('nama_file')?>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Level <span class="red">(required)</span></label>
				<?php echo form_error('level_user'); ?>
				<select name="level_user"> 
					<option value="0">Super Admin</option> 
					<option value="1" selected>Admin</option> 
					<option value="2">User/Member</option> 
				</select> 
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Password <span class="red">(required)</span></label>
				<?php echo form_error('password_user'); ?>
				<input id="name" type="password" name="password_user" class="text err" value="<?php echo set_value('password_user'); ?>"/>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<label for="name">Konfirmasi Password <span class="red">(required)</span></label>
				<?php echo form_error('password_conf'); ?>
				<input id="name" type="password" name="password_conf" class="text err" value="<?php echo set_value('password_conf'); ?>"/>
			</div>
		</div>
		<div class="right">
			<div class="element">
				<button type="submit" class="add">Tambah User</button> <button class="cancel">Cancel</button>
			</div>
		</div>
		<?php echo form_close(); ?>
<div class="clear"></div><br><br><br>
</div>
<!-- END MAIN CONTENT -->
