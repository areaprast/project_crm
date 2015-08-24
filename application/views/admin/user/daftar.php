<!-- MAIN CONTENT -->
<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<h2>Selamat Datang di <?php echo"$judul"; ?></h2>
			<p>Anda dapat menambah, mengubah dan menghapus User yang ada di daftar.</p>
			<?php 
				
				if($this->db->count_all_results()){ }
				$this->db->like('status_user','0');
				$this->db->from('tb_user');
				echo '<div class="n_warning"><p><font color="red">&nbsp;Ada '.$this->db->count_all_results().' user belum Aktif.</font></p></div>'; 
			?> 
			<?php 
				if($this->session->flashdata('sukses_user')) {
					echo '<div class="n_ok"><p>&nbsp;'.$this->session->flashdata('sukses_user'),'</p></div>'; 
			}?>
			<?php 
				if($this->session->flashdata('error_user')) {
					echo '<div class="n_error"><p>&nbsp;'.$this->session->flashdata('error_user'),'</p></div>'; 
			}?>
		<div class="entry">
			<div class="sep"></div>
		</div>
		<table>
		
			<thead>
			<tr>
			<th scope="col" style="width: 15px;">No</th>
			<?php foreach($fields as $field_name => $field_display): ?>
			<th scope="col" <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
			<?php echo anchor("/admin/user/index/$field_name/".(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc'), $field_display); ?>
			</th>
			<?php endforeach; ?>
			<th scope="col" style="width: 50px;">Modify</th>
			</tr>
			</thead>
		
			<tbody>
			<?php $n=1; foreach($users as $row): ?>
				<tr>
					<td><?php echo $n;?></td>
					
					<?php foreach($fields as $field_name => $field_display): ?>
						<td>
						<?php echo ucwords($row->$field_name); ?>
						</td>
					<?php endforeach; ?>
								
					<td>
						<!--<a href="<?php echo base_url().'index.php/admin/user/detail/'.$row->id_user;?>" class="table-icon archive" title="Detail"></a>-->
					<?php if($this->session->userdata('level_admin') == 1){
						if($row->level_user != 0) { ?>
							<a href="<?php echo base_url().'index.php/admin/user/detail/'.$row->id_user;?>" class="table-icon edit" title="Edit"></a>
							<a href="<?php echo base_url().'index.php/admin/user/hapus/'.$row->id_user;?>" class="table-icon delete" title="Delete" onClick="return confirm('Anda yakin akan menghapus User <?php echo ucwords($row->nama_user); ?> ?')"></a>
						<?php } else { echo '';}?>
					<?php } elseif($this->session->userdata('level_admin') == 0){ ?>
							<a href="<?php echo base_url().'index.php/admin/user/detail/'.$row->id_user;?>" class="table-icon edit" title="Edit"></a>
							<a href="<?php echo base_url().'index.php/admin/user/hapus/'.$row->id_user;?>" class="table-icon delete" title="Delete" onClick="return confirm('Anda yakin akan menghapus User <?php echo ucwords($row->nama_user); ?> ?')"></a>
					<?php } ?>
					</td>
				</tr>
			<?php $n++; endforeach; ?>
			</tbody>
			
		</table>
		<div class="entry">
			<div class="pagination">
				<?php echo $this->pagination->create_links(); ?>
				<div class="sep"><br></div>	
			</div>
			* Kode Level :
			<ul>
				<li> 0 = Administrator</li>
				<li> 1 = Customer Service (CS)</li>
				<li> 2 = User/Member</li>				
			</ul>
			<div class="sep"><br></div>	
		</div>
	</div>
</div>
<div class="clear"></div>
<!-- END MAIN CONTENT -->