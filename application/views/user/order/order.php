<!-- start of content right -->
<div id="content_right">
	<?php if (!$this->session->userdata('user_id')){  
		echo '<h1>'.$judul.'</h1>';
		echo '<p>MAAF. Anda Harus Login terlebih dahulu untuk melakukan langkah berikutnya.</p>';
		$this->load->view('user_login',$this->data);
	 } else { ?>
		<h1><?php echo"$judul"; ?></h1>
		<?php if($this->session->flashdata('pesan_order')) { ?>		
		<p><?php echo $this->session->flashdata('pesan_order'); } ?></p>
        <?php echo form_open('home/order_now'); ?>
        <table cellpadding="6" cellspacing="2" style="width:95%" border="2" class="satu">    
			<tr>
			  <th width="45%">Nama Barang</th>
			  <th align="center" width="10%">Jumlah</th>
			  <th style="text-align:center" width="23%">Harga</th>
			  <th style="text-align:center" width="23%">Subtotal</th>
			</tr>        
        <?php $i = 1;$total_item = 0; ?>
        
        <?php foreach($this->cart->contents() as $items): ?>        
        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>        
        	<tr height="30">
        	  <td>&nbsp;
        		<?php echo $items['name']; ?>
				<?php /*if ($this->cart->has_options($items['rowid']) == TRUE): 
					echo '<p>';
					foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value):
						echo '<strong>'.$option_name.':</strong>'.$option_value.'<br>';
					endforeach;
					echo '</p>';
				endif; */?>        
        	  </td>
              <td align="center">
				<?php echo $items['qty']; ?>
			  </td>
        	  <td style="text-align:right">
				Rp. <?php echo $this->cart->format_number($items['price']); ?>&nbsp;
			  </td>
        	  <td style="text-align:right">
				Rp. <?php echo $this->cart->format_number($items['subtotal']); ?>&nbsp;
			  </td>
        	</tr>       
        <?php $i++;$total_item = $total_item + $items['qty']; ?>        
        <?php endforeach; ?>        
			<tr height="30">
			  <td colspan=2 rowspan=3 style="border-bottom:0;">
				  <p>&nbsp;
				* Pembayaran dilakukan 2 kali dengan ketentuan :
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				- DP senilai 25% dari Total Biaya
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				- FP senilai Total Biaya setelah</p>
			  </td>
			  <td style="text-align:center; background-color: #333333;">
				<strong>Total Belanja</strong>
			  </td>
			  <td style="text-align:right; background-color: #333333;">
				<strong>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></strong>&nbsp;
			  </td>
			</tr>   
			<tr height="30">
			  <td style="text-align:center; background-color: #333333;">
				<strong>Biaya Kirim 10%</strong>
			  </td>
			  <td style="text-align:right; background-color: #333333;">
				<strong>Rp. <?php echo $this->cart->format_number($this->cart->total()*10/100); ?></strong>&nbsp;
			  </td>
			</tr> 
			<tr height="30">
			  <td style="text-align:center; background-color: #333333;">
				<strong>Total</strong>
			  </td>
			  <td style="text-align:right; background-color: #333333;">
				<strong>Rp. <?php echo $this->cart->format_number($this->cart->total()*10/100+$this->cart->total()); ?></strong>&nbsp;
			  </td>
			</tr> 				
        </table><br>
        
        <h1>Alamat Pengiriman</h1>
		<?php echo form_hidden('total_barang',$total_item); ?>
		<table style="width:80%" class="nol"  cellpadding="6" cellspacing="5">
			<tr  valign="top">
				<td width="30%">Nama Lengkap</td>
				<td>: </td>
				<td>
				<?php 
					echo form_error('nama_depan');
					echo form_input('nama_depan',$nama_depan,'class="lekuk1"'); 
					echo '&nbsp;';
					echo form_input('nama_belakang',$nama_belakang,'size=25 class="lekuk1"'); 
				?></td>
			</tr>
			<tr valign="top">
				<td>No. Telp.</td>
				<td>: </td>
				<td>
				<?php 
					echo form_error('phone');
					echo form_input('phone',$phone,'class="lekuk1"'); ?></td>
			</tr>
			<tr valign="top" class="ratakiri">
				<td>Alamat</td>
				<td>: </td>
				<td>
				<?php 
					echo form_error('alamat');
					echo form_textarea('alamat',$alamat,'class="lekuk1"'); ?></td>
			</tr>
			<tr>			
				<td>KodePos</td>
				<td>: </td>
				<td>
				<?php echo form_input('kode_pos',$kode_pos,'class="lekuk1"'); ?></td>
			</tr>
			<tr>
				<td>Kota/Kab.</td>
				<td>: </td>
				<td>
				<?php echo form_input('kota',$kota,'class="lekuk1"'); ?></td>
			</tr>
			<tr>
				<td>Propinsi</td>
				<td>: </td>
				<td><select name="id_propinsi" class="lekuk" > 
					<?php foreach ($propinsi->result() as $pro) { ?>	
						<option value="<?php echo $pro->id_propinsi; ?>" <?php if($pro->id_propinsi == $id_propinsi){ echo 'selected'; } ?> > <?php echo $pro->nama_propinsi; ?> </option> 
					<?php } ?>
				</select></td>				
			</tr>
			<tr>
				<td colspan=3 align="right"><button type="submit" class="add">Lanjutkan</button></td>
			</tr>
		</table><br>
				
		<?php  echo form_close(); ?>		
    <?php }; ?>
</div>
<!-- end of content right -->