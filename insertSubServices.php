<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/Services/subServices"><button class="btn btn-primary"> <?php if($this->session->userdata('language') == 'en'){ echo 'Go Back'; } else{ echo 'Retourner'; } ?></button></a></li>
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
						<label for="sel1"><?php if($this->session->userdata('language') == 'en'){ echo 'Services'; } else{ echo  'Prestations de service'; } ?></label>
						<select class="form-control" name="serviceId">
							<?php foreach($serviceData as $serviceDetails){?>
								<option value="<?php echo $serviceDetails['id'];?>"><?php if($this->session->userdata('language') == 'en'){ echo $serviceDetails['title'] ; } else{ echo  $serviceDetails['frenchTitle']; } ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php if($this->session->userdata('language') == 'en'){ echo 'English Category Title'; } else{ echo  'Titre de la catégorie anglaise'; } ?></label>
					  <input type="text" class="form-control" value="" name="title" placeholder="Enter Name">
					  <div class="form-error"><?php echo form_error('title'); ?></div>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php if($this->session->userdata('language') == 'en'){ echo 'French Category Title'; } else{ echo  'Titre de la catégorie française'; } ?></label>
					  <input type="text" class="form-control" value="" name="frenchTitle" placeholder="Enter Name">
					  <div class="form-error"><?php echo form_error('frenchTitle'); ?></div>
					</div>
				</div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php if($this->session->userdata('language') == 'en'){ echo 'Submit'; } else{ echo  'soumettre'; } ?></button>
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