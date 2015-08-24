<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<div class="sep"></div>
			
		<?php foreach($user->result() as $row):?>		
		<?php echo form_open_multipart('admin/user/edit_user/'.$row->id_user) ?>	
			
			<div class="left">
				<div class="element">
					<label for="name">ID User </label>
					<input disabled name="id_user" value="<?php echo($row->id_user);?>" size="10" />
				</div>
			</div>
			<div class="right">
				<div class="element">	
					<label for="name">Nama User </label>
					<input disabled id="name" name="nama_user" value="<?php echo($row->nama_user);?>" size="50" />
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Email User</label>
					<input disabled id="name" name="email_user" value="<?php echo($row->email_user);?>" size="50"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Status User</label>
					<input disabled id="name" name="status_user" value="<?php echo($row->status_user);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<img src="<?php echo base_url().'images/user/'.($row->image_user); ?>" width="150px" height="150px"/><br><br>
				</div>
			</div>
			<div class="left">
				<div class="element">
				<label for="name">Level User </label>
					<input disabled id="name" name="levl_user" value="<?php 
					if ($row->level_user == 0){echo 'Administrator';
					} else if ($row->level_user == 1) {
					echo 'Customer Service';
					} else {
					echo 'User/Member';}
					?>"  size="50"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kunjungan Terakhir</label>
					<input disabled id="name" name="last_visit" value="<?php echo($row->last_visit);?>" size="50"	/>
				</div>
			</div>
			<div class="entry">&nbsp<br>
				<button type="submit" class="add">Ubah User</button>
			</div>
		<?php echo form_close(); ?>
		<?php endforeach; ?>
		
		<div class="sep"></div>
		<?php if(!$userdata) { ?>
			<center>Data user belum lengkap</center><br>
		<?php } else { ?>
		<?php foreach($userdata->result() as $row):?>		
		<?php echo form_open_multipart('admin/user/edit_user_detail/'.$row->id_user) ?>	
			<div class="left">
				<div class="element">	
					<label for="name">Nama Lengkap</label>
					<input disabled id="name" name="nama_depan" value="<?php echo($row->nama_depan);?>"/>
					<input disabled id="name" name="nama_belakang" value="<?php echo($row->nama_belakang);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">No. Telp.</label>
					<input disabled id="name" name="phone" value="<?php echo($row->phone);?>"/>
				</div>
			</div>
			<div class="left">
				<div class="element">
					<label for="name">Alamat</label>
					<textarea disabled name="alamat" class="textarea" rows="10"><?php echo($row->alamat);?></textarea>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Kode Pos</label>
					<input disabled id="name" name="kode_pos" value="<?php echo($row->kode_pos);?>"/>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Propinsi</label>
					<input disabled id="name" name="propinsi" value="<?php echo($row->propinsi);?>"/>
				</div>
			</div>
			<div class="entry">&nbsp<br>
				<button type="submit" class="add">Ubah Detail User</button>
			</div>
		<?php echo form_close(); ?>
		<?php endforeach; }?>
		
	</div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
