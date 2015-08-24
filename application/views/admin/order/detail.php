<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
		<?php if($this->session->flashdata('sukses_update_order')) { 
		 echo '<div class="n_ok"><p>&nbsp;'.$this->session->flashdata('sukses_update_order').'</p></div>'; }?>
	<div class="sep"></div>	
	<div class="left">
	<div class="element">
		<p><b>Data Pemesan :</b></p>
		<p><?php foreach($detail as $data): ?>
			<?php foreach ($propinsi->result() as $pro) { 	
				if($pro->id_propinsi == $data['id_propinsi']) {
				 	$propinsi = $pro->nama_propinsi; 
				}
			} ?>
		&nbsp;a/n. <?php echo ucwords($data['nama_depan']).' '.ucwords($data['nama_belakang']); ?><br>
		&nbsp;&nbsp; - <?php echo ucwords($data['alamat']); ?><br>
		&nbsp;&nbsp;<?php echo $propinsi; ?><br>
		&nbsp;&nbsp;<?php echo $data['kode_pos']; ?><br>
		&nbsp;Telp. 0<?php echo $data['phone']; ?></p>
	</div>
	</div>
	<div class="right">
	<div class="element">
		<p><b>Status Pesanan :</b></p>
		<form action="<?php echo site_url(uri_string()); ?>" method="POST">
		<?php 
			$select = array('Pesanan belum diproses, menunggu konfirmasi DP','Pesanan sedang dalam proses','Pesanan dalam proses akhir, menunggu konfirmasi FP','Pembayaran Lunas. Pesanan telah dikirim', 'Selesai','Pesanan dibatalkan');
			echo form_dropdown('status',$select,$data['status_order']);
		?>
		<input type="submit" name="submit" value="Simpan"></input>
		</form>
		<p>* DP senilai 25% dari Total Biaya<br>
		** FP senilai Total Biaya setelah dikurangi DP</p>
	</div>
	</div>
	
<div class="clear"></div>
<br />

	<div class="element">
		<p><b>Detail Pesanan :</b></p>
		<table cellspacing="0" cellpadding="3px">
			<tr>
				<th>ID Order</th>
				<th>Tanggal Belanja</th>
				<th>Jumlah Item</th>
				<th>Total Belanja</th>
			</tr>

			<tr>
				<td align="center"><?php echo $data['id_order']; ?></td>
				<td><?php echo $data['tanggal_masuk']; ?></td>
				<td align="center"><?php echo $data['total_barang']; ?></td>
				<td align="right"> Rp. <?php echo $this->cart->format_number($data['total_biaya']); ?>*</td>
			</tr>
			<tr>
				<td></td>
				<td><b>Rincian Order :: </b></td>
				<td colspan="2" align="right">* Total Belanja sudah termasuk Biaya Kirim 10% </td>
			</tr>
			<tr>
				<td></td>
				<td align="center" style="background-color: #DFDFDF;">Nama Produk</td>
				<td align="center" style="background-color: #DFDFDF;">Jumlah</td>
				<td align="center" style="background-color: #DFDFDF;">Harga</td>
				<td></td>
			</tr>
			<?php foreach($data['detail'] as $detail): ?>
			<tr>
				<td></td>
				<td><?php echo $detail['nama_produk']; ?></td>
				<td align="center"><?php echo $detail['jumlah']; ?></td>
				<td align="right">Rp. <?php echo $this->cart->format_number($detail['subtotal']); ?></td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="4" style="background-color: #AFAFAF;" height="1"></td>
			</tr>
		</table>
	<br><br></div>
	
	<div class="element">
		<p><b>Detail Transaksi :</b></p>
		<table cellspacing="0" cellpadding="3px">
			<tr>
				<th width="12%">Tipe</th>
				<th width="20%">Kode Tansaksi</th>
				<th width="20%">Tanggal Transaksi</th>
				<th width="20%">Jumlah</th>
				<th>Status</th>
			</tr>
			<?php foreach($data['transaksi'] as $trans): ?>
			<tr>
				<form action="<?php echo site_url(uri_string()); ?>" method="POST">
				<?php
					$border = '';
					if ($trans['tanggal_trans'] != '0000-00-00' AND $trans['status_trans'] == 0) {
						$border = 'background-color: #f6a6a6;';
					}
				?> 
				<td style="border-right: 1px solid #ffffff; <?php echo $border; ?>" align="center" height="25"> 
					<?php 
						if ($trans['tipe_trans'] == 'DP') { echo 'Uang Muka<br>(DP)'; } 
						if ($trans['tipe_trans'] == 'FP') { echo 'Pelunasan<br>(FP)'; }
					?> 
				</td>
				<td align="center" style="<?php echo $border; ?>"><a href="#popup"><?php echo $trans['kode_trans']; ?></a></td>
				<td align="center" style="<?php echo $border; ?>"><?php echo $trans['tanggal_trans']; ?></td>
				<td align="right" style="<?php echo $border; ?>">Rp. <?php echo $this->cart->format_number($trans['jumlah_trans']); ?></td>
				<td align="center" style="<?php echo $border; ?>">
					<?php if ($data['status_order'] != 4) { ?>
					<input type="hidden" name="id_trans" value="<?php echo $trans['id_trans']; ?>"/>
					<input type="hidden" name="id_order" value="<?php echo $trans['id_order']; ?>"/>
					<input type="hidden" name="tipe_trans" value="<?php echo $trans['tipe_trans']; ?>"/>
					<?php 
						$select = array('Belum Lunas', 'Lunas');
						echo form_dropdown('status_trans',$select,$trans['status_trans']);
					?>
					<input type="submit" name="update" value="Simpan"></input>
					<? } else {	echo 'Lunas'; } ?>
				</td>
				</form>
			</tr>
			<?php endforeach; ?>	
			<tr>
				<td colspan="5" style="background-color: #AFAFAF;" height="1"></td>
			</tr>
			<tr>
				<td colspan="5" align="right">
					<a href="#popup"> Lihat Bukti Transaksi </a>					
				</td>
			</tr>
		</table>
	<br><br></div>

			<div id="popup">
					<div class="window">					
						<a href="#" class="close-button" title="Close">x</a>
						Data Transaksi Untuk Order : <?php echo $data['id_order']; ?><br>
						<center>a/n <?php echo ucwords($data['nama_depan'].' '.$data['nama_belakang']); ?></center>
						
						<table><tr>
						<?php foreach($data['transaksi'] as $trans): ?>
							<td style="background-color:transparent;">
							<?php if($trans['bukti_trans']) { ?>
								Bukti Transaksi 
								<?php if ($trans['tipe_trans'] == 'DP') { echo 'Uang Muka (DP)'; } if ($trans['tipe_trans'] == 'FP') { echo 'Pelunasan (FP)'; }?><br><br>
								<img src="<?php echo base_url().'images/transaksi/'.($trans['bukti_trans']);?>" width="200px" height="200px">
							<?php } ?>
							</td>
						<?php endforeach; ?>
						</tr></table>
					</div>
			</div>			
	
	<?php endforeach; ?>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->