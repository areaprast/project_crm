<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Pawel 'kilab' Balicki - kilab.pl" />
<title><?php echo $nama_website['isi_opt'];?> | Administrator - <?php echo"$judul"; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>template/admin/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>template/admin/css/navi.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>template/admin/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/admin/js/jcrop.js"></script>
<script type="text/javascript">
$(function(){
	$(".box .h_title").not(this).next("ul").hide("normal");
	$(".box .h_title").not(this).next("#home").show("normal");
	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>
<script type="text/javascript" src="<?php echo base_url();?>template/admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>template/admin/js/tinymce/tiny-config.js"></script>
</head>
<body>
<!-- BODY -->
<div class="wrap">
	<!-- HEADER -->
	<div id="header">
		<div id="top">
			<div class="left">
				<p><a href="<?php echo site_url('admin')?>">Selamat Datang</a>, <strong><?php echo ucwords($this->session->userdata('user_admin')) ?></strong> [ <a href="<?php echo site_url('admin/main/logout')?>">logout</a> ]</p>
			</div>
			<div class="right">
				<div class="align-right">
					<p>Last login: <strong>23-04-2012 23:12</strong></p>
				</div>
			</div>
		</div>
		<div id="nav">
			<ul>
				<li class="upp"><a href="#">Website</a>
					<ul>
						<li>&#8250; <a href="<?php echo site_url(); ?>" target="_blank">Kunjungi Website</a></li>
						<li>&#8250; <a href="<?php echo site_url().'/admin'; ?>">Statistik</a></li>
					</ul>
				</li>
				<!-- <li class="upp"><a href="#">Manage content</a>
					<ul>
						<li>&#8250; <a href="">Show all pages</a></li>
						<li>&#8250; <a href="">Add new page</a></li>
						<li>&#8250; <a href="">Add new gallery</a></li>
						<li>&#8250; <a href="">Categories</a></li>
					</ul>
				</li>
				<li class="upp"><a href="#">Users</a>
					<ul>
						<li>&#8250; <a href="">Show all uses</a></li>
						<li>&#8250; <a href="">Add new user</a></li>
						<li>&#8250; <a href="">Lock users</a></li>
					</ul>
				</li> -->
				<li class="upp"><a href="#">Pengaturan</a>
					<ul>
						<li>&#8250; <a href="<?php echo site_url().'/admin/main/profile'; ?>">Profile</a></li>
						<li>&#8250; <a href="<?php echo site_url().'/admin/main/kontak'; ?>">Kontak</a></li>
						<li>&#8250; <a href="<?php echo site_url().'/admin/main/setting'; ?>">Website</a></li>
						<li>&#8250; <a href="<?php echo site_url().'/admin/main/server'; ?>">Database dan Server</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- END HEADER -->
	
	<!-- CONTENT -->
	<div id="content">