<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>	
			<p align="center"><?php 
				if($this->session->flashdata('sukses_user')) {
					echo '<div class="n_ok"><p>&nbsp;'.$this->session->flashdata('sukses_user').'</p></div>'; 
					echo '<div class="sep"></div>';
			}?></p>
								
			<?php echo validation_errors(); ?>	
			
		<?php foreach($user as $row):?>	
		<?php echo form_open_multipart('admin/user/proses_edit') ?>
			<div class="left">
				<div class="element">
					<label for="name">Nama User <span class="red">(required)</span></label>
					<input disabled name="id_user" value="<?php echo 'ID User : '.($row->id_user);?>" size="7" />
					<input disabled name="nama_user" value="<?php echo($row->nama_user);?>" size="37" /><input hidden name="nama_user" value="<?php echo($row->nama_user);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Email User<span class="red"> (required)</span></label>
					<input id="name" name="email_user" class="text err" value="<?php echo($row->email_user);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Status User<span class="red"> (required)</span></label>
					<select name="status_user"> 
						<option value="0" <?php if(($row->status_user) == 0){ echo 'selected'; } ?>>Belum Aktif</option> 
						<option value="1" <?php if(($row->status_user) == 1){ echo 'selected'; } ?>>Aktif</option>
					</select> 
				</div>
			</div>
			<div class="left">
				<div class="element">
					<img src="<?php echo base_url().'images/user/'.($row->image_user); ?>" width="180px" height="198px"/><br><br>
					<?php echo form_upload('nama_file')?>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Level User </label>
					<?php if($this->session->userdata('level_admin') != 0){ ?>
					<input type="hidden" name="level_user" value="<?php echo($row->level_user);?>" size="30" />
					<select disabled name="level_user">
					<?php } else { ?>
					<select name="level_user"> 
					<?php } ?>
						<option value="0" <?php if(($row->level_user) == 0){ echo 'selected'; } ?>>Administrator</option> 
						<option value="1" <?php if(($row->level_user) == 1){ echo 'selected'; } ?>>Customer Service (CS)</option>
						<option value="2" <?php if(($row->level_user) == 2){ echo 'selected'; } ?>>User/Member</option>
					</select>
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
					<label for="name">Password</label>
					<input disabled type="password" id="name" name="password_user" value="<?php echo($row->password_user);?>" size="26"/>&nbsp; 
					<a href="<?php echo site_url().'/admin/user/edit_password/'.$row->id_user;?>" class="button"> Ubah Password </a>
				</div>
			</div>
		<?php endforeach; ?>
			<input type="hidden" name="id_user" value="<?php echo($row->id_user);?>" size="30" />
			<div class="element">
				<label for="name">Nama Lengkap <span class="red">(required)</span></label>
				<input id="name" name="nama_depan2" class="err" value="<?php echo $nama_depan2;?>" size="30"/>
				<input id="name" name="nama_belakang2" class="err" value="<?php echo $nama_belakang2;?>" size="78"/>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Alamat <span class="red">(required)</span></label>
					<textarea name="alamat2" class="textarea err" rows="6"><?php echo $alamat2;?></textarea>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kode Pos</label>
					<input id="name" name="kode_pos2" class="text err" value="<?php echo $kode_pos2;?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Propinsi</label>
					<input id="name" name="propinsi2" class="text err" value="<?php echo($propinsi2);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">No. Telp. <span class="red">(required)</span></label>
					<input id="name" name="phone2" class="text err" value="<?php echo($phone2);?>"/>
				</div>
			</div>
			<?php //endforeach; ?>
			<?php //}?>
			
			<div class="right">
				<div class="element"><br>
					<button type="submit" class="add">Simpan User</button> <button class="cancel">Cancel</button>
				</div>
			</div>
		<?php echo form_close(); ?>
		
	<!--</div>
</div>-->
<div class="clear"></div>
<br><br><br>	
<div class="clear"></div>
</div>
<!-- END MAIN CONTENT -->