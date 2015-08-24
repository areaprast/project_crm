<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Paweł 'kilab' Balicki - kilab.pl" />
<title>ArPa CRM | Administrator - <?php echo"$judul"; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>template/admin/css/login.css" media="screen" />
</head>
<body>
<div class="wrap">
	<div id="content">
		<div id="main">
			<div class="full_w"><br>
				<p align="center"><font color="red"><?php 
				if($this->session->flashdata('pesan_login_admin')) {
					echo $this->session->flashdata('pesan_login_admin'); 
				}?></font></p>
				<?php echo form_open('admin/main/login'); ?>
					<label>Username:</label>
					<input name="user_admin" class="text" />
					<label>Password:</label>
					<input name="pass_admin" type="password" class="text" />
					<div class="sep"></div>
					<button type="submit" class="ok" name="login">Login</button> <a class="button" href="">Lupa password?</a>
				<?php echo form_close(); ?>
			</div>
			<div class="footer">&raquo; <a href="http://crmdemo.arpa.web.id">http://arpa.web.id</a> | Admin Panel</div>
		</div>
	</div>
</div>

</body>
</html>