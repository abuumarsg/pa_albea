
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-cogs"></i> SETTING</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><i class="fas fa-cogs"></i> Setting Admin</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-database"></i> Setting Data Admin</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
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
              <div class="col-md-6">
                <div class="pull-left">
                  <button class="btn btn-success btn-flat" type="button" data-toggle="collapse" data-target="#add_acc"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="pull-right" style="font-size: 8pt; text-align: right;">
                  <i class="fa fa-toggle-on stat scc"></i> Aktif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                  <i class="fa fa-toggle-off stat err"></i> Tidak Aktif
                </div>
              </div>
            </div>
            <div class="collapse" id="add_acc">
              <form id="form_add">
                <br>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Kode</label>
                      <input type="text" placeholder="Masukkan Kode" name="kode" id="kode_komponen" class="form-control" readonly="readonly">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <label>Nama Komponen</label>
                      <input type="text" placeholder="Masukkan Nama Komponen" name="nama" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Sifat</label>
                      <select class="form-control select2" name="sifat" id="jenis_komponen_add" style="width: 100%;"></select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Select</label><br>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="data">
                          <label class="form-check-label">Data</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" value="variable">
                          <label class="form-check-label">Variable</label>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" id="div_first_variable">
                      <label>First Variable</label>
                      <input type="text" placeholder="First Variable" name="variable_first" class="form-control" id="variable">
                      <select class="form-control select2" name="data_first" style="width: 100%;display:none;" id="data_first"></select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Operation</label>
                      <select class="form-control select2" name="operation" id="operation_add" style="width: 100%;"></select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Select</label><br>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio2" value="data">
                          <label class="form-check-label">Data</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio2" value="variable">
                          <label class="form-check-label">Variable</label>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" id="div_second_variable">
                      <label>Second Variable</label>
                      <input type="text" placeholder="Second Variable" name="variable_second" class="form-control" id="variable">
                      <select class="form-control select2" name="data_second" style="width: 100%;display:none;" id="data_second"></select>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group pull-right">
                      <button type="button" onclick="do_add()" id="btn_add" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                    </div>
                  </div>
                </div>
                <hr>
              </form>
            </div>
            <table id="table_data" class="table table-bordered table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>User Group</th>
                  <th>Last Login</th>
                  <th>Level Admin</th>
                  <th>Tanggal</th>
                  <th>Status Admin</th>
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
<div id="modal_view" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Detail Data <b class="text-muted header_data"></b></h2>
        <input type="hidden" name="data_id_view">
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Kode Master Izin/Cuti</label>
              <div class="col-md-6" id="data_id_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Nama Master Izin/Cuti</label>
              <div class="col-md-6" id="data_kode_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Maksimal Izin/Cuti</label>
              <div class="col-md-6" id="data_nama_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Potong Upah</label>
              <div class="col-md-6" id="data_sifat_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Pengurang Penilaian</label>
              <div class="col-md-6" id="data_nama1_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Potongan</label>
              <div class="col-md-6" id="data_nama2_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Penggajian (satuan)</label>
              <div class="col-md-6" id="data_operation_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Jenis(Izin/Cuti)</label>
              <div class="col-md-6" id="data_status_view"></div>
            </div>
            <div class="form-group col-md-12" id="view_potong_cuti" style="display:none;">
              <label class="col-md-6 control-label">Potong Cuti</label>
              <div class="col-md-6" id="data_create_date_view"></div>
            </div>
            <div class="form-group col-md-12">
                <label class="col-md-6 control-label">Besar Potongan Gaji (%)</label>
                <div class="col-md-6" id="data_update_date_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Dokumen</label>
              <div class="col-md-6" id="data_create_by_view"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Status</label>
              <div class="col-md-6" id="data_update_by_view">
              
              </div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Dibuat Tanggal</label>
              <div class="col-md-6" id="data_create_date_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Diupdate Tanggal</label>
              <div class="col-md-6" id="data_update_date_view"></div>
            </div>
            <div class="form-group col-md-12">
              <label class="col-md-6 control-label">Dibuat Oleh</label>
              <div class="col-md-6" id="data_create_by_view">
              </div>
            </div>
            <div class="form-group col-md-12">
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
<script src="<?php echo base_url('asset/plugins/jquery/jquery.min.js')?>"></script>
<script>
    $(document).ready(function(){
      // form_key("form_reset","btn_rst");
      // $('#add_button').click(function () {
      //   getSelect2("<?php echo base_url('employee/mutasi_jabatan/employee')?>",'data_karyawan_add');
      //   select_data('data_usergroup_add',url_select,'master_user_group','id_group','nama');
      // });
      $('#table_data').DataTable( {
        ajax: {
          url: "<?php echo base_url('admin/list_admin/view_all/')?>",
          type: 'POST',
          data:{access:"<?php echo $this->codegenerator->encryptChar($access);?>"}
        },
        scrollX: true,
        columnDefs: [
        {   targets: 0, 
          width: '3%',
          render: function ( data, type, full, meta ) {
            return '<center>'+(meta.row+1)+'.</center>';
          }
        },
        {   targets: 1,
          width: '15%',
          render: function ( data, type, full, meta ) {
            return full[9]+' '+data;
          }
        },
        //aksi
        {   targets: 8, 
          width: '8%',
          render: function ( data, type, full, meta ) {
            return '<center>'+data+'</center>';
          }
        },
        ]
      });
    });
  // $(document).ready(function(){
  //   refreshCode();
  //   $('#table_data').DataTable( {
  //     ajax: {
  //       url: "<?php echo base_url('cpayroll/master_komponen/view_all/')?>",
  //       type: 'POST',
  //       async: true,
  //       data:{access:''}
  //     },
  //     scrollX: true,
  //     // paging: true,
  //     // lengthChange: false,
  //     // searching: true,
  //     // ordering: true,
  //     // // info: true,
  //     // autoWidth: true,
  //     // responsive: true,
  //     // buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
  //     columnDefs: [
  //       {   targets: 0, 
  //         width: '5%',
  //         render: function ( data, type, full, meta ) {
  //           return '<center>'+(meta.row+1)+'.</center>';
  //         }
  //       },
  //       {   targets: 1,
  //         width: '15%',
  //         render: function ( data, type, full, meta ) {
  //           return data;
  //         }
  //       },
  //       {   targets: 2,
  //         width: '15%',
  //         render: function ( data, type, full, meta ) {
  //           return data;
  //         }
  //       },
  //       //aksi
  //       {   targets: 10, 
  //         width: '5%',
  //         render: function ( data, type, full, meta ) {
  //           return '<center>'+data+'</center>';
  //         }
  //       },
  //     ]
  //   });
  //   $("input[name='radio1']").change(function(){
  //       var radio1 = $("input[name='radio1']:checked").val();
  //       if(radio1 == 'data'){
	// 		    $('#div_first_variable #variable').hide();
	// 		    $('#div_first_variable #data_first').show();
  //       }else{
	// 		    $('#div_first_variable #variable').show();
	// 		    $('#div_first_variable #data_first').hide();
  //       }
  //   });
  //   $("input[name='radio2']").change(function(){
  //       var radio2 = $("input[name='radio2']:checked").val();
  //       if(radio2 == 'data'){
	// 		    $('#div_second_variable #variable').hide();
	// 		    $('#div_second_variable #data_second').show();
  //       }else{
	// 		    $('#div_second_variable #variable').show();
	// 		    $('#div_second_variable #data_second').hide();
  //       }
  //   });
  // });
  // function refreshCode() {
  //   kode_generator("<?php echo base_url('cpayroll/master_komponen/kode');?>",'kode_komponen');
  //   getSelect2("<?php echo base_url('cpayroll/master_komponen/OperationAritmatic')?>",'operation_add');
  //   getSelect2("<?php echo base_url('cpayroll/master_komponen/getJenisKomponenList')?>",'jenis_komponen_add');
  //   getSelect2("<?php echo base_url('cpayroll/master_komponen/dataVariable')?>",'data_first, #data_second');
  // }
  // function do_add(){
  //   if($("#form_add")[0].checkValidity()) {
  //     submitAjax("<?php echo base_url('cpayroll/add_master_komponen')?>",null,'form_add');
  //     $('#table_data').DataTable().ajax.reload(function(){
  //       Pace.restart();
  //     });
  //     $('#form_add')[0].reset();
  //       refreshCode();
  //   }else{
  //     notValidParamx();
  //   } 
  // }
  // function view_modal(id)
  // {
  //   var data={id:id};
  //   var callback = getAjaxData("<?php echo base_url('cpayroll/master_komponen/view_one')?>",data); 
  //   $('#modal_view').modal('show');
  //   $('#data_id_view').html(callback['id']);
  //   $('#data_kode_view').html(callback['kode']);
  //   $('#data_nama_view').html(callback['nama']);
  //   $('#data_sifat_view').html(callback['sifat']);
  //   $('#data_nama1_view').html(callback['nama1']);
  //   $('#data_nama2_view').html(callback['nama2']);
  //   $('#data_operation_view').html(callback['operation']);
  //   $('#data_status_view').html(callback['status']);
  //   $('#data_create_date_view').html(callback['create_date']);
  //   $('#data_update_date_view').html(callback['update_date']);
  //   $('#data_create_by_view').html(callback['create_by']);
  //   $('#data_update_by_view').html(callback['update_by']);
  // }
</script>

