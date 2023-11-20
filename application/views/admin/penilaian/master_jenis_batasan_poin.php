
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-cogs"></i> SETTING</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><i class="fas fa-cogs"></i> Master Jenis Batasan Poin</li>
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
            <h3 class="card-title"><i class="fa fa-list"></i> Daftar Jenis Batasan Poin</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" onclick="getTableData()"> <i class="fas fa-sync"></i> </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"> <i class="fas fa-minus"></i> </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"> <i class="fas fa-times"></i> </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="pull-left">
                  <?php 
                    if (in_array($access['l_ac']['add'], $access['access'])) {
                      echo '<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#add" id="btn_add_collapse"><i class="fa fa-plus"></i> Tambah Jenis Batasan Poin</button>';
                    }
                  ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="pull-right" style="font-size: 8pt; text-align: right;">
                  <i class="fa fa-toggle-on stat scc"></i> Aktif <br>
                  <i class="fa fa-toggle-off stat err"></i> Tidak Aktif
                </div>
              </div>
            </div>
            <?php if(in_array($access['l_ac']['add'], $access['access'])){?>
              <div class="collapse" id="add">
                <br>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <form id="form_add">
                      <div class="form-group">
                        <label>Kode Jenis Batasan Poin</label>
                        <input type="text" placeholder="Masukkan Kode Jenis Batasan Poin" name="kode" id="data_kode_add" class="form-control" required="required" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <label>Nama Jenis Batasan Poin</label>
                        <input type="text" placeholder="Masukkan Nama Jenis Batasan Poin" name="nama" id="data_name_add" class="form-control" required="required">
                      </div>
                      <div class="form-group">
                        <label class="checkbox">Lebih Dari Batasan Maksimal Poin
                          <input type="checkbox" name="lebih_max" id="data_lebih_max_add" value="1">
                          <span class="checkmark"></span>
                        </label>
                      </div>
                      <div class="panel panel-primary">
                        <div class="panel-heading">Batasan Poin</div>
                        <div class="panel-body">
                          <p class="text-muted" style="padding-left: 10px;">Kosongkan jika tidak ada poin dan satuan!</p>
                          <?php for ($i=1; $i <= $this->libgeneral->poin_max_range(); $i++) { ?>
                            <div class="row">
                              <div class="col-md-4">
                                <label>Poin <?php echo $i; ?></label>
                                <input type="text" placeholder="Masukkan Poin <?php echo $i; ?>" name="poin_<?php echo $i; ?>" class="form-control">
                              </div>
                              <div class="col-md-8">
                                <label>Satuan <?php echo $i; ?></label>
                                <input type="text" placeholder="Masukkan Satuan <?php echo $i; ?>" name="satuan_<?php echo $i; ?>" class="form-control">
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="button" onclick="do_add()" id="btn_add" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php } ?>
            <table id="table_data" class="table table-bordered table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode Jenis Batasan Poin</th>
                  <th>Nama Jenis Batasan Poin</th>
                  <th>Lebih Dari Max Poin</th>
                  <th>Batasan Poin</th>
                  <th>Tanggal</th> 
                  <th>Status</th> 
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
              <label class="col-md-6 control-label">Kode Jenis Batasan Poin</label>
              <div class="col-md-6" id="data_kode_view"></div>
            </div>
            <div class="form-group row">
              <label class="col-md-6 control-label">Nama Jenis Batasan Poin</label>
              <div class="col-md-6" id="data_name_view"></div>
            </div>
            <div class="form-group row">
              <label class="col-md-6 control-label">Lebih Dari Maksimal Poin</label>
              <div class="col-md-6" id="data_lebih_max_view"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-6 control-label">Status</label>
              <div class="col-md-6" id="data_status_view">
                
              </div>
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
        <hr>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <h3 class="text-center">Rincian Point</h3>
            <table class="table table-hover table-striped">
              <thead>
                <tr class="bg-blue">
                  <th class="text-center">Point</th>
                  <th class="text-center">Satuan</th>
                </tr>
              </thead>
              <tbody id="data_tr_view">
              </tbody>
            </table>            
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
      <div class="modal-body">
        <form id="form_edit">
          <input type="hidden" id="data_id_edit" name="id" value="">
          <input type="hidden" id="data_parent_old_edit" name="parent_old" value="">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label>Nama Menu</label>
                <input type="text" placeholder="Masukkan Nama Menu" id="data_name_edit" name="nama"
                  class="form-control field" required="required">
              </div>
              <div class="form-group row">
                <label>URL</label>
                <input type="text" placeholder="Masukkan URL" id="data_url_edit" name="url" class="form-control field"
                  required="required">
              </div>
              <div class="form-group row">
                <label>Sub URL</label>
                <p class="text-muted">Pisahkan Dengan Tanda <b>';'</b></p>
                <textarea id="data_suburl_edit" name="sub_url" class="form-control field" required="required"
                  placeholder="Masukkan Sub URL"></textarea>
              </div>
              <div class="form-group row">
                <label>Parent</label>
                <select name="parent" class="form-control select2" id="data_parent_edit" style="width: 100%;"></select>
              </div>
              <div class="form-group row">
                <label>Sequence</label>
                <input type="number" placeholder="Masukkan Sequence / Urutan Menu" id="data_sequence_edit" name="sequence"
                  class="form-control field" required="required">
              </div>
              <div class="form-group row">
                <label>Icon</label>
                <h4 id="data_icon_view_edit"></h4>
                <input type="text" min="1" placeholder="Masukkan Icon Menu" id="data_icon_edit" name="icon"
                  class="form-control icon" readonly="readonly">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="do_edit()" id="btn_edit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
<div id="modal_delete_partial"></div>
<script src="<?php echo base_url('asset/plugins/jquery/jquery.min.js')?>"></script>
<script>
      var url_select="<?php echo base_url('global_control/select2_global');?>";
  //wajib diisi
  var table="master_jenis_batasan_poin";
  var column="id_batasan_poin";
  $(document).ready(function(){
    refreshCode();
    $('#table_data').DataTable( {
      ajax: {
        url: "<?php echo base_url('master/master_jenis_batasan_poin/view_all/')?>",
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
      //aksi
      {   targets: [5,6,7], 
        width: '7%',
        render: function ( data, type, full, meta ) {
          return '<center>'+data+'</center>';
        }
      },
      ]
    });

    $('#btn_add_collapse').click(function(){
      select_data('data_departement_add',url_select,'master_departement','kode_departement','nama');
    })
  });
  function refreshCode() {
    kode_generator("<?php echo base_url('master/master_jenis_batasan_poin/kode');?>",'data_kode_add');
  }
  function view_modal(id) {
    var data={id_batasan_poin:id};
    var callback=getAjaxData("<?php echo base_url('master/master_jenis_batasan_poin/view_one')?>",data);  
    $('#view').modal('show');
    $('.header_data').html(callback['nama']);
    $('#data_kode_view').html(callback['kode_batasan_poin']);
    $('#data_name_view').html(callback['nama']);
    $('#data_lebih_max_view').html(callback['lebih_max']);
    $('#data_tr_view').html(callback['tr_table']);
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
    select_data('data_departement_edit',url_select,'master_departement','kode_departement','nama');
    var id = $('input[name="data_id_view"]').val();
    var data={id_batasan_poin:id};
    var callback=getAjaxData("<?php echo base_url('master/master_jenis_batasan_poin/view_one')?>",data); 
    $('#view').modal('toggle');
    setTimeout(function () {
     $('#edit').modal('show');
   },600); 
    $('.header_data').html(callback['nama']);
    $('#data_id_edit').val(callback['id']);
    $('#data_kode_edit_old').val(callback['kode_batasan_poin']);
    $('#data_kode_edit').val(callback['kode_batasan_poin']);
    $('#data_name_edit').val(callback['nama']);
    if (callback['lebih_max_val']) {
      $('#data_lebih_max_edit').prop('checked', true);
    }else{
      $('#data_lebih_max_edit').prop('checked', false);
    }
    var i;
    var x = 1;
    for (i = 0; i < '<?=$this->libgeneral->poin_max_range()?>'; i++) {
      $('#data_poin_'+x+'_edit').val(callback['poin_'+x]);
      $('#data_satuan_'+x+'_edit').val(callback['satuan_'+x]);
      x++;
    }
  }
  function delete_modal(id) {
    var data={id_batasan_poin:id};
    var callback=getAjaxData("<?php echo base_url('master/master_jenis_batasan_poin/view_one')?>",data);
    var datax={table:table,column:column,id:id,nama:callback['nama']};
    loadModalAjax("<?php echo base_url('pages/load_modal_delete')?>",'modal_delete_partial',datax,'delete');
  }
  //doing db transaction
  function do_status(id,data) {
    var data_table={status:data};
    var where={id_batasan_poin:id};
    var datax={table:table,where:where,data:data_table};
    submitAjax("<?php echo base_url('global_control/change_status')?>",null,datax,null,null,'status');
    $('#table_data').DataTable().ajax.reload(function (){
      Pace.restart();
    });
  }
  function do_edit(){
    if($("#form_edit")[0].checkValidity()) {
      submitAjax("<?php echo base_url('master/edt_jenis_batasan_poin')?>",'edit','form_edit',null,null);
      $('#table_data').DataTable().ajax.reload(function (){Pace.restart();},false);
    }else{
      notValidParamx();
    } 
  }
  function do_add(){
    if($("#form_add")[0].checkValidity()) {
      submitAjax("<?php echo base_url('master/add_jenis_batasan_poin')?>",null,'form_add',null,null);
      $('#table_data').DataTable().ajax.reload(function (){Pace.restart();},false);
      $('#form_add')[0].reset();
      refreshCode();
    }else{
      notValidParamx();
    } 
  }
</script>

