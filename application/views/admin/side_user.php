<div class="box">
	<div class="h_title">&#8250;&nbsp Daftar User</div>
	<?php
	if(($judul=='Daftar User') or ($judul=='Tambah User') or ($judul=='Ubah Detail User') or ($judul=='Edit Password')) 
	{ echo '<ul id="home">'; }
	else echo '<ul>';
	?>	
		<li class="b1"><?php echo anchor('admin/user','User','class="icon users" title="User"');?> <font color="red"><?php 
		$this->db->like('status_user','0');
		$this->db->from('tb_user');
		echo '['.$this->db->count_all_results().']';
		?></font></li>
		<li class="b2"><?php echo anchor('admin/user/proses_tambah','Tambah User','class="icon add_user" title="Tambah User"');?></li>	
		<!--<li class="b1"><a class="icon block_users" href="">Lock users</a></li>-->
	</ul>
</div>