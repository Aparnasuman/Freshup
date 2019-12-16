<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/Product/productSubCategory"><button class="btn btn-primary">Go Back</button></a></li>
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
						<select class="form-control" name="categoryId">
							<?php foreach($categoryDetails as $categoryDetail){?>
								<option <?php if($categoryDetail['id'] == $details['categoryId']){ echo "selected" ;}?> value="<?php echo $categoryDetail['id'];?>"><?php echo $categoryDetail['title'];?></option>
							<?php } ?>
						</select>
				</div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Sub Category Title</label>
                  <input type="text" class="form-control" value="<?php echo $details['title']?>" name="title" placeholder="Enter Name">
				  <div class="form-error"><?php echo form_error('title'); ?></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Image</label><br>
				  <?php
					if(!empty($details['image'])){?>
						<img src="<?php echo $details['image']?>" style="width:70px;height:60px"><br><br>
				  <?php	} ?>
                  <input type="file" class="form-control" name="image">
                </div> 
				<input type="hidden" value="<?php echo $details['id']; ?>" name="id">
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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