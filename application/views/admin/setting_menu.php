
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-cogs"></i> SETTING</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><i class="fas fa-cogs"></i> Setting Menu</li>
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
            <h3 class="card-title"><i class="fas fa-database"></i> Setting Data Menu</h3>
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
                      echo '<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#add_ug" id="btn_add_collapse"><i class="fa fa-plus"></i> Tambah User Group</button>';
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
                        <label>Nama Menu</label>
                        <input type="text" placeholder="Masukkan Nama Menu" id="data_name_add" name="nama"
                          class="form-control field input-capital-each" required="required">
                      </div>
                      <div class="form-group">
                        <label>URL</label>
                        <input type="text" placeholder="Masukkan Nama Menu" id="data_url_add" name="url"
                          class="form-control field input-lower" required="required">
                      </div>
                      <div class="form-group">
                        <label>Sub URL</label>
                        <p class="text-muted">Pisahkan Dengan Tanda <b>';'</b></p>
                        <textarea id="data_suburl_add" name="sub_url" class="form-control field" required="required"
                          placeholder="Masukkan Sub URL"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Parent</label>
                        <select name="parent" class="form-control select2" id="data_parent_add"
                          style="width: 100%;"></select>
                      </div>
                      <div class="form-group">
                        <label>Sequence</label>
                        <input type="number" placeholder="Masukkan Sequence / Urutan Menu" id="data_sequence_add"
                          name="sequence" class="form-control field" required="required">
                      </div>
                      <div class="form-group">
                        <label>Icon</label>
                        <input type="text" min="1" placeholder="Masukkan Icon Menu" id="data_sicon_add" name="icon" class="form-control icon input-lower" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <button type="button" onclick="do_add()" class="btn btn-success" id="btn_add"><i class="fa fa-floppy-o"></i> Simpan</button>
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
                  <th>Nama Menu</th>
                  <th>Parent</th>
                  <th>Sequence</th>
                  <th>Url</th>
                  <th>Sub Url</th>
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
  							<label class="col-md-6 control-label">Nama Menu</label>
  							<div class="col-md-6" id="data_name_view"></div>
  						</div>
  						<div class="form-group row">
  							<label class="col-md-6 control-label">Parent</label>
  							<div class="col-md-6" id="data_parent_view"></div>
  						</div>
  						<div class="form-group row">
  							<label class="col-md-6 control-label">Sequence</label>
  							<div class="col-md-6" id="data_sequence_view"></div>
  						</div>
  						<div class="form-group row">
  							<label class="col-md-6 control-label">URL</label>
  							<div class="col-md-6" id="data_url_view"></div>
  						</div>
  						<div class="form-group row">
  							<label class="col-md-6 control-label">Sub URL</label>
  							<div class="col-md-6" id="data_suburl_view"></div>
  						</div>
  						<div class="form-group row">
  							<label class="col-md-6 control-label">Icon</label>
  							<div class="col-md-6" id="data_icon_view"></div>
  						</div>
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
	var table="master_menu";
	var column="id_menu";
	$(document).ready(function(){
		$('.icon').iconpicker();
		$('#btn_add_collapse').click(function () {
			select_data('data_parent_add',url_select,'master_menu','id_menu','nama');
			$('#data_parent_add').val(0).trigger('change');
		});
		$('#table_data').DataTable( {
			ajax: {
				url: "<?php echo base_url('admin/master_menu/view_all/')?>",
				type: 'POST',
				data:{access:"<?php echo base64_encode(serialize($access));?>"}
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
						return data;
					}
				},
				{   targets: 7,
					width: '10%',
					render: function ( data, type, full, meta ) {
						return '<center>'+data+'</center>';
					}
				},
				{   targets: 8, 
					width: '5%',
					render: function ( data, type, full, meta ) {
						return '<center>'+data+'</center>';
					}
				},
			]
		});
	});
	function view_modal(id) {
		var data={id_menu:id};
		var callback=getAjaxData("<?php echo base_url('admin/master_menu/view_one')?>",data);  
		$('#view').modal('show');
		$('.header_data').html(callback['nama']);
		$('#data_name_view').html(callback['nama']);
		$('#data_parent_view').html(callback['parent']);
		$('#data_sequence_view').html(callback['sequence']);
		$('#data_url_view').html(callback['url']);
		$('#data_suburl_view').html(callback['sub_url']);
		$('#data_icon_view').html('<i class="'+callback['icon']+'"></i>');
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
		select_data('data_parent_edit',url_select,'master_menu','id_menu','nama');
		var id = $('input[name="data_id_view"]').val();
		var data={id_menu:id};
		var callback=getAjaxData("<?php echo base_url('admin/master_menu/view_one')?>",data); 
		$('#view').modal('toggle');
		setTimeout(function () {
			$('#edit').modal('show');
		},500);
		$('.header_data').html(callback['nama']);
		$('#data_id_edit').val(callback['id']);
		$('#data_name_edit').val(callback['nama']);
		$('#data_url_edit').val(callback['url']);
		$('#data_suburl_edit').val(callback['sub_url_val']);
		$('#data_parent_edit').val(callback['parent_val']).trigger('change');
		$('#data_parent_old_edit').val(callback['parent_val']);
		$('#data_sequence_edit').val(callback['sequence']);
		$('#data_icon_edit').val(callback['icon']);
		$('#data_icon_view_edit').html('<i class="'+callback['icon']+'"></i>');
	}
	function delete_modal(id) {
		var data={id_menu:id};
		var callback=getAjaxData("<?php echo base_url('admin/master_menu/view_one')?>",data);
		var datax={table:table,column:column,id:id,nama:callback['nama']};
		loadModalAjax("<?php echo base_url('pages/load_modal_delete')?>",'modal_delete_partial',datax,'delete');
	}
	function do_status(id,data) {
		var data_table={status:data};
		var where={id_menu:id};
		var datax={table:table,where:where,data:data_table};
		submitAjax("<?php echo base_url('global_control/change_status')?>",null,datax,null,null,'status');
		$('#table_data').DataTable().ajax.reload(function (){
			// Pace.restart();
		});
	}
	function do_edit(){
		if($("#form_edit")[0].checkValidity()) {
			submitAjax("<?php echo base_url('admin/edt_menu')?>",'edit','form_edit',null,null);
			$('#table_data').DataTable().ajax.reload(function (){
				// Pace.restart();
			});
		}else{
			notValidParamx();
		} 
	}
	function do_add(){
		if($("#form_add")[0].checkValidity()) {
			submitAjax("<?php echo base_url('admin/add_menu')?>",null,'form_add',null,null);
			$('#table_data').DataTable().ajax.reload(function (){
				// Pace.restart();
			});
			$('#form_add')[0].reset();
			select_data('data_parent_add',url_select,'master_menu','id_menu','nama');
			$('#data_parent_add').val(0).trigger('change');
		}else{
			notValidParamx();
		} 
	}
</script>

