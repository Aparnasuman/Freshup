<style>
.success-message {
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center;
    color: #95c840;
}

<style>

.main-sidebar {

    position: static;

    float: left;

    width: 17%;

    margin-top: -3px;

	    height: 130vh;

}

.login-box, .register-box {

    width: 98%;
    margin: 4% auto;
    float: left;
    margin-left: 10px;

}

.myform{

	display: inline-block;

    width: 100%;

    margin: 0 auto;

}

.dash{

    background-color: antiquewhite;

    height: 220px;

    padding: 21px;



}



</style>

</style>
 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
         <li><a href="<?php echo site_url();?>admin/barber"><button class="btn btn-primary">Go Back</button></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
		  
		  <div class="login-box dash"> 

  <!-- /.login-logo -->

  <!--div class="login-box-body">

	<?php if($this->session->flashdata('success')){ ?>			

	<div class="form-error">                

	<?php echo $this->session->flashdata('success'); ?>            

	</div>		  

	<?php }?>	</div-->

	

    <form role="form" class="myform" action="" method="post" autocomplete="off">

	  <div >
		 <div class="form-group col-md-3">

            <label for="exampleInputName">Name</label>

            <input type="text"  readonly value="<?php echo $details['name']; ?>" class="form-control" id="exampleInputName" >

        </div>
		
		 <div class="form-group col-md-3">

            <label for="exampleInputName">Phone Number</label>

            <input type="text"  readonly value="<?php echo $details['phone']; ?>" class="form-control" id="exampleInputName" >

        </div>
	    <input type="hidden" value="<?php echo $details['id']?>" name="barberId">
        <div class="form-group col-md-3">

            <label for="exampleInputName">Leave Start Date</label>

            <input type="date" name="startDate" class="form-control" id="exampleInputName" >

			<div class="form-error"><?php echo form_error('startDate'); ?></div>

        </div>

        <div class="form-group col-md-3">

            <label for="exampleInputMobile">Leave End date</label>

            <input type="date" name="endDate" class="form-control" id="exampleInputMobile" placeholder="">

			<div class="form-error"><?php echo form_error('endDate'); ?></div>

        </div>
		
	

	 </div>

	 <div>

		<div class="form-group col-md-3">

            <label for="exampleInputMobile">Working Time</label>

            <input type="time" name="wrokingDateTime" class="form-control" id="exampleInputMobile" placeholder="">

			<div class="form-error"><?php echo form_error('wrokingDateTime'); ?></div>

        </div>

		

		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

		
		

		

        <div class="col-md-3">

            <input type="submit"  name="submit" class="btn btn-default" value="Submit" style="margin-top: 28px;">

		</div>

      </div>

    </form> 



  </div>

  
  
  
  
            <!--div class="box-header">
              <h3 class="box-title">Add Category</h3>
            </div-->
            <!-- /.box-header -->
            <div class="box-body">
				
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Working Time</th>
                  <th>Days</th>
                  <th>Action</th>
                 </tr>
                </thead>
                <tbody>
				<?php foreach($datas as $data){?>
                <tr>
                  <td><?php echo $details['name']; ?></td>
                  <td><?php echo $data['startDate']?></td>
                  <td><?php echo $data['endDate'];?></td>
                  <td><?php echo $data['wrokingDateTime'];?></td>
                  <td><?php $date1=date_create($data['startDate']);
						$date2=date_create($data['endDate']);
						$diff=date_diff($date1,$date2);
						echo $diff->format("%R%a days");
					  ?>
				  </td>
                  <td>
						<a href="<?php echo site_url();?>admin/Barber/barberCancelLeave/<?php echo $data['id']?>/<?php echo $details['id']?>"><i class="fa fa-trash" style="font-size: 20px;"></i>&nbsp;&nbsp;</a>
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