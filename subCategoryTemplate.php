<div class="form-group" id="subCategory">
	<label for="sel1">Sub Category:</label>
	<select class="form-control" name="subCategoryId" id="subCategoryId">
		<option value="">Select Category</option>
		<?php foreach($subCategory as $subCategorys){?>
			<option value="<?php echo $subCategorys['id'];?>"><?php echo $subCategorys['title'];?></option>
		<?php } ?>
	</select>
</div>
