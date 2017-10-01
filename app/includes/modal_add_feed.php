
	<div class="modal-add-feed">
		<h1>
			Feed<i class="fa fa-close fa-lg close"></i>
		</h1>

		<form id="add-feed" method="post" action="//api.nagashi.me/feed/add/">
			<div>
				<input type="text" name="url" placeholder="Feed URL (http://example.com/feed)">
			</div>

			<div class="modal-form-register-area">
			
				<select name="category">
				<?php
				foreach ($getCategories as $category):
				?>
					<option value="<?php echo $category["id"]; ?>"><?php echo h($category["name"]);?></option>
				<?php
				endforeach;
				?>
				</select>

				<input type="submit" value="Register" class="button">
			</div>
			
		</form>
	</div>
