<!-- start of content right -->
<div id="content_right">
	<h1><?php echo"$judul"; ?></h1>
	
	<?php if ($laporan == array()): ?>
	<p>Belum ada record belanja untuk Anda saat ini.</p>
	<?php else: ?>
	
	<?php if($this->session->flashdata('pesan_order')) { ?>	
		<p><?php echo $this->session->flashdata('pesan_order'); }?></p>
		<p>Silahkan cek status pemesanan dan pembayaran Anda dengan memilih detail order/pemesanan.</p>
	<table cellpadding="6" cellspacing="5" style="width:95%" class="satu" border="2">
		<tr>
			<th>ID Order</th>
			<th>Tanggal Belanja</th>
			<th>Total Barang</th>
			<th>Total Biaya</th>
			<th>Status</th>
			<!--<?php foreach($fields as $field_name => $field_display): ?>
			<th scope="col" <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
			<?php echo anchor("/order/index/$field_name/".(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc'), $field_display); ?>
			</th>
			<?php endforeach; ?>-->
		</tr>
	<?php foreach ($laporan as $item): ?>
		<tr height="30">
			<td rowspan="2" align="center" style="border-bottom: 0;">
				<?php echo anchor(site_url().'/order/detail/'.$item->id_order, '.:: '.$item->id_order.' :: Detail ::.', 'class="active" id="detail"') ?>
			</td>
			<td align="center">
				<?php echo $item->tanggal_masuk; ?>
			</td>
			<td align="center">
				<?php echo $item->total_barang; ?>
			</td>
			<td align="right"> 
				Rp. <?php echo $this->cart->format_number($item->total_biaya); ?>&nbsp;
			</td>
			<td rowspan="2" align="center" style="border-bottom: 0;>
				<?php 
				switch($item->status_order) {
					case '0':
					echo '<font color="orange">Pesanan belum diproses, <br>menunggu konfirmasi DP</font>';
					continue;
					
					case '1':
					echo '<div style="color:green;">Pesanan sedang <br>dalam proses</div>';
					continue;
					
					case '2':
					echo '<div style="color:orange;">Pesanan dalam proses akhir, <br>menunggu konfirmasi FP</div>';
					continue;
					
					case '3':
					echo '<div style="color:blue;">Pembayaran Lunas, <br>pesanan telah dikirim</div>';
					continue;
					
					case '4':
					echo '<div style="color:white;">Selesai</div>';
					continue;
					
					case '5':
					echo '<div style="color:red; background-color:black">Pesanan dibatalkan</div>';
					continue;
				} ?>
			</td>
		</tr>
		<tr height="30">
			<td align="center" style="background-color: #DFDFDF; color: #565656;">Nama Produk</td>
			<td align="center" style="background-color: #DFDFDF; color: #565656;">Jumlah</td>
			<td align="center" style="background-color: #DFDFDF; color: #565656;">Harga</td>
		</tr>
		<?php foreach($item->detail as $det): ?>
		<tr height="30">
			<td style="border-bottom: 0; border-top: 0;"></td>
			<td>&nbsp;<?php echo $det->nama_produk; ?></td>
			<td align="center"><?php echo $det->jumlah; ?></td>
			<td align="right">Rp. <?php echo $this->cart->format_number($det->subtotal); ?>&nbsp;</td>
			<td style="border-bottom: 0; border-top: 0;"></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="5" style="background-color: #AFAFAF;" height="5"></td>
		</tr>
	<?php endforeach; ?>
	</table>
	
	<div class="pagination">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	<?php endif; ?>
	
</div>
<!-- end of content right -->

<!--<script type="text/javascript">
jQuery(function($) {
	$(".active").colorbox({
		width:"500", height:"500", iframe:true,
		onClosed:function(){ location.reload(); }
	});
});
</script>-->