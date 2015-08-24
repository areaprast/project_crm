<?php if($this->session->flashdata('pesan')): ?>
    <?php echo $this->session->flashdata('pesan'); ?>
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