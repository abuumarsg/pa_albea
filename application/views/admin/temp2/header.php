<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>System Development | Page</title>
    <link rel="stylesheet" href="<?php echo base_url('asset/plugins/fontawesome-free/css/all.min.css')?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('asset/dist/css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/dist/css/style.css')?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url('asset/plugins/JsTree/dist/themes/default/style.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/plugins/iconpicker/dist/css/fontawesome-iconpicker.min.css');?>">
    <link rel="icon" href="<?php echo base_url('asset/dist/img/AdminLTELogo.png');?>" type="image/png">
    
	<link rel="shortcut icon" href="<?php echo base_url('asset/dist/img/AdminLTELogo.ico'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/dist/css/adminlte.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/dist/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/select2/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">
	<script src="<?php echo base_url('asset/plugins/jquery/jquery.min.js'); ?>"></script>
</head>
<style>
	.box-group{
		position: relative;border-style: solid;border-width: 1px;border-color: #D2D6DE;padding: 20px;
		margin-bottom: 20px;
	}
	.box-title-group{
		position: absolute;top: -10px;left: 15px;background-color: white;font-weight: bold;
	}
</style>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">      
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url('asset/dist/img/AdminLTELogo.png'); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs">USE</span>
                    </a>
                    <ul class="dropdown-menu" style="width: 350px;">
                        <li class="user-header">
                            <img src="<?php echo base_url('asset/dist/img/AdminLTELogo.png'); ?>" class="brand-image img-circle elevation-3" alt="User Image">
                            <p>
                                USER
                                <small>GROUP </small>
                                <small>ID </small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php //echo base_url('kpages/profile');?>" class="btn btn-flat btn-success"><i class="fa fa-user"></i> Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('controllers/auth.php?p=logout');?>" class="btn btn-flat btn-danger">Log Out <i class="fa fa-sign-out"></i></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>