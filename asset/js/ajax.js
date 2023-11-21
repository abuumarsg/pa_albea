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
				$.notify(data.msg, {position: "top center", className: "error"});
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
				$.notify(data.msg, {position: "top center", className: "error"});
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
			$.notify(data.msg, {position: "top center", className: "error"});
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
					$.notify(data.msg, {position: "top center", className: "error"});
				} else {					
					$.notify(data.msg, {position: "top center", className: "error"});
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
			$.notify(data.msg, {position: "top center", className: "error"});
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
$(document).ready(function () {
	$('input[name=password],input[name=old_pass],input[name=password1],input[name=password2],input[name=old_password],input[name=u_password],input[name=new_password]').focus(function () {
		var name = $(this).attr("name");
		$('.see_password_' + name).remove();
		var input = $('input[name=' + name + ']');
		$('input[name=' + name + ']').after('<span class="see_password_' + name + ' form-control-feedback" style="pointer-events: initial"><i class="fa fa-eye text-muted"></i></span>');
		if (input.attr("type") === "password") {
			$('.see_password_' + name).html('<i class="fa fa-eye text-muted"></i>');
		} else {
			$('.see_password_' + name).html('<i class="fa fa-eye-slash text-muted"></i>');
		}
		$('.see_password_' + name).click(function () {
			$('.see_password_' + name).html('');
			var input = $('input[name=' + name + ']');
			if (input.attr("type") === "password") {
				$('.see_password_' + name).html('<i class="fa fa-eye-slash text-muted"></i>');
				input.attr("type", "text");
			} else {
				$('.see_password_' + name).html('<i class="fa fa-eye text-muted"></i>');
				input.attr("type", "password");
			}
		})
	});
	// $('form').validator({
		// $('.message').css('color','red');
		// $('.bmessage').css('border-color','#DD4B39');
		// feedback: {
		// 	success: "fas fa-check",
		// 	error: "fas fa-times"
		// }
		// feedback: {
		// 	success: $('form input[type="text"],form input[type="number"]').html('<i class="fas fa-check"></i>').css('border-color','#DD4B39'),
		// 	error: $('form input[type="text"],form input[type="number"]').html('<i class="fas fa-times text-muted"></i>').css('border-color','#212529'),
		// }
	// })
	$('form input[type="text"],form input[type="number"]').after('<span class="form-control-feedback" aria-hidden="true" style="padding-top: 10px;"></span><div class="help-block with-errors" style="font-size: 9pt;"></div>');
	$('form textarea').after('<span class="form-control-feedback" aria-hidden="true" style="padding-top: 30px;"></span><div class="help-block with-errors" style="font-size: 9pt;"></div>');
	var titleClass = $('form .form-group').attr('class');
	$('form .form-group').attr('class', titleClass + ' has-feedback');
	$('.modal,#modal_delete_partial').on('show.bs.modal', function (e) {
		$('.modal .modal-dialog').removeClass('bounceOutUp  animated');
		$('.modal .modal-dialog').addClass('bounceInDown  animated');
	})
	$('.modal,#modal_delete_partial').on('hide.bs.modal', function (e) {
		$('.modal .modal-dialog').removeClass('bounceInDown  animated');
		$('.modal .modal-dialog').addClass('bounceOutUp  animated');
	})
})

function date_time(id) {
	date = new Date;
	year = date.getFullYear();
	month = date.getMonth();
	months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	//months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
	d = date.getDate();
	day = date.getDay();
	days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu');
	//days = new Array('Minggu', 'Sen', 'Sel', 'Rabu', 'Kam', "Jum", 'Sab');
	h = date.getHours();
	if (h < 10) {
		h = "0" + h;
	}
	m = date.getMinutes();
	if (m < 10) {
		m = "0" + m;
	}
	s = date.getSeconds();
	if (s < 10) {
		s = "0" + s;
	}
	result = '' + days[day] + ', ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + m + ':' + s;
	$('#' + id).html(result);
	setTimeout('date_time("' + id + '");', '1000');
	return true;
}

function capitalize_Words(str) {
	return str.replace(/\w\S*/g, function (txt) {
		return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
	});
}

function all_property() {
	$('[data-toggle="popover"]').popover();
	$('.sidebar-menu').tree();
	$('input[type=text]').keyup(function () {
		$(this).val($(this).val().toUpperCase());
	});
}

function addValueEditor(idx, val) {
	$('#' + idx).data("wysihtml5").editor.setValue(val);
}

function updateScrollPos(e) {
	$('.TouchScroller').css('cursor', 'col-resize');
	$('.TouchScroller').scrollLeft($('.TouchScroller').scrollLeft() + (clickX - e.pageX));
}

function form_property() {

	$(".input-number").keypress(function (data) {
		if (data.which > 47 && data.which < 58 || data.which == 44) {} else {
			return false;
		}
	});
	$(".input-number").focus(function (data) {
		if (this.value == 0) {
			this.value = '';
		}
	});
	$(".input-number").focusout(function (data) {
		if (this.value == '') {
			this.value = 0;
		}
	});
	$('.TouchScroller').mousedown(function (e) {
		clicked = true;
		clickX = e.pageX;
	})
	$('.TouchScroller').mouseup(function () {
		clicked = false;
		$('.TouchScroller').css('cursor', 'auto');
	})
	$('.TouchScroller').mousemove(function (e) {
		if (clicked) {
			updateScrollPos(e);
		}
	})
	$('.input-money').keyup(function () {
		this.value = formatRupiah(this.value, 'Rp. ');
	});
	$(".input-money").focus(function (data) {
		if (this.value == 'Rp. 0') {
			this.value = '';
		}
	});
	$(".input-money").focusout(function (data) {
		if (this.value == '') {
			this.value = 'Rp. 0';
		} else if (this.value == '0') {
			this.value = 'Rp. 0';
		}
	});
	$('input[type=checkbox],input[type=radio]').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%'
	});
	$('input[type=radio]').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%'
	});
	$('.icheck-class').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%'
	});

	$('.input-lower').keyup(function () {
		this.value = this.value.toLowerCase();
	});
	$('.input-capital-each').keyup(function () {
		var str = this.value;
		this.value = str.replace(/\w\S*/g, function (txt) {
			return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
		});
	});
	if ($.isFunction($.fn.colorpicker, $.fn.select2, $.fn.timepicker, $.fn.daterangepicker, $.fn.datepicker, $.fn.wysihtml5)) {
		$('.color-picker').colorpicker().attr('readonly', 'readonly');
		$('.select2').select2({
			placeholder: 'Pilih Data',
			allowClear: true,
			// sorter: function (data) {
			// 	return data.sort(function (a, b) {
			// 		if (a.text > b.text) {
			// 			return 1;
			// 		}
			// 		if (a.text < b.text) {
			// 			return -1;
			// 		}
			// 		return 0;
			// 	});
			// }
		});
		$('.select2-notclear').select2({
			placeholder: 'Pilih Data',
			sorter: function (data) {
				return data.sort(function (a, b) {
					if (a.text > b.text) {
						return 1;
					}
					if (a.text < b.text) {
						return -1;
					}
					return 0;
				});
			}
		});
		if ($("select[multiple]").length) {
			$('select[multiple].select2').select2({
				placeholder: {
					id: "0",
					text: 'Pilih Data'
				},
				allowClear: true,
				// sorter: function (data) {
				// 	return data.sort(function (a, b) {
				// 		if (a.text > b.text) {
				// 			return 1;
				// 		}
				// 		if (a.text < b.text) {
				// 			return -1;
				// 		}
				// 		return 0;
				// 	});
				// }
			});
			if ($('select[multiple]').hasClass('select2')) {
				if (typeof $('select[multiple].select2 option')[0] !== 'undefined') {
					$('select[multiple].select2 option')[0].remove();
				}
			}
			$('select[multiple].select2-notclear').select2({
				placeholder: {
					id: "0",
					text: 'Pilih Data'
				},
				sorter: function (data) {
					return data.sort(function (a, b) {
						if (a.text > b.text) {
							return 1;
						}
						if (a.text < b.text) {
							return -1;
						}
						return 0;
					});
				}
			});
			if ($('select[multiple]').hasClass('select2-notclear')) {
				if (typeof $('select[multiple].select2-notclear option')[0] !== 'undefined') {
					$('select[multiple].select2-notclear option')[0].remove();
				}
			}
		}
		form_key("form_add", "btn_add");
		form_key("form_edit", "btn_edit");
		//date & time
		$('.time-picker').timepicker({
			showInputs: true,
			showMeridian: false,
			showSeconds: false,
			minuteStep: 1,
		}).css('cursor', 'pointer');
		$('.date-picker').datepicker({
			format: "dd/mm/yyyy",
			language: 'id',
			todayHighlight: true,
			autoclose: true,
		}).on('hide', function (event) {
			event.preventDefault();
			event.stopPropagation();
		}).attr('readonly', 'readonly').css('cursor', 'pointer');
		$('.date-picker-presensi').datepicker({
			format: "dd/mm/yyyy",
			language: 'id',
			todayHighlight: true,
			autoclose: true,
			endDate: '+0d',
		}).on('hide', function (event) {
			event.preventDefault();
			event.stopPropagation();
		}).attr('readonly', 'readonly').css('cursor', 'pointer');
		$('.datetimepicker').datetimepicker({
			format: 'dd/mm/yyyy hh:ii',
			startDate: '01/01/2021 00:00',
			language: 'id',
			showInputs: true,
			todayHighlight: true,
			autoclose: true,
			minuteStep: 30,
		}).on('hide', function (event) {
			event.preventDefault();
			event.stopPropagation();
		}).css('cursor', 'pointer');
		$(".date-range").daterangepicker({
			"timePicker": true,
			"timePicker24Hour": true,
			"autoApply": true,
			"locale": {
				"format": "DD/MM/YYYY HH:mm:ss",
				"separator": " - ",
				"applyLabel": "Terapkan",
				"cancelLabel": "Kembali",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "Custom",
				"weekLabel": "W",
				"daysOfWeek": [
					"Min",
					"Sen",
					"Sel",
					"Rab",
					"Kam",
					"Jum",
					"Sab"
				],
				"monthNames": [
					"Januari",
					"Februari",
					"Maret",
					"April",
					"Mei",
					"Juni",
					"Juli",
					"Augustus",
					"September",
					"Oktober",
					"November",
					"Desember"
				],
				"firstDay": 1
			},
			"alwaysShowCalendars": true,
			"startDate": $(this).data("start"),
			"endDate": $(this).data("end"),
			"cancelClass": "btn-danger"
		}).attr('readonly', 'readonly').css('cursor', 'pointer');

		$(".date-range-30").daterangepicker({
			"timePicker": true,
			"timePicker24Hour": true,
			"autoApply": true,
			"timePickerIncrement" : 30,
			"locale": {
				"format": "DD/MM/YYYY HH:mm:ss",
				"separator": " - ",
				"applyLabel": "Terapkan",
				"cancelLabel": "Kembali",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "Custom",
				"weekLabel": "W",
				"daysOfWeek": [
					"Min",
					"Sen",
					"Sel",
					"Rab",
					"Kam",
					"Jum",
					"Sab"
				],
				"monthNames": [
					"Januari",
					"Februari",
					"Maret",
					"April",
					"Mei",
					"Juni",
					"Juli",
					"Augustus",
					"September",
					"Oktober",
					"November",
					"Desember"
				],
				"firstDay": 1
			},
			"alwaysShowCalendars": true,
			"startDate": $(this).data("start"),
			"endDate": $(this).data("end"),
			"cancelClass": "btn-danger"
		}).attr('readonly', 'readonly').css('cursor', 'pointer');
		$(".date-range-noreadonly").daterangepicker({
			"timePicker": true,
			"timePicker24Hour": true,
			"autoApply": true,
			"locale": {
				"format": "DD/MM/YYYY HH:mm:ss",
				"separator": " - ",
				"applyLabel": "Terapkan",
				"cancelLabel": "Kembali",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "Custom",
				"weekLabel": "W",
				"daysOfWeek": [
					"Min",
					"Sen",
					"Sel",
					"Rab",
					"Kam",
					"Jum",
					"Sab"
				],
				"monthNames": [
					"Januari",
					"Februari",
					"Maret",
					"April",
					"Mei",
					"Juni",
					"Juli",
					"Augustus",
					"September",
					"Oktober",
					"November",
					"Desember"
				],
				"firstDay": 1
			},
			"alwaysShowCalendars": true,
			"startDate": $(this).data("start"),
			"endDate": $(this).data("end"),
			"cancelClass": "btn-danger",
			"parentEl": "#BootstrapModalId .modal-body"
		}).css('cursor', 'pointer');
		$(".date-range-notime").daterangepicker({
			"timePicker": false,
			"timePicker24Hour": false,
			"autoApply": true,
			"locale": {
				"format": "DD/MM/YYYY",
				"separator": " - ",
				"applyLabel": "Terapkan",
				"cancelLabel": "Kembali",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "Custom",
				"weekLabel": "W",
				"daysOfWeek": [
					"Min",
					"Sen",
					"Sel",
					"Rab",
					"Kam",
					"Jum",
					"Sab"
				],
				"monthNames": [
					"Januari",
					"Februari",
					"Maret",
					"April",
					"Mei",
					"Juni",
					"Juli",
					"Augustus",
					"September",
					"Oktober",
					"November",
					"Desember"
				],
				"firstDay": 1
			},
			"alwaysShowCalendars": true,
			"startDate": $(this).data("start"),
			"endDate": $(this).data("end"),
			"cancelClass": "btn-danger"
		}).attr('readonly', 'readonly').css('cursor', 'pointer');
		$(".dateRangeNoSecond").daterangepicker({
			"timePicker": true,
			"timePicker24Hour": true,
			"autoApply": true,
			"locale": {
				"format": "DD/MM/YYYY HH:mm",
				"separator": " - ",
				"applyLabel": "Terapkan",
				"cancelLabel": "Kembali",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "Custom",
				"weekLabel": "W",
				"daysOfWeek": [
					"Min",
					"Sen",
					"Sel",
					"Rab",
					"Kam",
					"Jum",
					"Sab"
				],
				"monthNames": [
					"Januari",
					"Februari",
					"Maret",
					"April",
					"Mei",
					"Juni",
					"Juli",
					"Augustus",
					"September",
					"Oktober",
					"November",
					"Desember"
				],
				"firstDay": 1
			},
			"alwaysShowCalendars": true,
			"startDate": $(this).data("start"),
			"endDate": $(this).data("end"),
			"cancelClass": "btn-danger"
		}).attr('readonly', 'readonly').css('cursor', 'pointer');
		$('.from').datepicker({
			format: "yyyy",
			autoclose: true,
			minViewMode: "years"
		}).on('changeDate', function (selected) {
			startDate = $(".from").val();
			$('#to').datepicker('setStartDate', startDate);
		});;
		$('.to').datepicker({
			format: "yyyy",
			autoclose: true,
			minViewMode: "years"
		});
		$('.tahun').datepicker({
			format: "yyyy",
			autoclose: true,
			minViewMode: "years",
			clearBtn: true,
		}).attr('readonly', 'readonly').css('cursor', 'pointer');
		//notif
		toastr.options = {
			"closeButton": false,
			"debug": false,
			"newestOnTop": false,
			"progressBar": true,
			"positionClass": "toast-top-center",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		$('.textarea').wysihtml5();
	}
}

function checkPassword() {
	var password = $('#password');
	var u_password = $('#ulangi_password');
	var err = {
		'border-color': 'red'
	};
	var scc = {
		'border-color': 'green'
	};
	if (password.val().length < 6 || u_password.val().length < 6) {
		$('.error_message').html('<i class="fa fa-times"></i> Password Harus Lebih Dari atau Sama Dengan 6 Karakter').css('color', 'red');
		$('#btn_save').attr('disabled', 'disabled');
		password.css(err);
		u_password.css(err);
	} else {
		if (password.val() == '' || u_password.val() == '') {
			$('#btn_save').attr('disabled', 'disabled');
			password.css();
			u_password.css();
		} else if (password.val() != u_password.val()) {
			$('.error_message').html('<i class="fa fa-times"></i> Password Tidak Sama').css('color', 'red');
			$('#btn_save').attr('disabled', 'disabled');
			password.css(err);
			u_password.css(err);
		} else {
			$('.error_message').html('');
			$('#btn_save').removeAttr('disabled', 'disabled');
			password.css(scc);
			u_password.css(scc);
		}
	}
}
var timer = 0;

function set_interval() {
	timer = setInterval("auto_logout()", 9000000000);
}

function reset_interval() {
	if (timer != 0) {
		clearInterval(timer);
		timer = 0;
		timer = setInterval("auto_logout()", 9000000000);
	}
}

function notValidParamx() {
	$.notify('Harap Cek Data Kembali!', {position: "top center", className: "error"});
}

// new custom //
function form_key(formx, btn) {
	$('#' + formx + ' input').keydown(function (e) {
		if (e.keyCode == 13 || e.which == 13) {
			$('#' + btn).click();
		}
	});
}

function reload_table(id) {
	$('#' + id).DataTable().ajax.reload(function () {
		Pace.restart();
	});
}

function pathFile(idf, idt, fext, btnx) {
	var valfile = $(idf).val();
	$(idt).val(valfile);
	var fileExtension = fext;
	if ($.inArray($(idf).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
		$(idf).val('');
		$(idt).val('');
		$("body").overhang({
			type: "error",
			message: fail + 'File Harus Bertipe : ' + fileExtension.join(", "),
			html: true
		});
		$(btnx).attr('disabled', 'disabled');
	} else {
		$(btnx).removeAttr('disabled');
	}
}

var skin = [
	'skin-blue',
	'dark-mode',
]

function storeToMemory(name, val) {
	if (typeof (Storage) !== 'undefined') {
		localStorage.setItem(name, val)
	} else {
		window.alert('Gunakan Browser terbaru untuk menampilkan tema template!')
	}
}

function changeTheme(urlx, idx, skinx) {
	var cls = $('#skinX').data('skin');
	if (cls == null) {
		cls = 'skin-blue';
	}

	$.each(skin, function (i) {
		$('body').removeClass(skin[i])
	})
	if (cls == 'skin-blue') {
		$('#skinX').data('skin', 'dark-mode');
		$('#skinX').html('<i class="fas fa-moon"></i> Dark Mode');
	} else {
		$('#skinX').data('skin', 'skin-blue');
		$('#skinX').html('<i class="fas fa-sun"></i> Normal Mode');
	}
	var datax = {
		id: idx,
		skin: skinx
	};
	$('body').addClass(cls);
	storeToMemory('skin', cls);
	submitAjax(urlx, null, datax, null, null, "change_skin");
}

function tandaPemisahTitik(b){
    var _minus = false;
    if (b<0) _minus = true;
    b = b.toString();
    b=b.replace(".","");
   
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--){
         j = j + 1;
         if (((j % 3) == 1) && (j != 1)){
           c = b.substr(i-1,1) + "." + c;
         } else {
           c = b.substr(i-1,1) + c;
         }
    }
    if (_minus) c = "-" + c ;
    return c;
}
function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]+/g, '').toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	// rupiah = split[1] != undefined ? rupiah : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function select_all_cus(parent, child, btn) {
	var triggeredByChild = false;
	if (!$(parent).is(':checked')) {
		$(child).iCheck('check');
		triggeredByChild = false;
		$('#' + btn).removeAttr('disabled');
	} else {
		if (!triggeredByChild) {
			$(child).iCheck('uncheck');
			$('#' + btn).attr('disabled', 'disabled');
		}
		triggeredByChild = false;
	}

}

function select_parent(parent, child) {
	$(child).change(function () {
		var ischecked = $(this).is(':checked');
		if (!ischecked)
			triggeredByChild = true;
		$(parent).iCheck('uncheck');

	});
	$(child).change(function () {
		var ischecked = $(this).is(':checked');
		if (ischecked)
			if ($(child).filter(':checked').length == $(child).length) {
				$(parent).iCheck('check');

			}
	});
}

function sumBobot(name, btn_id, field_id, msg_id) {
	var getBobot = $('input[name="' + name + '"]').map(function () {
		return this.value;
	}).get();
	btn_id = $('#' + btn_id);
	field_id = $('#' + field_id);
	msg_id = $('#' + msg_id);
	var nomor = getBobot;
	var total = parseFloat(0);
	for (i = 0; i < nomor.length; i++) {
		if (nomor[i] == '') {
			total += parseFloat(0);
		} else {
			total += parseFloat(nomor[i]);
		}
	}
	if (total > 100 || total < 100) {
		btn_id.attr('disabled', 'disabled');
		field_id.css('border-color', 'red');
		msg_id.html('<i class="fa fa-times"></i> Jumlah Bobot Harus 100%').css('color', 'red');
	} else {
		btn_id.removeAttr('disabled');
		field_id.css('border-color', 'green');
		msg_id.html('');
	}
	field_id.val(total);
}

function notValidParamxCustom(custom) {
	$("body").overhang({
		type: "error",
		message: fail + custom,
		html: true
	});
}

function readmore(id_task) {
	$('#read_partian_' + id_task).css('display', 'none');
	$('#read_full_' + id_task).css('display', 'block');
}

function hidemore(id_task) {
	$('#read_partian_' + id_task).css('display', 'block');
	$('#read_full_' + id_task).css('display', 'none');
}

function readmore2(id_task) {
	$('#read_partian2_' + id_task).css('display', 'none');
	$('#read_full2_' + id_task).css('display', 'block');
}

function hidemore2(id_task) {
	$('#read_partian2_' + id_task).css('display', 'block');
	$('#read_full2_' + id_task).css('display', 'none');
}

function unsetoption(id, val) {
	//val is array
	$.each(val, function (i, v) {
		$('#' + id + ' option[value="' + v + '"]').detach();
	});
}

function clearconsole() {
	console.log(window.console);
	if (window.console || window.console.firebug) {
		console.clear();
	}
}

function show_loader() {
	$('#loading_progress').modal({
		backdrop: 'static',
		keyboard: false
	});
}

function select_checkbox(id_all, class_child, btn_id, usage) {
	if (usage == 'parent') {
		if ($(id_all).prop("checked") == true) {
			$(class_child).prop('checked', true);
			$(btn_id).removeAttr('disabled');
			checkvalue();
		} else {
			$(class_child).prop('checked', false);
			$(btn_id).attr('disabled', 'disabled');
			checkvalue();
		}
	} else if (usage == 'child') {
		if ($(class_child).prop("checked") == false) {
			$(id_all).prop('checked', false);
			$(btn_id).attr('disabled', 'disabled');
		}
		if ($(class_child + ':checked').length == $(class_child).length) {
			$(id_all).prop('checked', true);
			$(btn_id).removeAttr('disabled');
		} else if ($(class_child + ':checked').length == 0) {
			$(id_all).prop('checked', false);
			$(btn_id).attr('disabled', 'disabled');
		} else {
			$(id_all).prop('checked', false);
			$(btn_id).removeAttr('disabled');
		}
	}
	// checkvalue();
}

//view photo
window.addEventListener('DOMContentLoaded', function () {
	$('.view_photo').click(function () {
		var image = new Image();
		image.src = $(this).attr('src');;
		var viewer = new Viewer(image, {
			hidden: function () {
				viewer.destroy();
			},
		});
		viewer.show();
	});
});
