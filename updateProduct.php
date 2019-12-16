<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/Product"><button class="btn btn-primary">Go Back</button></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!--div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div-->
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype='multipart/form-data'>
              <div class="box-body">
				<div class="form-group">
					<label for="sel1">Category:</label>
					<select class="form-control" name="categoryId" id="categoryId">
						<option value="">Select Category First</option>
						<?php foreach($categoryDetails as $categoryDetail){?>
							<option <?php if($details['categoryId'] == $categoryDetail['id']){ echo "selected"; }?> value="<?php echo $categoryDetail['id'];?>"><?php echo $categoryDetail['title'];?></option>
						<?php } ?>
					</select>
					<div class="form-error"><?php echo form_error('categoryId'); ?></div>
				</div>
				<div class="form-group" id="subCategory">
					<label for="sel1">Sub Category:</label>
					<select class="form-control" name="subCategoryId" id="subCategoryId">
						<option value="">Select Category</option>
						<?php foreach($subCategory as $subCategorys){?>
							<option <?php if($details['subCategoryId'] == $subCategorys['id']){ echo "selected"; }?> value="<?php echo $subCategorys['id'];?>"><?php echo $subCategorys['title'];?></option>
						<?php } ?>
					</select>
					<div class="form-error"><?php echo form_error('subCategoryId'); ?></div>
				</div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Title:</label>
                  <input type="text" class="form-control" value="<?php echo $details['title']?>" name="title" placeholder="Enter Name">
				  <div class="form-error"><?php echo form_error('title'); ?></div>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1">Price:</label>
                  <input type="number" class="form-control" value="<?php echo $details['price']?>" name="price" placeholder="Enter Price">
				  <div class="form-error"><?php echo form_error('price'); ?></div>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1">Description:</label>
                  <input type="text" class="form-control" value="<?php echo $details['description']?>" name="description" placeholder="Enter Description">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Image</label><br>
                  <?php if(!empty($details['productImage'])){
					$images = explode(',',$details['productImage']);
					foreach($images as $pImage){
				  ?>
					<img src="<?php echo $pImage?>" style="width:70px;height:60px;">
				  <?php } echo "<br>";echo "<br>"; } ?>
				  <input type="file" class="form-control" name="productImage">
				  
                </div>
              </div>
              <!-- /.box-body -->
				<input type="hidden" value="<?php echo $details['id']?>" name="id" >
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
  
	$('#categoryId').on('change', function() {
		var categoryId = $('select[name=categoryId]').val();		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url();?>admin/Product/getSubCategory",
			data: {categoryId: categoryId},
			success: function(result) {
				$("#subCategory").replaceWith(result);
				//alert(result);
			}
		})
	});
		
	</script>