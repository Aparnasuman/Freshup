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
        <li><a href="<?php echo site_url();?>admin/barber/Insertbarber"><button class="btn btn-primary">Add Barber</button></a></li>
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
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Image</th>
                  <th>Action</th>
                 </tr>
                </thead>
                <tbody>
				<?php foreach($datas as $data){?>
                <tr>
                  <td><?php echo $data['name']?></td>
                  <td><?php echo $data['phone']?></td>
                  <td><img src="<?php echo $data['image']?>" style="width:150px;height:70px"></td>
                  <td>
						<a href="<?php echo site_url();?>admin/Barber/UpdateBarber/<?php echo $data['id']?>"><i class="fa fa-edit" style="font-size: 20px;"></i>&nbsp;&nbsp;</a>
						<a onclick="return confirm('Are you sure want to delete it? ');" href="<?php echo site_url();?>admin/Barber/DeleteBarber/<?php echo $data['id']?>"><i class="fa fa-trash" style="font-size: 22px;"></i>&nbsp;&nbsp;</a>
						<a href="<?php echo site_url();?>admin/Barber/BarberLeave/<?php echo $data['id']?>"><img src="http://apptech.mobi/freshupApplication/new/uploads/service/1550238017_Exit-512.png" style="width:21px;height:17px;margin-bottom: 3px;"></a>
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