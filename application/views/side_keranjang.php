<div class="content_left_section">
	<h1>Keranjang Belanja</h1>
		<ul>
			<?php if ($cart == array()): ?>
			<li> Keranjang Anda Kosong</li>
			</ul>
			<?php else: ?>
			<?php foreach($cart as $item): ?>
			<li><?php echo $item['name']." (".$item['qty'].")"; ?></li>
			<?php endforeach; ?>
		</ul>
		<div class="buy_now"><a href="<?php echo site_url('home/hapus_keranjang')?>">Hapus Isi</a></div>
		<div class="order_now"><a href="<?php echo site_url('home/cek_keranjang')?>">Cek Order</a></div>
			<?php endif; ?>
</div>