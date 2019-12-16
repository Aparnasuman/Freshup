<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/UserBookingServices"><button class="btn btn-primary">Go Back</button></a></li>
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
                  <label for="exampleInputEmail1">Time-Slot</label>
                  <input type="text" class="form-control" value="" name="slot_time" placeholder="Enter Time Slot">
				  <div class="form-error"><?php echo form_error('slot_time'); ?></div>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1">Start Time</label>
                  <input type="text" class="form-control" value="" name="start_time" placeholder="Enter Start Time">
				  <div class="form-error"><?php echo form_error('start_time'); ?></div>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1">End Time</label>
                  <input type="text" class="form-control" value="" name="end_time" placeholder="Enter End Time">
				  <div class="form-error"><?php echo form_error('end_time'); ?></div>
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