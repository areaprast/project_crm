		<div id="main">
			<div class="full_w">
				<div class="h_title"><?php echo"$judul"; ?></div>
				<h2>Selamat Datang di Daftar Post</h2>
				<p>Anda dapat menambah, mengubah dan menghapus posting yang ada di daftar.</p>
				<?php 
				if($this->session->flashdata('pesan_post_admin')) {
					echo '<div class="n_ok"><p>&nbsp;'.$this->session->flashdata('pesan_post_admin'),'</p></div>'; 
			}?>
				
				<div class="entry">
					<div class="sep"></div>
				</div>
				<table>
					<thead>
						<tr>
							<th scope="col" width="25px">ID</th>
							<th scope="col" width="170px">Judul Post</th>
							<th scope="col">Detail Post</th>
							<th scope="col" style="width: 45px;">Modify</th>
						</tr>
					</thead>
						
					<tbody>
					
                        <?php foreach($post->result() as $row):?>
                        <tr>
                            <td align="center"><?php echo($row->id_post);?></td>
                            <td><?php echo ucwords($row->judul_post);?></td>
                            <td><?php echo substr($row->detail_post,0,300).' ..... ';?></td>
                            <td>
								<a href="<?php echo 'post/edit/'.$row->id_post;?>" class="table-icon edit" title="Edit"></a>
								<!--<a href="#" class="table-icon archive" title="Archive"></a>-->
								<a href="<?php echo 'post/hapus/'.$row->id_post;?>" class="table-icon delete" title="Delete" onClick="return confirm('Anda yakin akan menghapus Posting <?php echo ucwords($row->judul_post); ?> ?')"></a>
							</td>
						</tr>
                        <?php endforeach; ?>
						
					</tbody>
				</table>
				<div class="entry">
					<div class="sep"></div>	
				</div>
		</div>
		<div class="clear"></div>
	</div>