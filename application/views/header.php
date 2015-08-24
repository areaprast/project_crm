<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $nama_website['isi_opt'].' - '.$judul ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url() ?>template/user/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="container">
  <!-- start of menu -->
  <div id="menu">
    <ul>
      <li>
		<?php if($this->session->userdata('user_id')){ ?>
		<a href="<?php echo site_url('user') ?>"
		<?php } else { ?>
		<a href="<?php echo base_url() ?>" <?php } if ($judul=="Selamat Datang") { echo 'class="current"'; } else {}; ?> >Beranda</a>
      </li>
	  <li>
		<a href="<?php echo base_url() ?>index.php/produk" <?php if (($judul=="Daftar Produk") or ($judul=="Detail Produk")) { echo 'class="current"'; } else {}; ?> >Produk</a>
      </li>
	  <li>
		<a href="<?php echo base_url() ?>index.php/kategori/all" <?php if (($judul=="Kategori") or ($judul=="Daftar Kategori")) { echo 'class="current"'; } else {}; ?> >Kategori</a>
	  </li>
      <li>
		<a href="<?php echo base_url()?>index.php/home/berita" <?php if (($judul=="Berita") or ($judul=="Baca Berita")) { echo 'class="current"'; } else {}; ?>>Berita</a>
	  </li>
      <li>
		<a href="<?php echo base_url()?>index.php/home/profile" <?php if (($judul=="Profile")) { echo 'class="current"'; } else {}; ?>>Profile</a>
	  </li>
      <li>
		<a href="<?php echo base_url()?>index.php/home/kontak" <?php if (($judul=="Kontak Kami")) { echo 'class="current"'; } else {}; ?>>Kontak Kami</a>
	  </li>	
  </div>
  <!-- end of menu -->
  
  <!-- start of header -->
  <div id="header">
    <div id="special_offers_l">
	  <center>
		<b><span class="style4"><?php echo $nama_website['isi_opt']; ?></span></b><br><br>
		<p><?php echo $slogan_website['isi_opt']; ?></p>
	  </center>
	</div>
    <div id="special_offers">
	  <b><span class="style3">Promo Terbaru</span></b><br><br>
      <p>Dapatkan Diskon <span>25%</span> untuk pemesanan 100 produk.<br><br>
      <a href="#" style="margin-left: 50px;">Selengkapnya...</a> </p>
	</div>
    <div id="new_books">
	  <b><span class="style3">Produk Terbaru</span></b><br><br>
      <ul>
		<?php foreach($produk_laris as $row):?>	
        <li><a href="<?php echo base_url().'index.php/produk/detail/'.$row->id_produk;?>" ><?php echo ucwords($row->nama_produk);?></a></li>
		<?php endforeach; ?>
      </ul>
      <a href="<?php echo base_url().'index.php/produk/'; ?>" style="margin-left: 50px;">Selengkapnya...</a> 
	</div>
  </div>
  <!-- end of header -->