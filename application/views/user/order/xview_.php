<html>
<title>
	Upload Bukti Transaksi
</title>
<body style="background: #1c1c1b;">
	<div style="
		float: none;		
		border: 4px solid #F3F3F3;
		border-radius: 7px;
		background: #404743;
		width: 410px;
		height: 40px;
		padding: 15px 10px 10px 10px;
		display: inline-block; 
		margin: 20px 20px 20px 20px; ">		
		tes		
		<?php //foreach($detail['transaksi'] as $trans): ?>
		<?php echo form_open_multipart('order/upload') ?>
		<?php //$id_trans = $trans['id_trans'];
			//echo $id_trans;
		?>
		<center><?php echo form_upload('nama_file')?>
		<input type="submit" name="upload" value="Upload" ></input> <input type="submit" name="cancel" value="Cancel" onclick="self.close()"></input></center>
		<?php echo form_close() ?>
		<?php //endforeach; ?>	
	</div>
</body>
</html>