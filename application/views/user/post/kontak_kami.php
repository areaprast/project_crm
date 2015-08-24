<!-- start of content right -->
<div id="content_right">
   <h1>Kontak Kami</h1>   
   <p>
		<?php if($this->session->flashdata('pesan_kontak')) { 
		 echo $this->session->flashdata('pesan_kontak'); }?>
   </p>
		<?php echo $kontak_website['isi_opt'] ?>	
   <p align="justify">		
		<?php echo form_open('home/kontak'); ?>
		<center>
		<table cellspacing="10">
			<tr>
				<td width="100px">Nama <font color="red">*</font></td><td width="20px">:</td><td width="150px">
				<?php echo form_error('nama_kontak'); ?>
				<input name="nama_kontak" class="lekuk"size="50"></td>
			</tr>
			<tr>
				<td>Email <font color="red">*</font></td><td>:</td><td>
				<?php echo form_error('email_kontak'); ?>
				<input name="email_kontak" class="lekuk"size="50"> </td>
			</tr>		
			<tr>
				<td valign="top">Komentar <font color="red">*</font></td><td valign="top">:</td><td>
				<?php echo form_error('komentar_kontak'); ?>
				<textarea name="komentar_kontak" class="lekuk" rows="5" cols="39"></textarea></td>
			</tr>
			<tr>
				<td valign="top">Kode <font color="red">*</font></td><td valign="top">:</td><td>
				<!--<img src="<?php echo site_url().'/home/captcha'; ?>">-->
				<?=$image;?><br><br><input name="kode" class="lekuk"size="11"></td>
			</tr>
			<tr>
				<td colspan="3" align="right"><button type="submit" class="add">Kirim</button></td>
			</tr>
		</table>
		</center>
		<?php echo form_close(); ?>
   </p>

	<?php $this->load->view('user/produk/produk_terbaru',$this->data) ?>	
	
</div>
<!-- end of content right -->