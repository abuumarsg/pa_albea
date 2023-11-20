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
        <div class="content-wrapper">
        