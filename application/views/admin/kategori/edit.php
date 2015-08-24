<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
			<h2>Edit kategori</h2>
			<p>Silahkan mengubah kategori.</p>
			<div class="sep"></div>
		<?php echo form_open('admin/kategori/proses_edit') ?>
		<?php foreach($kategori->result() as $row):?>			
			<div class="element">
				<label for="name">Nama Kategori <span class="red">(required)</span></label>
				<input type="hidden" name="id_kategori" value="<?php echo($row->id_kategori);?>" size="30" />
				<input id="name" name="nama_kategori" class="text err" value="<?php echo($row->nama_kategori);?>"/>
			</div>
			<div class="element">
				<label for="name">Deskripsi</label>
				<input id="name" name="deskripsi" class="text err" value="<?php echo($row->deskripsi);?>"/>
			</div>
			<!--<div class="element">
				<label for="category">Category <span class="red">(required)</span></label>
					<select name="category" class="err">
					<option value="0">-- select category</option>
					<option value="1">Category 1</option>
					<option value="2">Category 4</option>
					<option value="3">Category 3</option>
				</select>
			</div>
			<div class="element">
				<label for="comments">Comments</label>
				<input type="radio" name="comments" value="on" checked="checked" /> Enabled <input type="radio" name="comments" value="off" /> Disabled
			</div>
			<div class="element">
				<label for="attach">Attachments</label>
				<input type="file" name="attach" />
			</div>
			<div class="element">
				<label for="content">Page content <span>(required)</span></label>
				<textarea name="content" class="textarea" rows="10"></textarea>
			</div>-->
			<div class="entry">
				<!--<button type="submit">Preview</button>--> <button type="submit" class="add">Ubah kategori</button> <button class="cancel">Cancel</button>
			</div>
			<?php endforeach; ?>
		</form>
	</div>
</div>
<div class="clear"></div>
</div>
