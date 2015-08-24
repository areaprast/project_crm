<!-- start of content right -->
<div id="content_right">
	<h1><?php echo"$judul"; ?></h1>
	<?php foreach($detail as $data): ?>
		<?php if($this->session->flashdata('sukses_upload_bukti')) { 
		 echo '<div style="float:auto;"><p><b>'.strtoupper($this->session->flashdata('sukses_upload_bukti')).'</b></p></div>'; }?>	
		<div style="color:red; float:right;"><b><?php 
			switch($data['status_order']) {
                case '0':
                echo 'Silahkan melakukan pembayaran DP agar pesanan Anda segera diproses.';
                continue;
                
                case '2':
                echo 'Silahkan melakukan pembayaran kedua (FP) agar pesanan Anda segera dikirim.';
                continue;
				
                case '3':
                echo 'Terima Kasih telah melakukan pelunasan, pesanan Andah telah Kami kirim. Silahkan Tunggu.';
                continue;
				
                case '4':
                echo 'Terima Kasih telah melakukan pesanan di tempat Kami.';
                continue;
            } ?></b>
		</div><br><br>
		<?php foreach ($propinsi->result() as $pro) { 	
			if($pro->id_propinsi == $data['id_propinsi']) {
			 	$propinsi = $pro->nama_propinsi; 
			}
		} ?>
		
		<h2><b>Data Pemesan :</b></h2>
		<div style="margin-left: 10px;">
			a/n. <?php echo ucwords($data['nama_depan']).' '.ucwords($data['nama_belakang']); ?><br>
			<div style="margin-left: 20px;">- <?php echo ucwords($data['alamat']); ?><br>
			Kota/Kab. : <?php echo $data['kota']; ?><br>
			Propinsi  : <?php echo $propinsi; ?><br>
			KodePos   : <?php echo $data['kode_pos']; ?><br></div>
			Telp.     : 0<?php echo $data['phone']; ?><br>
		</div><br><br>
		
		<h2><b>Status Pesanan : </b></h2>
		<div class="upper" style="margin-left: 25px;">
		<?php 
			switch($data['status_order']) {
                case '0':
                echo '<div style="color:orange;">Pesanan belum diproses, menunggu konfirmasi DP</div>';
                continue;
                
                case '1':
                echo '<div style="color:green;">Pesanan sedang dalam proses</div>';
                continue;
				
                case '2':
                echo '<div style="color:orange;">Pesanan dalam proses akhir, menunggu konfirmasi FP</div>';
                continue;
                
                case '3':
                echo '<div style="color:blue;">Pembayaran Lunas, pesanan telah dikirim</div>';
                continue;
				
                case '4':
                echo '<div style="color:white;">Selesai</div>';
                continue;
				
                case '5':
                echo '<div style="color:red; background-color:black">Pesanan dibatalkan</div>';
                continue;
            } 
		?></div>				
		<table height="70" style="width:95%" class="satu">
			<tr>
				<td>
					<?php if($data['status_order'] >= 0) { echo '<div style="color:orange;">Menunggu konfirmasi DP</div>';} ?>
				</td>
				<td width="20%">
					<?php if($data['status_order'] > 0) { echo '<div style="color:green;">Proses</div>';} ?>
				</td>
				<td width="20%">
					<?php if($data['status_order'] > 1) { echo '<div style="color:orange;">Menunggu konfirmasi FP</div>';} ?>
				</td>
				<td width="20%">
					<?php if($data['status_order'] > 2) { echo '<div style="color:blue;">Pesanan dikirim</div>';} ?>
				</td>
				<td width="20%" align="center">
					<?php if($data['status_order'] > 3){ echo'<div style="color:white;">Selesai</div>';} ?>
				</td>
			</tr>
		</table><br />

		<h2><b>Detail Pesanan :</b></h2>
		<table cellpadding="6" cellspacing="2" style="width:95%" class="satu">
			<tr>
				<th>Order ID</th>
				<th>Tanggal Belanja</th>
				<th>Jumlah Item</th>
				<th>Total Belanja</th>
			</tr>
			<tr>
				<td align="center" style="border-right: 1px solid #ffffff;" height="25">Detail Order <?php echo $data['id_order']; ?></td>
				<td align="center" style="border-right: 1px solid #ffffff;"><?php echo $data['tanggal_masuk']; ?></td>
				<td align="center" style="border-right: 1px solid #ffffff;"><?php echo $data['total_barang']; ?></td>
				<td align="right"> Rp. <?php echo $this->cart->format_number($data['total_biaya']); ?>*&nbsp;</td>
			</tr>
			<tr>
				<td style="border-right: 1px solid #ffffff; border-bottom: 0; border-top: 0;" height="25"></td>
				<td align="center" style="background-color: #DFDFDF; color: #565656; border-right: 1px solid #ffffff;">Nama Produk</td>
				<td align="center" style="background-color: #DFDFDF; color: #565656; border-right: 1px solid #ffffff;">Jumlah</td>
				<td align="center" style="background-color: #DFDFDF; color: #565656;">Harga</td>
			</tr>
			<?php foreach($data['detail'] as $detail): ?>
			<tr>
				<td style="border-right: 1px solid #ffffff; border-bottom: 0; border-top: 0;" height="25"></td>
				<td style="border-right: 1px solid #ffffff;">&nbsp;<a href="<?php echo base_url() ?>index.php/produk/detail/<?php echo $detail['id_produk'];?>"><?php echo $detail['nama_produk']; ?></a></td>
				<td align="center" style="border-right: 1px solid #ffffff;"><?php echo $detail['jumlah']; ?></td>
				<td align="right">Rp. <?php echo $this->cart->format_number($detail['subtotal']); ?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="4" style="background-color: #AFAFAF;" height="5"></td>
			</tr>
		</table>
			<div style="margin-left: 10px;"><font color="orange">* Total Belanja sudah termasuk biaya pengiriman 10% dari Harga Total pemesanan.</font></div>
		
	<div class="clear"></div>
	<br /><br>
	
	<div class="element">
		<h2><b>Detail Transaksi :</b></h2>
		<table cellpadding="6" cellspacing="1" style="width:95%" class="satu">
			<tr>
				<th width="15%">Tipe</th>
				<th width="24%">Kode Transaksi</th>
				<th width="20%">Tanggal Transaksi</th>
				<th width="23%">Jumlah</th>
				<th>Status</th>
			</tr>
			<?php foreach($data['transaksi'] as $trans): ?>
			<tr>
				<td style="border-right: 1px solid #ffffff;" align="center" height="25"> 
					<?php 
						if ($trans['tipe_trans'] == 'DP') { echo 'Uang Muka<br>(DP)'; } 
						if ($trans['tipe_trans'] == 'FP') { echo 'Pelunasan<br>(FP)'; }
					?> 
				</td>
				<td style="border-right: 1px solid #ffffff;" align="center" height="25"> <?php echo $trans['kode_trans']; ?> </td>
				<td align="center" style="border-right: 1px solid #ffffff;"> <?php echo $trans['tanggal_trans']; ?> </td>
				<td align="right" style="border-right: 1px solid #ffffff;">Rp. <?php echo $this->cart->format_number($trans['jumlah_trans']); ?>&nbsp;</td>
				<td align="center" style="border-right: 1px solid #ffffff;">
				
				<?php 
					switch($trans['status_trans']) {
					case '0':
					echo '<div style="color:red;">BELUM LUNAS</div>';
					continue;
					
					case '1':
					echo '<div style="color:green;">LUNAS</div>';
					continue;
				} ?>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="5" style="background-color: #AFAFAF;" height="5"></td>
			</tr>
			<tr>
				<td colspan=5 align="right" height="25">*Silahkan upload bukti transaksi Anda <a href="#popup">Disini</a> &nbsp;</td>
			</tr>
		</table>
			<div style="margin-left: 10px;"><font color="orange">
			- Baris pertama merupakan DP, baris kedua FP.<br>
			- Lakukan pembayaran dengan mencantumkan kode transaksi dengan benar.<br>
			- Upload bukti pembayaran untuk segera diverifikasi dan diproses pesanan Anda.</font></div>
		<br><br>
	</div>
		
		
				<div id="popup">
					<div class="window">
					
						<a href="#" class="close-button" title="Close">x</a>
						<h2>Data Transaksi<br>Order : <?php echo $data['id_order']; ?></h2>
						
						<center>Bukti Transaksi Anda</center>
						<table><tr>
						<?php foreach($data['transaksi'] as $trans): 
							if(!$trans['bukti_trans']){
						?>
							<br>Tipe Transaksi : <?php if ($trans['tipe_trans'] == 'DP') { echo 'Uang Muka (DP)'; } 
							if ($trans['tipe_trans'] == 'FP') { echo 'Pelunasan (FP)'; }?><br>
							
							<?php echo form_open_multipart('order/upload') ?>
							
							<center><?php echo form_upload('nama_file')?>
							
							<input type="hidden" name="id_order" value="<?php echo $data['id_order']; ?>" />
							<input type="hidden" name="id_trans" value="<?php echo $trans['id_trans']; ?>" />
							<input type="submit" name="upload" value=" Upload " ></input>
							
							<?php echo form_close() ?><br>
						
						<?php } else {?>
							<td><br>Bukti Transaksi <?php if ($trans['tipe_trans'] == 'DP') { echo 'Uang Muka (DP)'; } 
							if ($trans['tipe_trans'] == 'FP') { echo 'Pelunasan (FP)'; }?><br>
							<img src="<?php echo base_url().'images/transaksi/'.($trans['bukti_trans']);?>" width="180px" height="180px"></td>
						<?php } endforeach; ?>
						</tr></table>
						</center>
					
					</div>
				</div>
		
	<?php endforeach; ?>
</div>
<!-- end of content right -->