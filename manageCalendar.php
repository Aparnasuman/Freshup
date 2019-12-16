<style>
.success-message {
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center; 
    color: #95c840;
}
	#ui-datepicker-div{
		display:block !important;
	}
	.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom {
    width: 79%;
}
table.table-condensed {
    width: 100%;
}
div#example1_wrapper {
    margin-top: 263px;
}
</style>
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?php echo $title; ?>
      </h1>
	  <!--ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/UserBookingServices/InsertBookingServices"><button class="btn btn-primary">Add Booking</button></a></li>
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
				
				<?php
				//echo "<pre>";
				//print_r($details);
				//die;
			  
			  
			  ?>
			  
				 
				 <p><input type="text" class="form-control hii"  id ="datepicker-13" readonly placeholder="select date"></p>
              <!--table start --><!--table end -->
			  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				
				  <th>No.</th>
				  <th>User</th>
                  <th>Barber</th>
				  <th>Services</th>
				  <th>Appointment</th>
				  <th>Time Slot</th>
				  <th>Payment</th>
                  <th>Status</th>
                  <th>Action</th>
                 </tr>
                </thead>
                <tbody>
				<?php $i = 1; foreach($details as $data){?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $data['userName']?></td>
				   <td><?php echo $data['barberName']?></td>
				   <td><?php 
						$a =  $data['subSubService_id'];
						$b = explode(',', $a);
						foreach($subsub as $abc){
							if(in_array($abc['id'],$b)){
								echo $abc['title'].",";
							}
						} 
						
						?>
					</td>
				   <td><?php echo $data['apointmentDate']?></td>
				    <td><?php 
						$c = $data['timeslot'];
						echo $c;
						?>
					</td>
					<td>
					    <?php if($data['paymentStatus'] == '0'){
					            echo "Pending";
					        }
					        elseif($data['paymentStatus'] == '1'){
					            echo "Cleared";
					        }
					        else{
					            echo "Cash";
					        }
					    
					    ?>
					</td>
					<td>
					    <?php if($data['status'] == '0'){ ?>
							<span style="color:#5bc0de">Waitting</span>
					    <?php } elseif($data['status'] == '1'){ ?>
					        <span style="color:#449d44">Accept</span>
						<?php } elseif($data['status'] == '3'){ ?>
					        <span style="color:#449d44">Completed</span>
					    <?php } else{ ?>
					        <span style="color:#c9302c">Cancel</span>
					    <?php } ?>
					</td>
                  <td>
						<a href="<?php echo site_url();?>admin/Calendar/viewBookingServices/<?php echo $data['id']?>"><i class="fa fa-eye" style="font-size: 20px;"></i>&nbsp;&nbsp;</a>
						<!--a onclick="return confirm('Are you sure want to delete it? ');" href="<?php echo site_url();?>admin/Slot_time/DeleteSlot_time/<?php echo $data['id']?>"><i class="fa fa-trash" style="font-size: 22px;"></i></a-->
				  </td> 
                </tr>
				<?php $i++; } ?>
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
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
	 $(function() {
		$( "#datepicker-13" ).datepicker();
		$( "#datepicker-13" ).datepicker("show");
	 });
	 
	$(document).ready(function(){
		$('.hii').change(function(){
			$('#ui-datepicker-div').css('display','block');
			var selectDate = $(this).val();
			//alert(selectDate);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url();?>admin/Calendar/getBookingServiceByDate",
				data: {selectDate:selectDate},
				success: function(result) {
					$( "#example1" ).replaceWith(result);
					//alert(result);
					//window.location.href = "<?php echo site_url()?>admin/client_details";
					//swal("", "Status Updated Successfully", "success");
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