<style>
.success-message {
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center;
    color: #95c840;
}
</style>
 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/Services/InsertSubSubServices"><button class="btn btn-primary"><?php if($this->session->userdata('language') == 'en'){ echo 'Add Sub Category'; } else{ echo 'Ajouter une sous catégorie'; }?></button></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--div class="box-header">
              <h3 class="box-title">Add Category</h3>
            </div-->
            <!-- /.box-header -->
            <div class="box-body">
				<?php if($this->session->flashdata('success')){ ?>
					<div class="success-message">
					<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php }?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php if($this->session->userdata('language') == 'en'){ echo 'Service Title'; } else{ echo 'Titre du service'; }?></th>
                  <th><?php if($this->session->userdata('language') == 'en'){ echo 'Category Title'; } else{ echo 'Titre de la catégorie'; }?></th>
                  <th><?php if($this->session->userdata('language') == 'en'){ echo 'English Title'; } else{ echo 'Titre anglais'; }?></th>
                  <th><?php if($this->session->userdata('language') == 'en'){ echo 'French Title'; } else{ echo 'Titre français'; }?></th>
                  <th><?php if($this->session->userdata('language') == 'en'){ echo 'Price'; } else{ echo 'Prix'; }?></th>
                  <th><?php if($this->session->userdata('language') == 'en'){ echo 'Action'; } else{ echo 'action'; }?></th>
                 </tr>
                </thead>
                <tbody>
				<?php foreach($datas as $data){?>
                <tr>
                  <td><?php if($this->session->userdata('language') == 'en'){ echo $data['serviceTitle'] ; } else{ echo $data['serviceFrenchTitle']; }?></td>
                  <td><?php if($this->session->userdata('language') == 'en'){ echo $data['subServiceTitle'] ; } else{ echo $data['subServiceFrenchTitle']; }?></td>
                  <td><?php echo $data['title']?></td>
                  <td><?php echo $data['frenchTitle']?></td>
                  <td><?php echo $data['price']?></td>
                  <td>
						<a href="<?php echo site_url();?>admin/Services/UpdateSubSubServices/<?php echo $data['id']?>"><i class="fa fa-edit" style="font-size: 20px;"></i>&nbsp;&nbsp;</a>
						<a onclick="return confirm('Are you sure want to delete it? ');" href="<?php echo site_url();?>admin/Services/DeleteSubSubServices/<?php echo $data['id']?>"><i class="fa fa-trash" style="font-size: 22px;"></i></a>
				  </td>
                </tr>
				<?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>