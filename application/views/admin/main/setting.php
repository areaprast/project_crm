<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
		
		<?php 
			if($this->session->flashdata('web_setting')) {
				echo $this->session->flashdata('web_setting'); 
				echo '<div class="sep"></div>';
			}
		?>
			
		<?php echo validation_errors(); ?>	
		<?php echo form_open_multipart('admin/main/setting') ?>
		<?php echo form_fieldset('&nbsp;Pengaturan Website&nbsp;');?>			
				<div class="element">
					<label for="name">Nama Website </label>
					<input id="name" name="nama_website" class="text" value="<?php echo @$nama_website['isi_opt'];?>"/>
				</div>
				<div class="element">
					<label for="name">Slogan Website</label>
					<input id="name" name="slogan_website" class="text" value="<?php echo @$slogan_website['isi_opt'];?>"/>
				</div>
			<div class="left">	
				<div class="element">
					<label for="name">Gambar Logo</label>
					<img src="<?php echo base_url().'images/produk/'.$logo_website['isi_opt']; ?>" width="230px" height="110px"/><br><br>
					<?php echo form_upload('nama_file')?>
					<?php //echo $row->image_produk; ?>
				</div>
			</div>
			<div class="right">
				<div class="element">
					<label for="name">Deskripsi</label>
					<textarea name="deskripsi_website" class="textarea" rows="11"><?php echo @$deskripsi_website['isi_opt'];?></textarea>
				</div>
			</div>
			<div class="right">	
				<div class="entry">
					<div class="button" style="margin-left: 170px;"><input type="submit" name="setting" value="Simpan" style="border:0; background: #F3F3F3; cursor: pointer; font: 700 11px Tahoma, Arial, sans-serif; color: #444444;border-radius: 0; padding: 0;"></input></div>
				</div>
			</div>
		<?php echo form_fieldset_close();?>
		<?php echo form_close(); ?>
		
		
		<?php echo validation_errors(); ?>	
		<?php echo form_open_multipart('admin/main/setting') ?>
		<?php echo form_fieldset('&nbsp;Profile Website&nbsp;');?>
				<div class="element">
					<label for="name">Profile </label>
					<textarea name="profile_website" class="textarea artikel" rows="7"><?php echo @$profile_website['isi_opt'];?></textarea>
				</div>	
				<div class="element">
					<label for="name">Visi </label>
					<textarea name="visi_website" class="textarea artikel" rows="5"><?php echo @$visi_website['isi_opt'];?></textarea>
				</div>	
				<div class="element">
					<label for="name">Misi </label>
					<textarea name="misi_website" class="textarea artikel" rows="5"><?php echo @$misi_website['isi_opt'];?></textarea>
				</div>	
				<div class="entry">
					<div class="button" style="float: right;"><input type="submit" name="profile" value="Simpan" style="border:0; background: #F3F3F3; cursor: pointer; font: 700 11px Tahoma, Arial, sans-serif; color: #444444;border-radius: 0; padding: 0;"></input></div>
				</div>

		<?php echo form_fieldset_close();?>
		<?php echo form_close(); ?>
		
		<?php echo validation_errors(); ?>	
		<?php echo form_open_multipart('admin/main/setting') ?>
		<?php echo form_fieldset('&nbsp;Kontak Website&nbsp;');?>
				<div class="element">
					<label for="name">Kontak Kami </label>
					<textarea name="kontak_website" class="textarea artikel" rows="7"><?php echo @$kontak_website['isi_opt'];?></textarea>
				</div>	
				<div class="entry">
					<div class="button" style="float: right;"><input type="submit" name="kontak" value="Simpan" style="border:0; background: #F3F3F3; cursor: pointer; font: 700 11px Tahoma, Arial, sans-serif; color: #444444;border-radius: 0; padding: 0;"></input></div>
				</div>

		<?php echo form_fieldset_close();?>
		<?php echo form_close(); ?>
	</div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
