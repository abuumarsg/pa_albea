var fail = '<span class="ec ec-construction"></span> ';



function kode_generator(urlx, idf) {
	$.ajax({
		url: urlx,
		type: 'ajax',
		dataType: 'json',
		async: false,
		method: "POST",
		success: function (data) {
			$('#' + idf).val(data);
		}
	})
}

function select_data(id_field, urlx, table, column, name, all_item = 'no', sort, s_val) {
	var datax = {
		table: table,
		column: column,
		name: name,
		sort: sort,
		s_val: s_val,
	};
	getSelect2(urlx, id_field, datax, all_item);
}

function getAjaxData(urlx, where, method = "POST") {
	// Pace.restart();
	var viewx;
	$.ajax({
		url: urlx,
		method: method,
		data: where,
		async: false,
		dataType: 'json',
		success: function (data) {
			viewx = data;
			// console.clear();
		},
		error: function (data) {
			$("body").overhang({
				type: "error",
				message: fail + 'Invalid Parameter',
				html: true
			});
			show_modal_error(data.responseText);
		}
	});
	return viewx;
}
function getAjaxData2(urlx,where,param=null) {
	Pace.restart();
	var viewx;
	$.ajax({
		url : urlx,
		method : "POST",
		data : where,
		async : false,
		dataType : 'json',
		success: function (data){
			if (param !== null) {
				$("body").overhang({
					type: "success",
					message: data.msg,
					html: true
				});
			}else if(param == 'nonotif'){
				viewx = false;
			}else{
				viewx = data;
			}
		},
		error:function(data){
			$("body").overhang({
				type: "error",
				message: fail + 'Invalid Parameter',
				html: true
			});
		}
	});
	return viewx;
}
function submitAjaxCall(urlx, formx, usage=null){
	if (usage == 'status') {
		var data = formx;
	} else {
		var data = $('#' + formx).serialize();
	}
	var viewx;
	$.ajax({
		url: urlx,
		method: "POST",
		data: data,
		async: false,
		dataType: 'json',
		success: function (data) {
			viewx = data;
		},
		error: function (data) {
			show_modal_error(data.responseText);
		}
	});
	return viewx;
}

			// viewx = data;


function submitAjax(urlx, modalx, formx, url_kode, idf_kode, usage,notif) {
	// Pace.restart();
	if (usage == 'status' || usage == 'change_skin') {
		var data = formx;
	} else {
		var data = $('#' + formx).serialize();
	}
	$.ajax({
		url: urlx,
		method: "POST",
		data: data,
		// async: false,
		dataType: 'json',
		success: function (data) {
			if (usage == 'auth') {
				if (data.status_data == 'wrong') {
					// $('#forget_pass').html('<a href="auth/lupa">Lupa Password?</a>');
					$('.login-box').notify(data.msg, {position: "top center", className: "error"});
					// get_captcha();
				}
				if (data.status_data == false) {
					$('.login-box').notify(data.msg, {position: "top center", className: "error"});
				}
			} else {
				if (data.status_data == true) {
					if (usage == 'auth') {
						$('.login-box').notify(data.msg, {position: "top center", className: "success"});
					}else{
						$.notify(data.msg, {position: "top center", className: "success"});
						if (modalx !== null) {
							$('#' + modalx).modal('toggle');
						}
					}
				} else if (data.status_data == 'warning') {
					$("body").overhang({
						type: "warn",
						message: data.msg,
						html: true
					});
				} else if (data.status_data == 'no_msg') {
					return false;
				} else {
					if (data.msg != null) {
						$("body").overhang({
							type: "error",
							message: data.msg,
							html: true
						});
					} else {
						if (data.msg == null) {
							if(notif == 'no'){
								return false;
							}else{
								$("body").overhang({
									type: "success",
									message: 'OK! Berhasil',
									html: true
								});
							}
						}else{
							$("body").overhang({
								type: "error",
								message: fail + 'Invalid Parameter',
								html: true
							});
						}
					}
				}
			}
			if (data.linkx != null) {
				setTimeout(function () {
					window.location.href = data.linkx;	
				}, 1000);
			}
			// console.clear();
		},
		error: function(data, status, error) {
			$.notify("Transaksi Anda Gagal "+data.msg, {position: "top center", className: "error"});
			show_modal_error(data.responseText);
		}
	});
}



function loadModalAjax(urlx, modalx, datax, usage) {
	// Pace.restart();
	$.ajax({
		url: urlx,
		method: "POST",
		data: datax,
		async: false,
		dataType: 'json',
		success: function (data) {
			if (usage == 'delete') {
				$('#' + modalx).html(data.modal);
				$('#delete').modal('show');
				$('#data_name_delete').html(datax['nama']);
				$('#data_column_delete').val(datax['column']);
				$('#data_id_delete').val(datax['id']);
				$('#data_table_delete').val(datax['table']);
				$('#data_table_drop').val(datax['nama_tabel']);
				$('#data_link_table').val(datax['del_link_tb']);
				$('#data_link_col').val(datax['del_link_col']);
				$('#data_link_data_col').val(datax['del_link_data_col']);
				$('#data_form_table_u').val(datax['table_view']);
				$('#data_file').val(datax['file']);
			} else {
				$.notify(data.msg, {position: "top center", className: "error"});
			}
			// console.clear();
		},
		error: function (data) {
			$.notify(data.msg, {position: "top center", className: "error"});
		}
	});
}


function getAjaxCount(urlx, datax, sendx) {
	// not with php
	var nomor = datax;
	var total = parseInt(0);
	for (i = 0; i < nomor.length; i++) {
		if (nomor[i] == '') {
			total += parseInt(0);
		} else {
			total += parseInt(nomor[i]);
		}
	}
	$('#' + sendx).val(total);
	// end
}

function getSelect2(urlx, formx, datax, all_item) {
	$.ajax({
		method: "POST",
		url: urlx,
		data: datax,
		async: false,
		dataType: 'json',
		success: function (data) {
			var html = '<option value="">Pilih Data</option>';
			if (all_item == 'yes') {
				html += '<option value="semua_data">Pilih Semua</option>';
			}
			$.each(data, function (key, value) {
				html += '<option value="' + key + '">' + value + '</option>';
			});
			$('#' + formx).html(html);
		},
		error: function (data) {
			$("body").overhang({
				type: "error",
				message: fail + 'Invalid Parameter',
				html: true
			});
		}
	});
}

function realtimeAjax(urlx, id = "show_notif") {
	Pace.ignore(function () {
		setInterval(function () {
			$.ajax({
				type: 'POST',
				url: urlx,
				async: false,
				dataType: 'json',
				success: function (data) {
					$('#' + id).html(data);
				}

			});
		}, 5000);
	});
}


function realtimeAjax2(urlx, id = "button_import_log") {
	Pace.ignore(function () {
		setInterval(function () {
			$.ajax({
				type: 'POST',
				url: urlx,
				async: false,
				dataType: 'json',
				success: function (data) {
					if (data == 1) {
						$('#' + id).hide();
					} else {
						$('#' + id).show();
					}				
				}
			});
		}, 5000);
	});
}



function submitAjaxFile(urlx, datax, modalx, progx, btnx, tabelx = 'table_data') {
	$.ajax({
		url: urlx,
		type: "post",
		data: datax,
		processData: false,
		contentType: false,
		cache: false,
		async: false,
		dataType: 'json',
		success: function (data) {
			$(progx).hide();
			$(btnx).removeAttr('disabled');

			if (data.status_data == true) {
				$("body").overhang({
					type: "success",
					message: data.msg,
					html: true
				});
			} else if (data.status_data == 'warning') {
				$("body").overhang({
					type: "warn",
					message: data.msg,
					html: true
				});
			} else {
				if (data.msg != null) {
					$("body").overhang({
						type: "error",
						message: data.msg,
						html: true
					});
				} else {
					$("body").overhang({
						type: "error",
						message: fail + 'Invalid Parameter',
						html: true
					});
				}
			}
			setTimeout(function () {
				$(modalx).modal('toggle');
			}, 1000);
			$('#' + tabelx).DataTable().ajax.reload(function () {
				Pace.restart();
			});
		},
		error: function (data) {
			$("body").overhang({
				type: "error",
				message: fail + 'Invalid Parameter',
				html: true
			});
		}
	});
}
function show_modal_error(msg) {
	$('#modal_error .modal-body').html(msg);
	$('#modal_error').modal('show');
}

function load_event() {
	var callback = getAjaxData("https://api.huclesoftware.com/event/?access_key=24033b35663336326365343237633533", null, "GET");
	if (callback) {
		if (typeof callback['data'][0] !== 'undefined') {
			$('#show_event').html('<div class="row"><div class="col-md-12">' + callback['data'][0].body + '</div></div>');
		}
	}
}
// $('.select2').select2({
// 	placeholder: 'Pilih Data',
// 	allowClear: true,
// });