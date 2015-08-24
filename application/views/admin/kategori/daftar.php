		<div id="main">
			<div class="full_w">
				<div class="h_title"><?php echo"$judul"; ?></div>
				<h2>Selamat Datang di Daftar kategori</h2>
				<p>Anda dapat menambah, mengubah dan menghapus kategori yang ada di daftar.</p>
				<?php 
				if($this->session->flashdata('pesan_kategori_admin')) {
					echo '<div class="n_ok"><p>&nbsp;'.$this->session->flashdata('pesan_kategori_admin'),'</p></div>'; 
			}?>
				
				<div class="entry">
					<div class="sep"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th scope="col">Nama Kategori</th>
							<th scope="col" style="width: 45px;">ID</th>
							<th scope="col">Deskripsi</th>
							<th scope="col" style="width: 45px;">Modify</th>
						</tr>
					</thead>
						
					<tbody>
					
                        <?php foreach($kategori->result() as $row):?>
                        <tr>
                            <td><?php echo ucwords($row->nama_kategori);?></td>
                            <td><?php echo($row->id_kategori);?></td>
                            <td><?php echo($row->deskripsi);?></td>
                            <td>
								<a href="<?php echo 'kategori/edit/'.$row->id_kategori;?>" class="table-icon edit" title="Edit"></a>
								<!--<a href="#" class="table-icon archive" title="Archive"></a>-->
								<a href="<?php echo 'kategori/hapus/'.$row->id_kategori;?>" class="table-icon delete" title="Delete" onClick="return confirm('Anda yakin akan menghapus Kategori <?php echo ucwords($row->nama_kategori); ?> ?')"></a>
							</td>
						</tr>
                        <?php endforeach; ?>
						
					</tbody>
				</table>
				<div class="entry">
					<div class="sep"></div>	
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>