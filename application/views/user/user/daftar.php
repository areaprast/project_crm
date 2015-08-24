<!-- start of content right -->
<div id="content_right">
<h1><?php echo"$judul"; ?></h1>
<?php if(@$sukses):?>
    Terima Kasih. 
	<?php echo $sukses; ?>
    Anda bisa berbelanja setelah status anda aktif.
<?php else: ?>
	<table style="width:70%" class="dua">
	<tr>
		<td colspan=5 align="center" height="50">
		<h2><u>_FORM PENDAFTARAN_</u></h2>
		</td>
    </tr>
	<tr>
		<td colspan=5>
		<?php if(@$error){echo @$error;} ?>
		<?php echo form_open('user/daftar'); ?>
		</td>
	</tr>
	<tr valign="top">
		<td width="5%"> </td>
		<td width="35%">Username</td>
		<td width="5%">:</td>
		<td><?php 
			echo form_error('username_daftar');
			echo form_input('username_daftar',$username_daftar,'class="lekuk" size=30'); 
		?></td>
		<td width="5%"> </td>
	</tr>
    <tr valign="top">
		<td> </td>
		<td>Email</td>
		<td>:</td>
		<td><?php 
			echo form_error('email_daftar');
			echo form_input('email_daftar',$email_daftar,'class="lekuk" size=30'); 
		?></td>
		<td> </td>
	</tr>
    <tr valign="top">
		<td> </td>
		<td>Password</td>
		<td>:</td>
		<td><?php echo form_error('password_daftar'); ?>
			<input type="password" name="password_daftar" class="lekuk" size="30"/>
		</td>
		<td> </td>
	</tr>
    <tr valign="top">
		<td> </td>
		<td>Konfirmasi Password</td>
		<td>:</td>
		<td><?php echo form_error('conf_password'); ?><input type="password" name="conf_password" class="lekuk" size="30"/></td>
		<td> </td>
	</tr>
	<tr>
		<td colspan=4 align="right"><br>
		<button type="submit" name="daftar" class="add">Daftar</button></td>
		<td> </td>
    <?php echo form_close(); ?>
	</table>
    <br />
<?php endif ?>

	<?php $this->load->view('user/produk/produk_terbaru',$this->data) ?>
</div>
<!-- end of content right -->