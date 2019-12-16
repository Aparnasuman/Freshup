<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Freshup | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
	.form-success {
		color: #3ba73b;
		font-size: 17px;
	}
	.form-error {
		color: #de5252;
	}
	.invalidLogin {
		text-align: center;
		padding-bottom: 10px;
		padding-top: 0px;
	}
	.navbar-nav>.user-menu>.dropdown-menu>.user-footer {
		background-color: #f9f9f9;
		padding: 10px 2px;
	}
	li.user-footer {
		display: flex;
	}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Admin</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b> Freshup</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-globe" aria-hidden="true"></i>
              <!--span class="label label-warning">10</span-->
            </a>
            <ul class="dropdown-menu">
              <li class="header">Language</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="<?php echo site_url();?>admin/admin/changeLanguage/en">
                      <i class="fa fa-language text-aqua" style="color: #000000 !important" aria-hidden="true"></i> English
                    </a>
                  </li>
				  <li>
                    <a href="<?php echo site_url();?>admin/admin/changeLanguage/fr">
                      <i class="fa fa-language text-aqua" style="color: #000000 !important" aria-hidden="true"></i> French
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if(empty($admin['image'])){?>
				  <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg"  class="img-circle" alt="User Image">
				<?php } else{?>
				  <img src="<?php echo $admin['image'];?>" style="width: 20px;height: 20px;" class="img-circle" alt="User Image">
				<?php } ?>
              <span class="hidden-xs"><?php echo $admin['username']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if(empty($admin['image'])){?>
				  <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				<?php } else{?>
				  <img src="<?php echo $admin['image'];?>" class="img-circle" alt="User Image">
				<?php } ?>
                <p>
                  <?php echo $admin['username']?>
                  <small><?php echo $admin['email']?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="userSetting">
                  <a href="<?php echo base_url()?>index.php/admin/admin/profile" class="btn btn-default btn-flat">Profile</a>
                </div> 
				<div class="userSetting" style="margin: 0px 2px;">
                  <a href="<?php echo base_url()?>index.php/admin/admin/changePassword" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="userSetting">
                  <a href="<?php echo base_url()?>index.php/admin/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
		<?php if(empty($admin['image'])){?>
          <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
		<?php } else{?>
		  <img src="<?php echo $admin['image'];?>" class="img-circle" alt="User Image">
		<?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $admin['username']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><?php if($this->session->userdata('language') == 'en'){ echo "MAIN NAVIGATION"; } else { echo "Navigation principale"; }?></li>
        <li class="<?php if($active == 'dashboard'){ echo "active"; } ?> treeview">
          <a href="">
            <i class="fa fa-dashboard"></i> <span><?php if($this->session->userdata('language') == 'en'){ echo "Dashboard"; } else { echo "tableau de bord"; }?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($active == 'dashboard'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/admin/dashboard"><i class="fa fa-circle-o"></i><?php if($this->session->userdata('language') == 'en'){ echo "Overview"; } else { echo "vue d'ensemble"; }?></a></li>
            <!--li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li-->
          </ul>
        </li>
		<li class="treeview">
            <li <?php if($active == 'userDetails'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/User"><i class="fa fa-book"></i><?php if($this->session->userdata('language') == 'en'){ echo "User Details"; } else { echo "détail de l'utilisateur"; }?></a></li> 
        </li>
		<li class="<?php if($active == 'services' || $active == 'subServices' || $active == 'subSubServices'){ echo "active"; } ?> treeview" <?php if($active == 'AppLogo'){ echo "class='active'"; } ?>>
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span><?php if($this->session->userdata('language') == 'en'){ echo "Services"; } else { echo "prestations de service"; }?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($active == 'services'){ echo "class='active'"; } ?> ><a href="<?php echo site_url();?>admin/Services"><i class="fa fa-circle-o"></i><?php if($this->session->userdata('language') == 'en'){ echo "Manage Services"; } else { echo "gérer les services"; }?> </a></li>
            <li <?php if($active == 'subServices'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/Services/subServices"><i class="fa fa-circle-o"></i><?php if($this->session->userdata('language') == 'en'){ echo "Category"; } else { echo "Catégorie"; }?></a></li>
			 <li <?php if($active == 'subSubServices'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/Services/subSubServices"><i class="fa fa-circle-o"></i><?php if($this->session->userdata('language') == 'en'){ echo "Sub Category"; } else { echo "sous catégorie"; }?> </a></li>
          </ul>
        </li>
		
		<li class="<?php if($active == 'product' || $active == 'productCategory' || $active == 'productSubCategory'){ echo "active"; } ?> treeview" <?php if($active == 'AppLogo'){ echo "class='active'"; } ?>>
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span><?php if($this->session->userdata('language') == 'en'){ echo "Products"; } else { echo "produit"; }?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($active == 'productCategory'){ echo "class='active'"; } ?> ><a href="<?php echo site_url();?>admin/Product/productCategory"><i class="fa fa-circle-o"></i> <?php if($this->session->userdata('language') == 'en'){ echo "Category"; } else { echo "Catégorie"; }?></a></li>
            <li <?php if($active == 'productSubCategory'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/Product/productSubCategory"><i class="fa fa-circle-o"></i><?php if($this->session->userdata('language') == 'en'){ echo "Sub Category"; } else { echo "sous catégorie"; }?></a></li>
			<li <?php if($active == 'product'){ echo "class='active'"; } ?> ><a href="<?php echo site_url();?>admin/Product"><i class="fa fa-book"></i> <span><?php if($this->session->userdata('language') == 'en'){ echo "Product"; } else { echo "produit"; }?></span></a></li>
          </ul>
        </li>				
		<li class="treeview">            
		<li <?php if($active == 'productSaleOrder'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/ProductSaleOrder"><i class="fa fa-user"></i><?php if($this->session->userdata('language') == 'en'){ echo "Sale Order"; } else { echo "Toute les ventes"; }?></a></li></li>
		<li class="treeview">
            <li <?php if($active == 'barber'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/Barber"><i class="fa fa-user"></i><?php if($this->session->userdata('language') == 'en'){ echo "Barber"; } else { echo "coiffeur"; }?></a></li> 
        </li>
		<li class="treeview">
            <li <?php if($active == 'joinQueBarber'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/Barber/joinQueBarber"><i class="fa fa-user"></i><?php if($this->session->userdata('language') == 'en'){ echo "join Que Barber"; } else { echo "coiffeur sans RDV"; }?></a></li> 
        </li>
		<li class="treeview">
            <li <?php if($active == 'slot_time'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/Slot_time"><i class="fa fa-book"></i><?php if($this->session->userdata('language') == 'en'){ echo "Time Slot"; } else { echo "créneau horaire"; }?></a></li> 
        </li>
		<li class="treeview">
            <li <?php if($active == 'userBookingServices'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/UserBookingServices"><i class="fa fa-book"></i><?php if($this->session->userdata('language') == 'en'){ echo "Booking Services"; } else { echo "services de réservation"; }?></a></li> 
        </li>
		<li class="treeview">
            <li <?php if($active == 'payment'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/Payment"><i class="fa fa-book"></i><?php if($this->session->userdata('language') == 'en'){ echo "Payment Setting"; } else { echo "paramètre de paiement"; }?></a></li> 
        </li>
		<li class="treeview">
            <li <?php if($active == 'calendar'){ echo "class='active'"; } ?>><a href="<?php echo site_url();?>admin/Calendar"><i class="fa fa-book"></i><?php if($this->session->userdata('language') == 'en'){ echo "Calendar"; } else { echo "calendrier"; }?></a></li> 
        </li>
		
		 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
