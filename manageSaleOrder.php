<style>
.success-message {
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center;
    color: #95c840;
}
</style>
 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?php echo $title; ?>
      </h1>
	  <!--ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>admin/Product/InsertProduct"><button class="btn btn-primary">Add Product</button></a></li>
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
                  <th>No.</th>
                  <th>OrderId</th>
                  <th>Name</th>
                  <th>Number</th>
                  <th>Customer Id</th>
                  <th>Transaction Id</th>
                  <th>Method</th>
                  <th>Amount</th>
                  <th>Staus</th>
                  <th>Action</th>
                 </tr>
                </thead>
                <tbody>
				<?php $i = 1; foreach($datas as $data){?>
                <tr>
                  <td><?php echo $i?></td>
                  <td>#<?php echo $data['orderId']?></td>
                  <td><?php echo $data['name']?></td>
                  <td><?php echo $data['phone']?></td>
                  <td><?php if(!empty($data['customer_id'])){ echo $data['customer_id'];} else{ echo "N/A";}?></td>
                  <td><?php if(!empty($data['transaction_id'])){ echo $data['transaction_id'];} else{ echo "N/A";}?></td>
                  <td><?php echo $data['paymentMethod']?></td>
                  <td><?php echo $data['amount']?></td>
                  <!--td><?php if($data['deliveryStatus'] == '0'){ echo "Not Delivered";} else{ echo "Delivered";}?></td-->
                  <td><?php if($data['deliveryStatus']=='0'){?>
						<button type="button" id="deliveryStatus-<?php echo $data['id'] ?>" class="btn btn-danger">Not-Delivered</button>
					<?php } elseif($data['deliveryStatus']=='1'){?>
						<button type="button" id="deliveryStatus-<?php echo $data['id'] ?>" class="btn btn-success">Delivered</button>
					<?php } ?>
					<input type="text" style="display:none" value="<?php echo $data['deliveryStatus']?>" class="upd_active-<?php echo $data['id']?>">
					<input type="text" style="display:none"  value="<?php echo $data['id']?>" class="upd_active_id-<?php echo $data['id']?>">
					<script>
						$(document).ready(function(){
							$("#deliveryStatus-<?php echo $data['id'] ?>").click(function(){
								var deliveryStatus = $(".upd_active-<?php echo $data['id']?>").val();
								var id = $(".upd_active_id-<?php echo $data['id']?>").val();
								$.ajax({
									type: "POST",
									url: "<?php echo site_url();?>/admin/ProductSaleOrder/updateDeliveryStatus",
									data: {deliveryStatus:deliveryStatus, id:id},
									success: function(result) {
										//alert(result);
										window.location.href = "<?php echo site_url()?>admin/ProductSaleOrder";
									}
								})
							});
						});
					</script>
				  </td>
                  <td>
						<!--a href="<?php echo site_url();?>admin/Product/UpdateProduct/<?php echo $data['id']?>"><i class="fa fa-edit" style="font-size: 20px;"></i>&nbsp;&nbsp;</a-->
						<a href="<?php echo site_url();?>admin/ProductSaleOrder/manageInvoice/<?php echo $data['id']?>"><i class="fa fa-eye" style="font-size: 22px;"></i></a>
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