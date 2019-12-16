<style>
.success-message {
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center;
    color: #95c840;
}
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #21f327;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
blockquote.card-blockquote {
    border: none;
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
        <li><a href="<?php echo site_url();?>admin/Product/InsertProductCategory"><button class="btn btn-primary">Add Category</button></a></li>
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
				
				
				
				<div class="card card-block card-inverse card-primary">
                    <blockquote class="card-blockquote">
                        <i class="fa fa-3x fa-cc-stripe pull-right"></i>
                        <div class="form-group row">
                            <div class="col-xs-4">
                                <label for="stripe_secret_key" class="col-form-label">
                                    Stripe (Card Payments)
                                </label>
                            </div>
                            <div class="col-xs-6">
                                <label class="switch">
								  <input type="checkbox" class="stripeChange" value="1" <?php if($stripeDetails['status'] == '1'){ echo "checked";} ?>>
								  <span class="slider round"></span>
								</label>
                            </div>
                        </div>
                        <div id="card_field" <?php if($stripeDetails['status'] == '1'){ ?> style="display: block;" <?php } else { ?>style="display: none;" <?php } ?>>
                            <div class="form-group row">
                                <label for="stripe_secret_key" class="col-xs-4 col-form-label">Stripe Secret key</label>
                                <div class="col-xs-8">
                                    <input class="form-control" type="text" value="<?php echo $stripeDetails['stripeSecretkey']?>" name="stripe_secret_key" id="stripe_secret_key" placeholder="Stripe Secret key">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stripe_publishable_key" class="col-xs-4 col-form-label">Stripe Publishable key</label>
                                <div class="col-xs-8">
                                    <input class="form-control" type="text" value="<?php echo $stripeDetails['stripePublishablekey']?>" name="stripe_publishable_key" id="stripe_publishable_key" placeholder="Stripe Publishable key">
                                </div>
                            </div>
                        </div>
                    </blockquote>
                </div>
				 
				
				
				
				<div class="card card-block card-inverse card-primary">
                    <blockquote class="card-blockquote">
                       <i class="fa fa-3x fa-money pull-right"></i>
                        <div class="form-group row">
                            <div class="col-xs-4">
                                <label for="stripe_secret_key" class="col-form-label">
                                    Cash Payments
                                </label>
                            </div>
                            <div class="col-xs-6">
                                <label class="switch">
								  <input type="checkbox" class="cashChange" value="2" <?php if($cashDetails['status'] == '1'){ echo "checked";} ?>>
								  <span class="slider round"></span>
								</label>
                            </div>
                        </div>
                    </blockquote>
                </div>
				
				
				<div class="card card-block card-inverse card-primary">
                    <blockquote class="card-blockquote">
						<i class="fa fa-3x fa-paypal  pull-right" aria-hidden="true"></i>
                        <div class="form-group row">
                            <div class="col-xs-4">
                                <label for="stripe_secret_key" class="col-form-label">
                                    Paypal (Card Payments) 
                                </label>
                            </div>
                            <div class="col-xs-6">
                                <label class="switch">
								  <input type="checkbox" class="paypalChange" value="3" <?php if($paypalDetails['status'] == '1'){ echo "checked";} ?>>
								  <span class="slider round"></span>
								</label>
                            </div>
                        </div>
                        <div id="card_field1" <?php if($paypalDetails['status'] == '1'){ ?> style="display: block;" <?php } else { ?>style="display: none;" <?php } ?>>
                            <div class="form-group row">
                                <label for="stripe_secret_key" class="col-xs-4 col-form-label">Paypal Environment</label>
                                <div class="col-xs-8">
                                    <input class="form-control" type="text" value="<?php echo $paypalDetails['paypalEnvironment']?>" name="stripe_secret_key" id="stripe_secret_key" placeholder="Stripe Secret key">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stripe_publishable_key" class="col-xs-4 col-form-label">Paypal MerchantId</label>
                                <div class="col-xs-8">
                                    <input class="form-control" type="text" value="<?php echo $paypalDetails['paypalMerchantId']?>" name="stripe_publishable_key" id="stripe_publishable_key" placeholder="Stripe Publishable key">
                                </div>
                            </div>
							 <div class="form-group row">
                                <label for="stripe_publishable_key" class="col-xs-4 col-form-label">Paypal Public Key</label>
                                <div class="col-xs-8">
                                    <input class="form-control" type="text" value="<?php echo $paypalDetails['paypalPublicKey']?>" name="stripe_publishable_key" id="stripe_publishable_key" placeholder="Stripe Publishable key">
                                </div>
                            </div>
							 <div class="form-group row">
                                <label for="stripe_publishable_key" class="col-xs-4 col-form-label">Paypal Private Key</label>
                                <div class="col-xs-8">
                                    <input class="form-control" type="text" value="<?php echo $paypalDetails['paypalPrivateKey']?>" name="stripe_publishable_key" id="stripe_publishable_key" placeholder="Stripe Publishable key">
                                </div>
                            </div>
                        </div>
                    </blockquote>
                </div>
				
				
				<div class="form-group row">
                    <div class="col-md-10">
                        <!--a href="http://sanjeevnitravels.com/sanjeevni-app/admin" class="btn btn-warning btn-block">Back</a-->
                    </div>
                    <div class="col-md-2">
                        <button type="submit" style="cursor: not-allowed;" class="btn btn-primary btn-block">Update Site Settings</button>
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
  <script>
	$(document).ready(function(){
		$(".stripeChange").click(function(){
			var ids = $(".stripeChange").val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url();?>admin/Payment/stripeStatusChange",
				data: {ids: ids},
				success: function(result) {
					if(result == 1){
						$('#card_field').show(1000);
					}
					else{
						$('#card_field').hide(1000);
					}
				}
			})
		});		
	});
	
	$(document).ready(function(){
		$(".paypalChange").click(function(){
			var ids = $(".paypalChange").val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url();?>admin/Payment/paypalStatusChange",
				data: {ids: ids},
				success: function(result) {
					if(result == 1){
						$('#card_field1').show(1000);
					}
					else{
						$('#card_field1').hide(1000);
					}
				}
			})
		});		
	});
	
	$(document).ready(function(){
		$(".cashChange").click(function(){
			var ids = $(".cashChange").val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url();?>admin/Payment/cashStatusChange",
				data: {ids: ids},
				success: function(result) {
					
				}
			})
		});		
	});
  
  
  
  
  
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