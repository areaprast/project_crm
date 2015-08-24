<!-- start of content -->
<div id="content">

    <!-- start of content left -->
    <div id="content_left">	
		<?php if($this->session->userdata('user_id')): ?>
			<?php $this->load->view('side_keranjang') ?>
			<?php $this->load->view('side_login') ?>
		<?php else:?>
			<?php if ($this->data->form_login == true) {
				$this->load->view('side_login'); 
			} ?>	
			<?php $this->load->view('side_keranjang') ?>
		<?php endif ?>
		<?php $this->load->view('side_kategori') ?>
		<?php $this->load->view('side_ads') ?>
	</div>
    <!-- end of content left -->