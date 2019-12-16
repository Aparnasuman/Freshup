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