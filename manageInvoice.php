<style>
    .success-message {
        font-size: 20px;
        margin-bottom: 10px;
        text-align: center;
        color: #95c840;
    }
    
    .we {
        width: 100%;
        float: left;
    }
    
    .left {
        float: left;
        width: 40%;
    }
	 .left p{ padding:10px;}
    
    .right {
        float: right;
        width: 30%;
    }
    
    .head {
        width: 100%;
    }
    
    .left-2 {
        width: 30%;
        float: left;
    }
    
    .right-3 {
        width: 60%;
        float: right;
    }
    
    .order {
        width: 100%;
        background-color: #E0E5EC;
        border-radius: 5px;
        float: left;
        padding: 0px 8px 8px 8px;
        margin-top: 30px;
    }
    
    .item {
        width: 100%;
        margin-top: 20px;
        float: left;
        text-align: center;
    }
    
    ..item td {
        padding: 15px;
    }
	div#example1_filter {
		visibility: hidden;
	}
	div#example1_length {
		visibility: hidden;
	}
	div#example1_paginate {
		visibility: hidden;
	}
	div#example1_info {
		display: none;
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
        <li><a href="<?php echo site_url();?>admin/ProductSaleOrder/"><button class="btn btn-primary">Go Back</button></a></li>
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

                                <div class="head">
                                    <div class="left-2">
                                        <h3>User Details </h3>
                                    </div>
                                    <div class="right-2">
                                        <h3 style="float: right;">Shipping Address Information To</h3>
                                    </div>
                                </div>
                                <div class="we">
                                    <div class="left">
                                        <p style="font-size: 16px;">
                                            <b>Name:</b> <?php echo $datas['name'];?>
                                            <br> <b>Phone Number:</b>     <?php echo $datas['phone'];?>
                                            <br><b> Email:</b> <?php echo $datas['email'];?>
                                            <br> <b>Order Id:</b> #<?php echo $datas['orderId'];?>
                                            <br> <b>Customer Id:</b> <?php echo $datas['customer_id'];?>
                                            <br> <b>Transaction Id:</b> <?php echo $datas['transaction_id'];?>
                                            <br> <b>Order Date:</b> <?php echo $datas['created'];?>
										</p>

                                    </div>

                                    <div class="right">
                                        <p style="float: right; font-size: 16px;">
										<?php if(!empty( $datas['country'])){?>
											<b>Country:</b>  <?php echo $datas['country'];?>
                                            <br> <b>state:</b> <?php echo $datas['state'];?>
                                            <br> <b>city:</b> <?php echo $datas['city'];?>
                                            <br> <b>address:</b> <?php echo $datas['address'];?>
                                            <br> <b>zipCode:</b> <?php echo $datas['zipCode'];?>
										<?php } else {?>
											Pick From Shop
										<?php }?>
										</p>
                                    </div>
                                </div>

                                <div class="order">
                                    <h3>Order summary</h3>

                                </div>
                                <table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
								  <th>No.</th>
								  <th>Item</th>
								  <th>Price</th>
								  <th>Quantity</th>
								  <th>Totals</th>
								 </tr>
								</thead>
								<tbody>
								<?php $i = 1; foreach($addToCartDetails as $data){?>
								<tr>
								  <td><?php echo $i?></td>
								  <?php $productDetails = $this->db->get_where('product',array('id' => $data['productId']))->row_array();?>
								  <td><?php echo $productDetails['title'];?></td>
								  <td><?php echo  $productDetails['price'];?></td>
								  <td><?php echo $data['quantity']?></td>
								  <td><?php $totalPrice = $productDetails['price'] * $data['quantity']; echo $totalPrice;?></td>
								</tr>
								
								<?php $i++; } ?>
								
								</tbody>
							  </table>
							  <div class="total-5">
								Total Price =>  <?php echo $datas['amount']; ?>
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
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>