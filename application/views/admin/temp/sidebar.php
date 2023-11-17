
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url('asset/dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ALBEA</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('asset/dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$adm['nama']?></a>
        </div>
      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
        <!-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"> -->
          <?php           
            $url = $this->uri->segment(2);
            // $ym = '0;2;3;4;5;6;10;11;12;13;14;15;16;17;18;19;20;21;22;23;24;25;26;27;28;29;31;32;33;34;37;38;39;40;41;42;43;45;46;47;48;49;50;51;52;53;54;55;56;57;59;60;61;63;64;65;66;67;68;69;70;71;72;73;75;78;79;80;84;85;86;87;88;89;90;91;93;95;96;97;98;99;100;101;102;103;104;105;106;107;108;109;110;111;112;113;114;115;116;117;118;119;120;121;122;123;124;125;126;127;128;129;130';
            // $your_menu=explode(';',$ym);
            // $menu = $this->model_menu->getListMenu();
            $your_menu = $adm['your_menu'];
            $menu = $adm['menu'];
            $drawMenu = $this->libgeneral->drawMenuAdmin($your_menu, $menu, 0, $url);
            echo $drawMenu;
          ?>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <!-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v3</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v3</li>
            </ol>
          </div>
        </div>
      </div>
    </div> -->
