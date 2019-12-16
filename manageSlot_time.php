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
	  <!--ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/slot_time/InsertSlot_time"><button class="btn btn-primary">Add Time Slot</button></a></li>
      </ol-->
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
                  <th>Time Slot</th>
				  <th>Working Days</th>
				  <?php if(!empty($datas[0]['holiday_startDate'])){
					  echo "<th>Holidays</th>";
				  }?>
                  <th>Action</th>
                 </tr>
                </thead>
                <tbody>
				<?php foreach($datas as $data){?>
                <tr>
                  <td><?php echo $data['slot_time']?></td>
				    <td><?php echo $data['working_days']?></td>
					<?php
					if(!empty($data['holiday_startDate'])){
						echo "<td>".$data['holiday_startDate']."   <b>To</b>   ".$data['holiday_endDate']."</td>";	
					}
					?>
                  <td>
						<a href="<?php echo site_url();?>admin/Slot_time/UpdateSlot_time/<?php echo $data['id']?>"><i class="fa fa-edit" style="font-size: 20px;"></i>&nbsp;&nbsp;</a>
						<!--a onclick="return confirm('Are you sure want to delete it? ');" href="<?php echo site_url();?>admin/Slot_time/DeleteSlot_time/<?php echo $data['id']?>"><i class="fa fa-trash" style="font-size: 22px;"></i></a-->
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
	