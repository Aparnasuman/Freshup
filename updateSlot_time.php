<!-- Content Wrapper. Contains page content -->
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      
      <!-- Javascript -->
      <script>
         $(function() {
            $( "#datepicker-13" ).datepicker({
				dateFormat: 'dd/mm/yy',
			});
			$( "#datepicker-14" ).datepicker({
				dateFormat: 'dd/mm/yy',
			});

         });
      </script>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
	  <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/Slot_time"><button class="btn btn-primary">Go Back</button></a></li>
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
			<?php if($this->session->flashdata('error')){ ?>
				<div class="success-message">
					<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
					<script>
						swal ( "Oops" ,  "you can not unselect two days at a time!" ,  "error" );
					</script>	
				</div>
			<?php }?>
            <form role="form" method="post" enctype='multipart/form-data'>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Time Slot</label>
                  <input type="text" class="form-control" value="<?php echo $details['slot_time']?>" name="slot_time" placeholder="Enter Time Slot">
				  <div class="form-error"><?php echo form_error('slot_time'); ?></div>
                </div>
				 <div class="form-group">
                  <!--label for="exampleInputEmail1">Start Time</label-->
                  <input type="hidden" class="form-control" value="<?php echo $details['start_time']?>" name="start_time" placeholder="Enter Start Time">
				  <div class="form-error"><?php echo form_error('start_time'); ?></div>
                </div>
				 <div style=""class="form-group">
                  <!--label for="exampleInputEmail1">End Time</label-->
                  <input type="hidden" class="form-control" value="<?php echo $details['end_time']?>" name="end_time" placeholder="Enter End Time">
				  <div class="form-error"><?php echo form_error('end_time'); ?></div>
                </div>
				<style>
				.width-20{
					width: 14.28% !important;
					padding: 10px;
				}
				.width{
					width: 20.28% !important;
					padding: 10px;
				}
				</style>
				<div class="form-group">
                  <label for="exampleInputEmail1" style="display:block">Working Days</label>
                  <div style="display:flex;">
				  <?php $i=1; $days = array('Monday','Tuesday','Wednesday','Thusday','Friday','Saturday','Sunday'); $days1 = explode(',',$details['working_days']); foreach($days as $data){ ?>
				  <div class="width-20" id="color-<?php echo $i; ?>" ><input type="checkbox" name="days[]" value="<?php echo $data; ?>" id="check-<?php echo $i; ?>" <?php if(in_array($data,$days1)){ echo "checked"; }?>/><?php echo $data; ?></div>
				  
				  <script>
				  $(document).ready(function(){
					  $("#check-<?php echo $i; ?>").click(function(){
						 if ($(this).is(':checked')) { 
							 $("#color-<?php echo $i; ?>").css("background-color","aquamarine");
						 }
						 else{
						 $("#color-<?php echo $i; ?>").css("background-color","white");
						 }
					  });					  
				  });
				  </script>
				  <?php $i++; } ?>
				  </div>
				  <!-- div class="form-error"><?php echo form_error('days'); ?></div-->
                </div>
				<div class="form-group" >
                  <label for="exampleInputEmail1" style="display:block">Holidays </label>
				  <?php
				  if(!empty($details['holiday_startDate'])){
				  $a = date("m/d/Y", strtotime($details['holiday_startDate']));
				  $b = date("m/d/Y", strtotime($details['holiday_endDate']));
				  }
				  else{
					  $a = $details['holiday_startDate'];
					  $b = $details['holiday_endDate'];
				  }
				  ?>
				  <div style="display:flex;">
				  <div class="width">
                  <label>Start Date</label><input type="text" id="datepicker-13" class="form-control" value="<?php echo $a;?>" name="holiday_startDate">
				  </div>
				  <div class="width">
                  <label>End Date</label><input type="text" id="datepicker-14" class="form-control " value="<?php echo $b; ?>" name="holiday_endDate">
				  </div>
				  </div>
				  <div class="form-error"><?php echo form_error('end_time'); ?></div>
				  <div class="form-error"><?php echo form_error('holiday_endDate'); ?></div>
                </div>
				
				
				<div class="form-group" >
					<label>Regular Timings(Tuesday-Friday) :</label>
					<div style="display: flex;justy-content: space-between;justify-content: space-between;width: 50%;">
						<span style="margin-top: 10px;">First Shift</span>
						<div style="width:20%;padding:10px"><label>Start Time</label><input type="time" value="<?php echo $details['regularFirstShiftStartTime'];?>" name="regularFirstShiftStartTime" ></div>
						<div style="width:20%;padding:10px"><label>End Time</label><input type="time" value="<?php echo $details['regularFirstShiftEndTime'];?>" name="regularFirstShiftEndTime" value="<?php echo $c[1]; ?>"></div>
					</div>
					<div style="display: flex;justy-content: space-between;justify-content: space-between;width: 50%;">
						<span style="margin-top: 12px;"> Second Shift</span>
						<div style="width:20%;padding:10px"><label>Start Time</label><input type="time" value="<?php echo $details['regularSecondShiftStartTime'];?>" name="regularSecondShiftStartTime" ></div>
						<div style="width:20%;padding:10px"><label>End Time</label><input type="time" value="<?php echo $details['regularSecondShiftEndTime'];?>" name="regularSecondShiftEndTime" value="<?php echo $c[1]; ?>"></div>
					</div>
				 </div>
				 
				<div class="form-group" >
					<label>Weekend Timings(Saturday):</label>
					<div style="display: flex;justy-content: space-between;justify-content: space-between;width: 50%;">
						<span style="margin-top: 10px;">First Shift</span>
						<div style="width:20%;padding:10px"><label>Start Time</label><input type="time" value="<?php echo $details['weekendFirstShiftStartTime'];?>" name="weekendFirstShiftStartTime" ></div>
						<div style="width:20%;padding:10px"><label>End Time</label><input type="time" value="<?php echo $details['weekendFirstShiftEndTime'];?>" name="weekendFirstShiftEndTime" value="<?php echo $c[1]; ?>"></div>
					</div>
					<div style="display: flex;justy-content: space-between;justify-content: space-between;width: 50%;">
						<span style="margin-top: 12px;"> Second Shift</span>
						<div style="width:20%;padding:10px"><label>Start Time</label><input type="time" value="<?php echo $details['weekendSecondShiftStartTime'];?>" name="weekendSecondShiftStartTime" ></div>
						<div style="width:20%;padding:10px"><label>End Time</label><input type="time" value="<?php echo $details['weekendSecondShiftEndTime'];?>" name="weekendSecondShiftEndTime" value="<?php echo $c[1]; ?>"></div>
					</div>
				 </div>
				  
				
				
				<!--div class="form-group" >
				  <label>Regular Timings(Tuesday-Friday)</label>
				  <div style="display:flex;justy-content:space-between;">
				  <?php $c = explode(',',$details['regular_times']); ?>
				  <div style="width:20%;padding:10px"><label>Start Time</label><input type="time" name="start_time1" value="<?php echo $c[0]; ?>"></div>
				  <div style="width:20%;padding:10px"><label>End Time</label><input type="time" name="end_time1" value="<?php echo $c[1]; ?>"></div>
				  </div>
				  </div>
				  <div class="form-group" > 
				  <label>Weekend Timings(Saturday-Sunday)</label>
				  <div style="display:flex;justy-content:space-between;">
				  <?php $d = explode(',',$details['weekend_times']); ?>
				  <div style="width:20%;padding:10px"><label>Start Time</label><input type="time" name="start_time2" value="<?php echo $d[0]; ?>" ></div>
				  <div style="width:20%;padding:10px"><label>End Time</label><input type="time" name="end_time2" value="<?php echo $d[1]; ?>"></div>
				  </div>
				  </div>
				</div-->
				
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
	<script>
	$( window ).load(function() {
		for(var i = 1;i<=7;i++){
			if($("#check-"+i).is(":checked")){
				$("#color-"+i).css("background-color","aquamarine");
			}
		}
});
	</script>