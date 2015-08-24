<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
		<!--<h2>Selamat Datang di <?php echo"$judul"; ?></h2>-->
<?php if ($laporan == array()): ?>
<p>Belum ada record belanja untuk user ini</p>
<?php else: ?>
			
			<?php 
				if($this->session->flashdata('sukses_edit_order')) {
					echo '<div class="n_ok"><p>&nbsp;'.$this->session->flashdata('sukses_edit_order'),'</p></div>'; 
			}?>
		<div class="sep"></div>	

<table cellspacing="0" cellpadding="3px">
    <tr>
        <!--<th>ID Order</th>
        <th>Tanggal Belanja</th>
        <th>Total Barang</th>
        <th>Total Biaya</th>
        <th>Status</th>-->
		<?php foreach($fields as $field_name => $field_display): ?>
			<th scope="col" <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
			<?php echo anchor("/admin/order/index/$field_name/".(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc'), $field_display); ?>
			</th>
		<?php endforeach; ?>
    </tr>
<?php foreach ($laporan as $item): ?>
    <tr>
        <td align="center" style="background-color: #AFAFAF;"><?php echo anchor(site_url().'/admin/order/detail/'.$item->id_order, '.:: '.$item->id_order.' :: Detail ::.', 'class="active" id="detail"') ?></td>
        <td><?php echo $item->tanggal_masuk; ?></td>
        <td align="center"><?php echo $item->total_barang; ?></td>
        <td align="right"> Rp. <?php echo $this->cart->format_number($item->total_biaya); ?></td>
        <td align="center"><?php 		
			switch($item->status_order) {
                case '0':
                echo '<div style="color:orange;">Pesanan belum diproses, <br>menunggu konfirmasi DP</div>';
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
            } 		
		?></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4"><b>Dipesan oleh :: </b><?php echo ucwords($item->nama_depan).' '.ucwords($item->nama_belakang); ?></td>
    </tr>
	<tr>
        <td></td>
        <td align="center" style="background-color: #DFDFDF;">Nama Produk</td>
        <td align="center" style="background-color: #DFDFDF;">Jumlah</td>
        <td align="center" style="background-color: #DFDFDF;">Harga</td>
        <td></td>
    </tr>
    <?php foreach($item->detail as $det): ?>
    <tr>
        <td></td>
        <td><?php echo $det->nama_produk; ?></td>
        <td><?php echo $det->jumlah; ?></td>
        <td>Rp. <?php echo $this->cart->format_number($det->subtotal); ?></td>
        <td></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5" style="background-color: #AFAFAF;" height="0"></td>
    </tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
	
		<div class="entry">
			<div class="pagination">
				<?php echo $this->pagination->create_links(); ?>
			</div>
			<div class="sep"><br></div>	
		</div>
	<br></div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->
<script type="text/javascript">
jQuery(function($) {
	$(".active").colorbox({
		width:"500", height:"500", iframe:true,
		onClosed:function(){ location.reload(); }
	});
});
</script>