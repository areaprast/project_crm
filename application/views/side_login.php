<div class="content_left_section">	
	<?php if($this->session->userdata('user_id')): ?>
		<h1>Selamat Datang</h1>
		<?php echo ucwords($this->session->userdata('username'));?>,<br>
		<?php echo $this->session->flashdata('pesan_user'); ?>
		
		<?php if (($this->session->userdata('status')) == 1) {
			echo '- Status Aktif.<br>'; 
			} else { 
			echo '- Status Belum Aktif.<br>'; 
		}?>
		
		Terima Kasih anda sudah login.<br>
		<?php echo 'Tanggal '.date("d-m-Y H:i:s"); ?>
		
		<div class="buy_now">
			<a href="<?php echo site_url('user/profile_user')?>">Profile</a>
		</div>
		<div class="order_now">
			<a href="<?php echo site_url('home/logout')?>">Logout</a>
		</div>
		<div class="buy_now">
			<a href="<?php echo site_url('order/')?>">Order</a>
		</div>&nbsp;
	<div class="cleaner"></div>
	<?php else:?>
		<h1>Silahkan Login</h1>
		<?php echo $this->session->flashdata('pesan_login'); ?>	
		<?php echo form_open('home/login'); ?>
		<label>Username</label>
		<?php echo form_error('username'); ?><br>
		<input name="username" class="lekuk" size="23"/><br>
		<label>Password</label>
		<?php echo form_error('password'); ?><br>
		<input type="password" name="password" class="lekuk" size="23"/><br><br>
		<button type="submit" name="login" class="add">Masuk</button>
		<?php echo form_close(); ?>
		Anda belum memiliki akun? Silakan daftar <a href="<?php echo site_url('user/daftar') ;?>">disini</a>.<br>
	<?php endif ?>
</div>