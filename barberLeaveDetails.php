<style>

.main-sidebar {

    position: static;

    float: left;

    width: 17%;

    margin-top: -3px;

	    height: 130vh;

}

.login-box, .register-box {

    width: 83%;

    margin: 4% auto;

    float: left;

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

<div class="login-box dash"> 

  <!-- /.login-logo -->

  <!--div class="login-box-body">

	<?php if($this->session->flashdata('error')){ ?>			

	<div class="form-error">                

	<?php echo $this->session->flashdata('error'); ?>            

	</div>		  

	<?php }?>	</div-->

	

    <form role="form" class="myform" action="" method="post" autocomplete="off">

	  <div >

        <div class="form-group col-md-3">

            <label for="exampleInputName">Name</label>

            <input type="text" name="name" class="form-control" id="exampleInputName" >

			<div class="form-error"><?php echo form_error('name'); ?></div>

        </div>

        <div class="form-group col-md-3">

            <label for="exampleInputMobile">Mobile</label>

            <input type="tel" name="contact" maxlength="10"  class="form-control" id="exampleInputMobile" placeholder="">

			<div class="form-error"><?php echo form_error('contact'); ?></div>

        </div>

    

        <div class="form-group col-md-3">

            <label for="exampleInputCity">City</label>

            <input type="City" name="city" class="form-control"  id="exampleInputCity" placeholder="">

			<div class="form-error"><?php echo form_error('city'); ?></div>

        </div>

       <div class="form-group col-md-3">

            <label for="exampleInputEmail">Email</label>

            <input type="Email" name="email" class="form-control" id="exampleInputEmail" placeholder="">

			<div class="form-error"><?php echo form_error('email'); ?></div>

        </div>

	 </div>

	 <div>

        

		 <div class="form-group col-md-3">

            <label for="exampleInputCity">Bank</label>

            <select name="bank" class="form-control" id="exampleInputCity">

                 <option value="ICICI Bank">ICICI Bank</option>

                <option value="HDFC Bank">HDFC Bank</option>

                <option value="SBI Bank">SBI Bank</option>

            </select>

            

        </div>

		<div class="form-group col-md-3 ">

            <label for="vehicleno">Vehicle No</label><br>

			<span id="gg" style="display: none; color: red; size: 14px; font-weight: bold;">Alert-Temp Selected </span>

            <input type="text" name="vehicleNo" class="form-control" id="vehicleno" placeholder="">

        </div>

		<div class="form-group col-md-3">

            <label for="temp">Is Temp</label></br>

            <input type="checkbox" name="temp" id="temp" style="height: 30px; width: 30px;">

        </div>

		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

		
		

		

        <div class="col-md-3">

            <input type="submit"  name="submit" class="btn btn-default" value="Submit" style="margin-top: 28px;">

		</div>

      </div>

    </form> 



  </div>

  



  

   

    <!-- Main content -->

    <div class="login-box">

		<center><h4><b>User Data</b></h4> </center>

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

			<form method="get">

				

		

				
				
				

				<div style="float:right;">

				<input type="text" name="search" id="contact" placeholder="Search Contact"> &nbsp&nbsp

				<!--input type="submit" name="sub" id="search"-->

				<div id="searchdata"></div>

				</div>

				<script>

					// $(document).ready(function(){

						// $("#contact").bind('keyup paste',function(){

							// var keyword = $(this).val();

								// $.ajax({

									// type: "post",

									// url: "<?php echo site_url("admin/UserRegistration/search")?>",

									// data: {keyword: keyword},

									// success: function(result){

										// $("#searchdata").html(result);

									// }

								// });

						// });

					// });

				</script>

				

              <table id="example1" class="table table-bordered table-striped" style="margin-top: 18px;">

                <thead>

                <tr>

                  <!--th>Sr.</th-->

                  <th>Name</th>

                  <th>Contact</th>

                  <th>City</th>

                  <th>Email</th>

                  <th>bank	</th>

                  <th>Vehicle No</th>

                  <th>Delete</th>

                 </tr>

                </thead>

				
                <tbody>

				<!--?php $i=1; foreach($userData as $data){?-->

                <tr>


                  <td>ff</td>

                  <td>zz</td>

                  <td>ee</td>

                  <td>fdssdf</td>

                  <td>dgsg</td>

                  <td>sdfsdf</td>

                  <td>

					<a onclick="return confirm('Are you sure want to delete it? ');" href="<?php echo site_url();?>admin/UserRegistration/deleteUser/"><i class="fa fa-trash" style="font-size: 22px;"></i></a>

				  </td>

                </tr>


                </tbody>

              </table>

					
			  </form>	

			

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

    </div>

   <!--script>

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

</script-->

<!--script>

  $(document).ready(function () {

  $('#example1').DataTable();

  $('.dataTables_length').addClass('bs-select');

});

  </script-->