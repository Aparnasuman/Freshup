<style>
.success-message {
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center;
    color: #95c840;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  //background-color: #dddddd;
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
        <li><a href="<?php echo site_url();?>admin/Calendar"><button class="btn btn-primary">Go Back</button></a></li>
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
					<div class="row">
					   <div class="col-sm-12">
						<table>
						  <tr>
							<td>User Name</td>
							<td><?php echo $userDetails['name']?></td>
						  </tr>
						  <tr>
							<td>User Phone Number</td>
							<td><?php echo $userDetails['phone'];?></td>
						  </tr>
						  <tr>
							<td>Barber Name</td>
							<td><?php echo $barberDetails['name']?></td>
						  </tr>
						  <tr>
							<td>Barber Phone Nubmer</td>
							<td><?php echo $barberDetails['phone']?></td>
						  </tr>
						  <tr>
							<td>Services</td>
							<td> 
								<?php 	foreach($serviceDetails as $sDetals){
										$datass['title'][] = $sDetals['title'];
										$totalPriceSum += $sDetals['price'];
									}
									echo implode(',',$datass['title']);
								?>
							</td>
						  </tr>
						  <tr>
							<td>Total Price</td>
							<td>€<?php echo $totalPriceSum;?></td>
						  </tr>
						  <tr>
							<td>Appointment Date</td>
							<td><?php echo $userBookingServicesDetails['apointmentDate'];?></td>
						  </tr>
						  <tr>
							<td>Time Slot</td>
							<td><?php echo $userBookingServicesDetails['timeslot'];?></td>
						  </tr>
						  <tr>
							<td>Status</td>
							<td><div class="form-group">
								<select class="form-control" id="approveStatus" style="width: 25%;">
									<?php if($userBookingServicesDetails['status'] == '0'){ ?>
										<option <?php if($userBookingServicesDetails['status'] == '0'){ echo "selected";}?> value="0">Waitting</option>
										<option <?php if($userBookingServicesDetails['status'] == '1'){ echo "selected";}?> value="1">Accept</option>
										<option <?php if($userBookingServicesDetails['status'] == '2'){ echo "selected";}?> value="2">Cancel</option>
										<option <?php if($userBookingServicesDetails['status'] == '3'){ echo "selected";}?> value="2">Done</option>
									<?php } else{?>
										<option <?php if($userBookingServicesDetails['status'] == '1'){ echo "selected";}?> value="1">Accept</option>
										<option <?php if($userBookingServicesDetails['status'] == '2'){ echo "selected";}?> value="2">Cancel</option>
										<option <?php if($userBookingServicesDetails['status'] == '3'){ echo "selected";}?> value="2">Done</option>
									<?php } ?>
								  </select>
								</div>
							</td>
						  </tr>
						</table>
						</div>
					</div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script>
	$(document).ready(function(){
		$("#approveStatus").change(function() {
			var status = $("#approveStatus option:selected"). val();
			var id = "<?php echo $userBookingServicesDetails['id']?>";
			var userId = "<?php echo $userBookingServicesDetails['user_id']?>";
			var price = "<?php echo $totalPriceSum;?>";
			var service = "<?php echo  implode(',',$datass['title']);?>";
			var timeSlot = "<?php echo $userBookingServicesDetails['timeslot'];?>";
			var apointmentDate = "<?php echo $userBookingServicesDetails['apointmentDate'];?>";
			var barberName = "<?php echo $barberDetails['name']?>";
			$.ajax({
				type: "POST",
				url: "<?php echo site_url();?>admin/userBookingServices/updateStatus",
				data: {status:status, id:id,userId:userId,price:price,service:service,timeSlot:timeSlot,apointmentDate:apointmentDate,barberName:barberName},
				success: function(result) {
					//alert(result);
					//window.location.href = "<?php echo site_url()?>admin/client_details";
					swal("", "Status Updated Successfully", "success");
				}
			})
		});
	});
   </script>
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