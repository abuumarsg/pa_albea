
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-cogs"></i> SETTING</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><i class="fas fa-cogs"></i> Setting User Group</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-database"></i> Setting Data User Group</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" onclick="getTableData()">
                <i class="fas fa-sync"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="pull-left">
                  <?php 
                    if (in_array($access['l_ac']['add'], $access['access'])) {
                      echo '<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#add_ug"><i class="fa fa-plus"></i> Tambah User Group</button>';
                    }
                  ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="pull-right" style="font-size: 8pt; text-align: right;">
                  <i class="fa fa-toggle-on stat scc"></i> Aktif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                  <i class="fa fa-toggle-off stat err"></i> Tidak Aktif
                </div>
              </div>
            </div>
            <?php if(in_array($access['l_ac']['add'], $access['access'])){?>
              <div class="collapse" id="add_ug">
                <br>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <form id="form_add">
                      <div class="form-group">
                        <label>Nama User Group</label>
                        <input type="text" placeholder="Masukkan Nama User Group" name="nama" class="form-control" required="required" >
                      </div>
                      <!-- <div class="form-group">
                        <label>Filter Bagian <br><small class="text-muted">Filter berdasarkan bagian <i>(Kosongkan jika berdasarkan bagian karyawan terkait)</i></small></label>
                        <select class="form-control select2" name="list_bagian[]" id="data_list_bagian_add" multiple="multiple" style="width: 100%;"></select>
                      </div> -->
                      <div class="form-group">
                        <input type="hidden" name="menu_add" id="jstreeMenuAdd_add" required="required">
                        <div class="panel panel-primary">
                          <div class="panel-heading"><i class="fa fa-list"></i> Pilih Menu</div>
                          <div class="panel-body" style="max-height: 500px; overflow: auto;">
                            <div id="jstreeMenuAdd">
                              <ul class="dropdown">
                                <li data-jstree='{"icon":"fa fa-plus-circle"}' id="0">Pilih Semua
                                  <ul>
                                    <?php
                                    $ml=$this->model_master->getListMenuActive();
                                    echo $this->libgeneral->getDrawMenu2($ml,0);
                                    ?>
                                  </ul>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="panel panel-danger">
                          <div class="panel-heading"><i class="fa fa-lock"></i> Pilih Hak Akses</div>
                          <div class="panel-body" style="max-height: 500px; overflow: auto;">
                            <div id="jstreeAccessAdd">
                              <ul class="dropdown">
                                <li data-jstree='{"icon":"fa fa-plus-circle"}' id="0">Pilih Semua
                                  <ul>
                                    <?php
                                    foreach($hak_access as $ac)
                                    {
                                      echo '<li data-jstree=\'{"icon":"fa fa-link"}\' id="'.$ac->id_access.'"><a href="#">'.$ac->nama.'</a></li>';
                                    }
                                    ?>
                                  </ul>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="akses_add" id="jstreeAccessAdd_add" required="required">
                      </div>
                    </form>
                    <div class="form-group">
                      <button type="button" onclick="do_add()" id="btn_add" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <table id="table_data" class="table table-bordered table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama User Group</th>
                  <th>List Menu</th>
                  <th>Hak Akses</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div id="view" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Detail Data <b class="text-muted header_data"></b></h2>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <input type="hidden" name="data_id_view">
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-6 control-label">Nama User Group</label>
              <div class="col-md-6" id="data_name_view"></div>
            </div>
            <div class="form-group row">
              <label class="col-md-6 control-label">Total Menu</label>
              <div class="col-md-6" id="data_menu_view"></div>
              <div class="col-md-12 data_detail" id="data_menu_detailx"></div>
            </div>
            <div class="form-group row">
              <label class="col-md-6 control-label">Total Akses</label>
              <div class="col-md-6" id="data_akses_view"></div>
              <div class="col-md-12 data_detail" id="data_akses_detailx"></div>
            </div>
            <!-- <div class="form-group row">
              <label class="col-md-6 control-label">List Bagian</label>
              <div class="col-md-6" id="data_list_bagian_detail_view"></div>
            </div> -->
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-6 control-label">Status</label>
              <div class="col-md-6" id="data_status_view"></div>
            </div>
            <div class="form-group row">
              <label class="col-md-6 control-label">Dibuat Tanggal</label>
              <div class="col-md-6" id="data_create_date_view"></div>
            </div>
            <div class="form-group row">
              <label class="col-md-6 control-label">Diupdate Tanggal</label>
              <div class="col-md-6" id="data_update_date_view"></div>
            </div>
            <div class="form-group row">
              <label class="col-md-6 control-label">Dibuat Oleh</label>
              <div class="col-md-6" id="data_create_by_view">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-6 control-label">Diupdate Oleh</label>
              <div class="col-md-6" id="data_update_by_view">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <?php if (in_array($access['l_ac']['edt'], $access['access'])) {
          echo '<button type="submit" class="btn btn-info" onclick="edit_modal()"><i class="fa fa-edit"></i> Edit</button>';
        }?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Edit Data <b class="text-muted header_data"></b></h2>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="form_edit">
        <div class="modal-body">
          <input type="hidden" id="data_id_edit" name="id" value="">
          <div class="form-group">
            <label>Nama User Group</label>
            <input type="text" placeholder="Masukkan Nama User Group" id="data_nama_edit" name="nama" class="form-control" required="required" >
          </div>
          <!-- <div class="form-group">
            <label>Filter Bagian <br><small class="text-muted">Filter berdasarkan bagian <i>(Kosongkan jika berdasarkan bagian karyawan terkait)</i></small></label>
            <select class="form-control select2" name="list_bagian[]" id="data_list_bagian_edit" multiple="multiple" style="width: 100%;"></select>
          </div> -->
          <div class="form-group">
            <input type="hidden" name="menu_edit" id="jstreeMenuEdit_edit" required="required">
            <div class="panel panel-primary">
              <div class="panel-heading"><i class="fa fa-list"></i> Pilih Menu</div>
              <div class="panel-body" style="max-height: 500px; overflow: auto;">
                <div id="jstreeMenuEdit">
                  <ul class="dropdown">
                    <li data-jstree='{"icon":"fa fa-plus-circle"}' id="0">Pilih Semua
                      <ul>
                        <?php
                        $ml=$this->model_master->getListMenuActive();
                        echo $this->libgeneral->getDrawMenu2($ml,0);
                        ?>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="panel panel-danger">
              <div class="panel-heading"><i class="fa fa-lock"></i> Pilih Hak Akses</div>
              <div class="panel-body" style="max-height: 500px; overflow: auto;">
                <div id="jstreeAccessEdit">
                  <ul class="dropdown">
                    <li data-jstree='{"icon":"fa fa-plus-circle"}' id="0">Pilih Semua
                      <ul>
                        <?php
                        foreach($hak_access as $ac)
                        {
                          echo '<li data-jstree=\'{"icon":"fa fa-link"}\' id="'.$ac->id_access.'" class="hae_'.$ac->id_access.'"><a href="#">'.$ac->nama.'</a></li>';
                        }
                        ?>
                      </ul>
                    </li>
                  </ul>
                </div>
                <input type="hidden" name="akses_edit" id="jstreeAccessEdit_edit" required="required">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="do_edit()" id="btn_edit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>

  </div>
</div>
<div id="modal_delete_partial"></div>
<script src="<?php echo base_url('asset/plugins/jquery/jquery.min.js')?>"></script>
<script>
  var table="master_user_group";
  var column="id_group";
  $(document).ready(function(){ 
    $('#jstreeMenuAdd, #jstreeAccessAdd, #jstreeMenuUserAdd, #jstreeAccessUserAdd,#jstreeMenuEdit,#jstreeAccessEdit,#jstreeMenuUserEdit,#jstreeAccessUserEdit').jstree({
      'plugins': ["wholerow", "checkbox"]
    });
    jstreeLoad(['jstreeMenuAdd','jstreeAccessAdd','jstreeMenuUserAdd','jstreeAccessUserAdd'],'add');
    jstreeLoad(['jstreeMenuEdit','jstreeAccessEdit','jstreeMenuUserEdit','jstreeAccessUserEdit'],'edit');
    // getSelect2("<?php //echo base_url('master/master_bagian/get_select2')?>",'data_list_bagian_add');	
    table_data('table_data',"<?php echo base_url('admin/master_user_group/view_all/')?>");
  });
  function table_data(id,urlx) {
    $('#'+id).DataTable().destroy();
    $('#'+id).DataTable( {
      ajax: {
        url: urlx,
        type: 'POST',
        data:{access:"<?php echo $this->codegenerator->encryptChar($access);?>"}
      },
      scrollX: true,
      columnDefs: [
      {   targets: 0, 
        width: '5%',
        render: function ( data, type, full, meta ) {
          return '<center>'+(meta.row+1)+'.</center>';
        }
      },
      {   targets: 1,
        width: '15%',
        render: function ( data, type, full, meta ) {
          return data;
        }
      },
      {   targets: 2,
        width: '15%',
        render: function ( data, type, full, meta ) {
          return '<a onclick="detail_menu('+full[0]+')" style="color: #4286f4;cursor: pointer;"><i class="fa fa-eye"></i> '+data+'</a>'+
          '<div class="data_detail" id="d_menu_'+full[0]+'" style="display: none;">'+full[7]+'</div>';
        }
      },
      {   targets: 3,
        width: '10%',
        render: function ( data, type, full, meta ) {
          return '<a onclick="detail_access('+full[0]+')" style="color: #4286f4;cursor: pointer;"><i class="fa fa-eye"></i> '+data+'</a>'+
          '<div class="data_detail" id="d_access_'+full[0]+'" style="display: none;margin-top: 15px;">'+full[8]+'</div>';
        }
      },
      {   targets: 4,
        width: '5%',
        render: function ( data, type, full, meta ) {
          return '<center>'+data+'</center>';
        }
      },
      {   targets: 5,
        width: '10%',
        render: function ( data, type, full, meta ) {
          return '<center>'+data+'</center>';
        }
      },
      {   targets: 6,
        width: '5%',
        render: function ( data, type, full, meta ) {
          return '<center>'+data+'</center>';
        }
      }
      ]
    });
  }
  function jstreeLoad(datax,usage) {
    $.each(datax, function (index, value) {
      $('#'+value).on('ready.jstree', function () {
        $("#"+value).jstree("open_all");
      });
      $('#'+value).on("changed.jstree", function (e, data) {			
        var checked_ids = [data.selected];
        var undetermined=$('#'+value).jstree().get_undetermined();
        undetermined = jQuery.grep(undetermined, function( a ) {
          return a != 0;
        });
        if (undetermined.length > 0) {
          checked_ids.push(undetermined);
        }
            $('#'+value+'_'+usage).val(checked_ids);
      });
    });
  }
  function data_menu_detail() {
    $('#data_menu_detailx').slideToggle('slow');
  }
  function data_akses_detail() {
    $('#data_akses_detailx').slideToggle('slow');
  }
  function detail_menu(id) {
    $('#d_menu_'+id).slideToggle('slow');
  }
  function detail_access(id) {
    $('#d_access_'+id).slideToggle('slow');
  }
  function view_modal(id) {
    var data={id_group:id};
    var callback=getAjaxData("<?php echo base_url('admin/master_user_group/view_one')?>",data);  
    $('#view').modal('show');
    $('.header_data').html(callback['nama']);
    $('#data_name_view').html(callback['nama']);
    $('#data_menu_view').html('<a style="cursor: pointer;color: #0084FC;" onclick="data_menu_detail()"><i class="fa fa-eye"></i> '+callback['menu']+'</a>');
    $('#data_akses_view').html('<a style="cursor: pointer;color: #0084FC;" onclick="data_akses_detail()"><i class="fa fa-eye"></i> '+callback['akses']+'</a>');
    $('#data_menu_detailx').html(callback['detail_menu']);
    $('#data_akses_detailx').html(callback['detail_akses']);
    $('#data_list_bagian_detail_view').html(callback['list_bagian_detail']);
    var status = callback['status'];
    if(status==1){
      var statusval = '<b class="text-success">Aktif</b>';
    }else{
      var statusval = '<b class="text-danger">Tidak Aktif</b>';
    }
    $('#data_status_view').html(statusval);
    $('#data_create_date_view').html(callback['create_date']+' WIB');
    $('#data_update_date_view').html(callback['update_date']+' WIB');
    $('input[name="data_id_view"]').val(callback['id']);
    $('#data_create_by_view').html(callback['nama_buat']);
    $('#data_update_by_view').html(callback['nama_update']);
  }
  function edit_modal() {
    $('#jstreeMenuEdit').jstree(true).deselect_all();
    $('#jstreeAccessEdit').jstree(true).deselect_all();
    // getSelect2("<?php echo base_url('admin/master_bagian/get_select2')?>",'data_list_bagian_edit');
    var id = $('input[name="data_id_view"]').val();
    var data={id_group:id};
    var iz;
    var ix;
    var callback=getAjaxData("<?php echo base_url('admin/master_user_group/view_one')?>",data); 
    $('#view').modal('toggle');
    setTimeout(function () {
      $('#edit').modal('show');
    },600); 
    $('.header_data').html(callback['nama']);
    $('#data_id_edit').val(callback['id']);
    $('#data_nama_edit').val(callback['nama']);
    for(ix=0; ix<callback['checked_menu'].length; ix++){
      $('#jstreeMenuEdit').jstree(true).select_node(callback['checked_menu'][ix]);
    }
    for(iz=0; iz<callback['checked_akses'].length; iz++){
      $('#jstreeAccessEdit').jstree(true).select_node(callback['checked_akses'][iz]);
    }
    $('#data_list_bagian_edit').val(callback['list_bagian']).trigger('change');
  }

  function delete_modal(id) {
    var data={id_group:id};
    var callback=getAjaxData("<?php echo base_url('admin/master_user_group/view_one')?>",data);
    var datax={table:table,column:column,id:id,nama:callback['nama']};
    loadModalAjax("<?php echo base_url('pages/load_modal_delete')?>",'modal_delete_partial',datax,'delete');
  }
  //doing db transaction
  function do_status(id,data) {
    var data_table={status:data};
    var where={id_group:id};
    var datax={table:table,where:where,data:data_table};
    submitAjax("<?php echo base_url('global_control/change_status')?>",null,datax,null,null,'status');
    $('#table_data').DataTable().ajax.reload(function (){
      // Pace.restart();
    });
  }
  function do_edit(){
    if($("#form_edit")[0].checkValidity()) {
      submitAjax("<?php echo base_url('admin/edt_user_group')?>",'edit','form_edit',null,null);
      $('#table_data').DataTable().ajax.reload(function (){
        // Pace.restart();
      });
    }else{
      notValidParamx();
    } 
  }
  function do_add(){
    if($("#form_add")[0].checkValidity()) {
      submitAjax("<?php echo base_url('master/add_user_group')?>",null,'form_add',null,null);
      $('#table_data').DataTable().ajax.reload(function (){
        // Pace.restart();
      });
      $('#form_add')[0].reset();
      $('#jstreeAccess').jstree(true).deselect_all();
      $('#jstree').jstree(true).deselect_all();
    }else{
      notValidParamx();
    } 
  }
</script>

