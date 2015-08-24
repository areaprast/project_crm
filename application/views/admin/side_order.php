<div class="box">
	<div class="h_title">&#8250;&nbsp Daftar Order</div>
	<?php
	if(($judul=='Daftar Order') OR ($judul=='Detail Order') OR ($judul=='Order Terbaru')) 
	{ echo '<ul id="home">'; }
	else echo '<ul>';
	?>	
		<li class="b1"><?php echo anchor('admin/order','Semua Order','class="icon page" title="Semua Order"');?></li>
		<li class="b1"><?php echo anchor('admin/order/order_baru','Order Terbaru','class="icon add_page" title="Order Terbaru"');?> <font color="red"><?php 
		$this->db->like('status_order','0');
		$this->db->from('tb_order');
		echo '['.$this->db->count_all_results().']';
		?></font></li>
		<li class="b1"><?php echo anchor('admin/order/order_baru','Konfirmasi Pembayaran','class="icon category" title="Konfirmasi Pembayaran"');?> <font color="red"><?php 
		$this->db->like('status_order','2');
		$this->db->from('tb_order');
		echo '['.$this->db->count_all_results().']';
		?></font></li>
		<li class="b2"><a class="icon report" href="">Order Selesai</a></li>
	</ul>
</div>