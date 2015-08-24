<div id="main">
	<div class="full_w">
		<div class="h_title"><?php echo"$judul"; ?></div>
		<?php echo form_open('admin/post/proses_edit') ?>
		<?php foreach($post->result() as $row):?>			
			<div class="element">
				<label for="name">Judul Post <span class="red">(required)</span></label>
				<input type="hidden" name="id_post" value="<?php echo($row->id_post);?>" size="30" />
				<input id="name" name="judul_post" class="text err" value="<?php echo($row->judul_post);?>"/>
			</div>
			<div class="element">
				<label for="name">Detail Post</label>
				<textarea name="detail_post" class="textarea artikel"><?php echo($row->detail_post);?></textarea>
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
				<!--<button type="submit">Preview</button>--> <button type="submit" class="add">Simpan</button> <button class="cancel">Cancel</button>
			</div>
			<?php endforeach; ?>
		</form>
	</div>
<div class="clear"></div>
</div>
