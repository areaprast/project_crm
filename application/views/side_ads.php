<div class="content_left_section">
	<h1>Sponsor</h1>
	<ul>
	<?php foreach($sponsor as $row):?>
		<li><a href="http://<?php echo $row->link_sponsor ?>/" target="_blank"><img src="<?php echo base_url() ?>images/sponsor/<?php echo $row->images_sponsor;?>" width="160px" height="160px"></a></li>
	<?php endforeach; ?>
	</ul>
</div>