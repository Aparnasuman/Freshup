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
                  <label for="exampleInputEmail1">Category Title</label>
                  <input type="text" class="form-control" value="<?php echo $details['title']?>" name="title" placeholder="Enter Name">
				  <div class="form-error"><?php echo form_error('title'); ?></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Image</label><br>
				  <?php if(!empty($details['image1'])){?>
					<img src="<?php echo $details['image1']?>" style="width:70px;height:60px;background: gray;"><br><br>
				  <?php } ?>
                  <input type="file" class="form-control" name="image1">
                </div> 
				<div class="form-group">
                  <label for="exampleInputFile">Backgorund Image</label><br>
				  <?php if(!empty($details['image2'])){?>
					<img src="<?php echo $details['image2']?>" style="width:70px;height:60px"><br><br>
				  <?php } ?>
                  <input type="file" class="form-control" name="image2">
                  <input type="hidden" class="form-control" name="id" value="<?php echo $details['id']?>">
                </div>
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