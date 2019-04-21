<!DOCTYPE html>
<html>
<head>
	<?php $cssVersion = date('H:i:s'); ?>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mini Car Inventory System</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="<?= base_url('assets/css/dropzone.min.css') ?>" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css?v='.$cssVersion) ?>" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
    <script type="text/javascript">
    	var BASE_URL = '<?= base_url() ?>';
    </script>
	<style media="screen">
      /*body { padding-top: 70px; }*/
      #connectLogo {
        height: 60px;
        padding: 15px 0 5px 0;
      }
      #logo {
        height: 60px;
        padding: 5px 0 5px 20px;
      }

      .share-link {
        line-height: 60px;
        padding: 0 1em;
        font-size: 2em;
      }
    </style>
</head>
<body>
	<div class="loader"></div>
	<nav class="navbar navbar-default NO navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">

	      <button type="button" class="navbar-toggle collapsed menu-toggle">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>

	      <a class="NOnavbar-brand">
	        <img id="logo" src="<?= base_url('assets/images/codemaxlogo.png') ?>" alt="Talk Fusion">
	      </a>

	    </div>
	  </div>
	</nav>
	<div id="wrapper">
	    <!-- Sidebar -->
	    <div id="sidebar-wrapper">
	        <ul class="sidebar-nav">
	            <li class="sidebar-brand">
	       			<a>Car Inventory System</a>
	            </li>
	            <li class="<?= ($this->uri->segment(1) == 'manufacturer')?'active':'' ?>">
	                <a href="<?= base_url('manufacturer') ?>">Add Manufacturer</a>
	            </li>
	            <li class="<?= ($this->uri->segment(1) == 'model')?'active':'' ?>">
	                <a href="<?= base_url('model') ?>">Add Model</a>
	            </li>
	            <li class="<?= ($this->uri->segment(1) == 'inventory')?'active':'' ?>">
	                <a href="<?= base_url('inventory') ?>">View Inventory</a>
	            </li>
	        </ul>
	    </div>
	    <!-- /#sidebar-wrapper -->