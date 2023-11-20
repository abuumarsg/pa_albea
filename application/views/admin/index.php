<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>System Development | Page</title>
	<link rel="shortcut icon" href="<?php echo base_url('asset/dist/img/AdminLTELogo.ico'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/dist/css/adminlte.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/sweetalert2-10.7.0/package/dist/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/toast/jquery.toast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/dist/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/select2/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/plugins/bootstrap-daterangepicker/daterangepicker.css');?>">
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?php echo base_url('asset/index3.html'); ?>" class="brand-link">
                <img src="<?php echo base_url('asset/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SYSDEV APP</span>
            </a>
            <div class="sidebar">
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fa fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item nav-parent">
                            <a href="<?php echo base_url('views/dashboard.html'); ?>" class="nav-link">
                                <i class="fa fa-tachometer nav-icon"></i>
                                <p> Dashboard </p>
                            </a>
                        </li>
                        <li class="nav-item nav-parent">
                            <a href="#" class="nav-link nav-parent-2">
                                <i class="nav-icon fa fa-database"></i>
                                <p> Master Data <i class="right fa fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url('views/master_aplikasi.html'); ?>" class="nav-link">
                                        <i class="fa fa-angle-double-right nav-icon"></i>
                                        <p>Aplikasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('views/master_programmer.html'); ?>" class="nav-link">
                                        <i class="fas fa-angle-double-right nav-icon"></i>
                                        <p>Programmer</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-parent menu-open">
                            <a href="#" class="nav-link nav-parent-2">
                                <i class="nav-icon fa fa-bandcamp"></i>
                                <p> PENGAJUAN <i class="right fa fa-angle-left"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url('views/data_pengajuan_user.html'); ?>" class="nav-link">
                                        &nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                        <p>Pengajuan User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('views/data_pengajuan.html'); ?>" class="nav-link">
                                        &nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                        <p>Pengajuan PIC Program</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('views/validasi_pengajuan.html'); ?>" class="nav-link">
                                        &nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                        <p>Validasi Pengajuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('views/all_pengajuan.html'); ?>" class="nav-link">
                                        &nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                        <p>Data Pengajuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('views/data_tugas.html'); ?>" class="nav-link">
                                        &nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                        <p>Tugas</p>
                                    </a>
                                </li>
                                <li class="nav-item menu-open">
                                    <a href="#" class="nav-link">
                                        &nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                        <p> Login & Register v1 <i class="right fa fa-angle-left"></i> </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="pages/examples/login.html" class="nav-link active">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                            <p>Login v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/register.html" class="nav-link">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                            <p>Register v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/forgot-password.html" class="nav-link">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                            <p>Forgot Password v1</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages/examples/recover-password.html" class="nav-link">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right nav-icon"></i>
                                            <p>Recover Password v1</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-parent">
                            <a href="#" class="nav-link nav-parent-2">
                                <i class="nav-icon fa fa-wrench"></i>
                                <p>Setting<i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url('views/setting_user.html'); ?>" class="nav-link">
                                        <i class="fa fa-user nav-icon"></i>
                                        <p>Setting User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dashboard</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="callout callout-info"><label style="font-size: 12pt;"><i class="fa fa-smile-o"></i> Hallo,
                            NAMA.</label><br>Sysdev App merupakan aplikasi untuk mendokumentasikan proses permintaaan perubahan pada aplikasi di BPRWM, aplikasi ini merupakan <code>platform web</code> Untuk memastikan perangkat lunak ini berjalan secara baik, Anda bisa menggunakan browser
                            yang kami rekomendasikan seperti <code>Google Chrome</code> dan <code>Mozilla Firefox</code>
                            <blockquote class="blockquote-reverse">
                                <p class="mb-0" style="font-size: 9pt;">People who can use and save money is the most happy, because he has both a pleasure.</p>
                                <footer class="blockquote-footer" style="font-size: 8pt;"><cite
                                    title="Penulis Samuel Johnson">Samuel Johnson</cite>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </section>
        </div>
        <input type="hidden" name="actualLink" value="<?php// echo $model_menu->actualLink(); ?>">
        <script type="text/javascript">
            $(document).ready(function(){
                menuActive();
            });

            function menuActive() {
                var actualLink = $('input[name="actualLink"]').val();
                $('.nav-sidebar a[href="'+actualLink+'"]').addClass('active');
                $($('.nav-sidebar a[href="'+actualLink+'"]').closest('.nav-parent')).children().addClass('active');
                $($('.nav-sidebar a[href="'+actualLink+'"]').closest('.nav-parent')).addClass('menu-open');
            }
        </script>
        <div id="modal_error" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Notifikasi Error</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2022-<?=date('Y')?> <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
        <style type="text/css">
            .control-sidebar .nav-item p{
                color: white;
            }
            .control-sidebar .nav-item i{
                color: white;
            }
        </style>
    </div>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('asset/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('asset/dist/js/adminlte.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/plugins/sweetalert2-10.7.0/package/dist/sweetalert2.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/plugins/toast/jquery.toast.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/plugins/select2/js/select2.full.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/plugins/moment/moment.min.js');?>"></script>
    <script src="<?php echo base_url('asset/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- <script src="<?php //echo base_url('asset/plugins/bootstrap-datepicker/bootstrap-datepicker.js');?>"></script> -->
    <script src="<?php echo base_url('asset/plugins/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
    <script src="<?php echo base_url('asset/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
    <script src="<?php echo base_url('asset/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js');?>"></script>
    <!-- <script src="<?php// echo base_url('asset/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js');?>"></script> -->
    <script src="<?php echo base_url('asset/dist/js/custom.js'); ?>"></script>
    <!-- <script src="<?php //echo base_url('asset/plugins/fontawesome-free-6.4.0/js/fontawesome.min.js'); ?>"></script> -->
    <script type="text/javascript">
        function submitAjax(urlx, modalx, formx, url_kode, idf_kode, usage, notif) {
            if (usage == 'status') {
                var datax = formx;
            } else {
                var datax = $('#'+formx).serialize();
            }
            $.ajax({
                url: urlx,
                method: "POST",
                data: datax,
                dataType: 'json',
                success: function (data) {
                    // if (usage == 'modal') {
                    if (modalx !== null) {
                        $('#' + modalx).modal('toggle');
                        toast_notif(data['status'],data['msg']);
                    }else{
                        toast_notif(data['status'],data['msg']);
                    }
                },
                // error: function (data) {
                // 	toast_notif(data['status'],data['msg']);
                // }
                error: function(xhr, status, error) {
                    waiting3_hide();
                    show_modal_error(xhr.responseText);
                    $('#form_add button[type="submit"]').removeAttr('disabled');
                }
            });
        }
        function getAjaxData(urlx,where,param=null) {
            var viewx;
            $.ajax({
                url : urlx,
                method : "POST",
                data : where,
                async : false,
                dataType : 'json',
                success: function (data){
                    if (param !== null) {
                        toast_notif(data['status'],data['msg']);
                    }else if(param == 'nonotif'){
                        viewx = false;
                    }else{
                        viewx = data;
                    }
                // },
                // error:function(data){
                // 	toast_notif('error', 'Invalid Parameter');
                // }
                },
                error: function(xhr, status, error) {
                    waiting3_hide();
                    show_modal_error(xhr.responseText);
                    $('#form_add button[type="submit"]').removeAttr('disabled');
                }
            });
            return viewx;
        }
        function notValidParamx() {
            toast_notif('error', 'INVALID');
        }
        function getSelect2(urlx, formx, datax) {
            $.ajax({
                method: "POST",
                url: urlx,
                data: datax,
                async: false,
                dataType: 'json',
                success: function (data) {
                    var html = '<option value="null">Pilih Data</option>';
                    $.each(data, function (key, value) {
                        html += '<option value="' + key + '">' + value + '</option>';
                    });
                    $('#' + formx).html(html);
                },
                // error: function (data) {
                // toast_notif('error', 'INVALID');
                // }
                error: function(xhr, status, error) {
                    waiting3_hide();
                    show_modal_error(xhr.responseText);
                    $('#form_add button[type="submit"]').removeAttr('disabled');
                }
            });
        }
    </script>
</body>
</html>
