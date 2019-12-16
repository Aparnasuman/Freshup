<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/Services/subSubServices"><button class="btn btn-primary"><?php if($this->session->userdata('language') == 'en'){ echo 'Go Back'; } else{ echo 'Retourner'; } ?></button></a></li>
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
						<select class="form-control" name="serviceId" id="serviceId">
							<option value=""><?php if($this->session->userdata('language') == 'en'){ echo 'Select Services'; } else{ echo  'Sélectionner des services'; } ?></option>
							<?php foreach($serviceData as $serviceDetails){?>
								<option <?php if($serviceDetails['id'] == $details['serviceId']){ echo "selected"; }?> value="<?php echo $serviceDetails['id'];?>"><?php if($this->session->userdata('language') == 'en'){ echo $serviceDetails['title'] ; } else{ echo  $serviceDetails['frenchTitle']; } ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="box-body" id="subCategory">
					<div class="form-group">
						<label for="sel1"><?php if($this->session->userdata('language') == 'en'){ echo 'Category Title'; } else{ echo  'Titre de la catégorie'; } ?></label>
						<select class="form-control" name="subServiceId" id="serviceId">
							<option value=""><?php if($this->session->userdata('language') == 'en'){ echo 'Select Category'; } else{ echo  'Choisir une catégorie'; } ?></option>
							<?php foreach($subServiceData as $subServiceDat){?>
								<option <?php if($subServiceDat['id'] == $details['subServiceId']){ echo "selected"; }?> value="<?php echo $subServiceDat['id'];?>"><?php if($this->session->userdata('language') == 'en'){ echo $subServiceDat['title'] ; } else{ echo  $subServiceDat['frenchTitle']; } ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php if($this->session->userdata('language') == 'en'){ echo 'English Sub Category Title'; } else{ echo  'Titre de la sous-catégorie anglaise'; } ?></label>
					  <input type="text" class="form-control" value="<?php echo $details['title']?>" name="title" placeholder="Enter title">
					  <div class="form-error"><?php echo form_error('title'); ?></div>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php if($this->session->userdata('language') == 'en'){ echo 'French Sub Category Title'; } else{ echo  'Titre de la sous-catégorie française'; } ?></label>
					  <input type="text" class="form-control" value="<?php echo $details['frenchTitle']?>" name="frenchTitle" placeholder="Enter title">
					  <div class="form-error"><?php echo form_error('frenchTitle'); ?></div>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group">
					  <label for="exampleInputEmail1"><?php if($this->session->userdata('language') == 'en'){ echo 'Price'; } else{ echo  'Prix'; } ?></label>
					  <input type="text" class="form-control" value="<?php echo $details['price']?>" name="price" placeholder="Enter price">
					  <div class="form-error"><?php echo form_error('price'); ?></div>
					</div>
				</div>
				<input type="hidden" value="<?php echo $details['id']; ?>" name="id">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
  
	$('#serviceId').on('change', function() {
		var serviceId = $('select[name=serviceId]').val();	
		$.ajax({
			type: "POST",
			url: "<?php echo site_url();?>admin/Services/getCategory",
			data: {serviceId: serviceId},
			success: function(result) {
				$("#subCategory").replaceWith(result);
				//alert(result);
			}
		})
	});
		
	</script>