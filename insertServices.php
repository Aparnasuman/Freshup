<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/Services"><button class="btn btn-primary"><?php if($this->session->userdata('language') == 'en'){ echo "Go Back"; } else { echo "Retourner"; }?></button></a></li>
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
                  <label for="exampleInputEmail1"><?php if($this->session->userdata('language') == 'en'){ echo "English Title"; } else { echo "Titre anglais"; }?></label>
                  <input type="text" class="form-control" value="" name="title" placeholder="Enter Name">
				  <div class="form-error"><?php echo form_error('title'); ?></div>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1"><?php if($this->session->userdata('language') == 'en'){ echo "French Title"; } else { echo "Titre français"; }?></label>
                  <input type="text" class="form-control" value="" name="frenchTitle" placeholder="Enter Name">
				  <div class="form-error"><?php echo form_error('frenchTitle'); ?></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Image</label><br>
                  <input type="file" class="form-control" name="image1">
                </div> 
				<div class="form-group">
                  <label for="exampleInputFile"><?php if($this->session->userdata('language') == 'en'){ echo "Background Image"; } else { echo "image de fond"; }?></label><br>
                  <input type="file" class="form-control" name="image2">
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