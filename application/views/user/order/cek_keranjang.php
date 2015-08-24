<!-- start of content right -->
<div id="content_right">
	<h1><?php echo"$judul"; ?></h1>
	
	<?php echo form_open(site_url(uri_string())); ?>
	<table cellpadding="6" cellspacing="2" style="width:95%" border="2" class="satu">
		<tr>
		  <th width="45%">Nama Barang</th>
		  <th align="center" width="10%">Jumlah</th>
		  <th style="text-align:center" width="23%">Harga</th>
		  <th style="text-align:center" width="23%">Subtotal</th>
		</tr>
	<?php $i = 1; ?>
	<?php foreach($this->cart->contents() as $items): ?>
		<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
		<tr height=30>
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
			<?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '3')); ?>
		  </td>
		  <td style="text-align:right">
			Rp. <?php echo $this->cart->format_number($items['price']); ?>&nbsp;
		  </td>
		  <td style="text-align:right">
			Rp. <?php echo $this->cart->format_number($items['subtotal']); ?>&nbsp;
		  </td>
		</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
		<tr height=30>
		  <td colspan="2"></td>
		  <td style="text-align:center; background-color: #333333;">
			<strong>Total</strong>
		  </td>
		  <td style="text-align:right; background-color: #333333;">
			<strong>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></strong>&nbsp;
		  </td>
		</tr>
	</table>
	<button type="submit" class="add">Update</button>
	<div class="order">
		<a href="<?php echo site_url('home/order_now')?>" class="order"><b>Lanjut</b></a>
	</div>
</div>
<!-- end of content right -->