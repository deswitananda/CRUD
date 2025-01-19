$(document).ready(function() {
	tampilkan_table('biaya', 'biaya');
	tampilkan_table('biaya', 'harga_biaya');
	tampilkan_table('seragam', 'seragam');
	tampilkan_table('seragam', 'stok');
	tampilkan_table('tahun_pelajaran', 'tahun_pelajaran');
	tampilkan_table('jurusan', 'jurusan');
	tampilkan_table('kelas', 'kelas');
	tampilkan_table('akun_pengguna', 'akun_pengguna');

	$('#id_tahun_pelajaran').load('kelas/option_tahun_pelajaran');
	$('#id_tahun_pelajaran').change(function() {
		let id = $(this).val();
		let url = 'kelas/option_jurusan';
		$('#id_jurusan').load(url + '/' + id);
	});

	$('#id_biaya').load('biaya/option_biaya');
	$('#id_seragam').load('seragam/option_seragam');

});

$(document).on('click', '.tambahBtn', function(){
	var targetMethod = $(this).data('method');
	$('#id').val('');
	$('#form_' + targetMethod).trigger('reset');
	$('#modal_' + targetMethod).modal('show');
});

function tampilkan_table(targetController, table){
	let tableElement = $('#table_' + table);
	$.ajax({
		url: targetController + '/table_' + table,
		type: 'GET',
		dataType: 'json',
		success: function(response){
			if(response.status){
				let no = 1;
				tableElement.find('tbody').html('');
				$.each(response.data, function(i, item){
					let tr = $('<tr>');
					tr.append('<td>' + no++ + '</td>');

					if(table === 'biaya'){
						tr.append('<td>' + item.nama_biaya + '</td>');
						tr.append('<td>' + item.deskripsi + '</td>');
					} else if(table === 'harga_biaya'){
						tr.append('<td>' + item.nama_biaya + '</td>');
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.harga + '</td>');
					} else if(table === 'seragam'){
						tr.append('<td>' + item.nama_seragam + '</td>');
					} else if(table === 'stok'){
						tr.append('<td>' + item.nama_seragam + '</td>');
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.ukuran + '</td>');
						tr.append('<td>' + item.stok + '</td>');
					} else if(table === 'tahun_pelajaran'){
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.tanggal_mulai + '</td>');
						tr.append('<td>' + item.tanggal_akhir + '</td>');
						tr.append('<td>' + item.status_tahun_pelajaran + '</td>');
					} else if(table === 'jurusan'){
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.nama_jurusan + '</td>');
					} else if(table === 'kelas'){
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.nama_jurusan + '</td>');
						tr.append('<td>' + item.nama_kelas + '</td>');
					} else if(table === 'akun_pengguna'){
						tr.append('<td>' + item.username + '</td>');
						tr.append('<td>' + item.password + '</td>');
					}

					tr.append('<td> <button class="btn btn-primary editBtn" data-method="'+ table +'" data-target="'+ targetController +'" data-id="' + item.id + '">Edit</button> <button class="btn btn-danger deleteBtn" data-method="'+ table +'" data-target="' + targetController + '" data-id="' + item.id + '">Delete</button></td>');
					tableElement.find('tbody').append(tr);
				});
			} else {
				tableElement.find('tbody').html('<tr><td colspan="4">' + response.message + '</td></tr>');
		  }
		}
	});
}


$(document).on('click', '.saveBtn', function()  {
	var targetController = $(this).data('target');
	var targetMethod = $(this).data('method');
	var formData = new FormData($('#form_' + targetMethod)[0]);
	$.ajax({
		url: targetController +'/save_' + targetMethod,
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		dataType: 'json',
		success: function(response) {
			if (response.status) {
				alert(response.message);
				$('#modal_' + targetMethod).modal('hide');
				tampilkan_table(targetController, targetMethod); 

			} else {
				alert(response.message);
			}
		}
	});
});

$(document).on('click', '.editBtn', function() {
	let targetController = $(this).data('target');
	let targetMethod = $(this).data('method');
	let id = $(this).data('id');
	let url = targetController +'/edit_' + targetMethod + '/' + id;

	$.ajax({
		url: url,
		type: 'POST',
		data: {
			id: id
		},
		dataType: 'json',
		success: function(response) {
			if (response.status) {
				if(targetMethod === 'biaya'){
					$('#form_biaya #id').val(response.data.id);
					$('#nama_biaya').val(response.data.nama_biaya);
					$('#deskripsi').val(response.data.deskripsi);
					$('#modal_' + targetMethod).modal('show');
					tampilkan_table(targetController, targetMethod); 
				} else if (targetMethod === 'harga_biaya'){
					console.log(response.data);
					$('#form_harga_biaya #id').val(response.data.id);
					$('#id_biaya').val(response.data.id_biaya);
					$('#id_tahun_pelajaran').val(response.data.id_tahun_pelajaran);
					$('#harga').val(response.data.harga);
					$('#modal_' + targetMethod).modal('show');
					tampilkan_table(targetController, targetMethod); 
				} else if (targetMethod === 'tahun_pelajaran'){
					$('#id').val(response.data.id);
					$('#nama_tahun_pelajaran').val(response.data.nama_tahun_pelajaran);
					$('#tanggal_mulai').val(response.data.tanggal_mulai);
					$('#tanggal_akhir').val(response.data.tanggal_akhir);
					$('#status_tahun_pelajaran').val(response.data.status_tahun_pelajaran);
					$('#modal_' + targetMethod).modal('show');
					tampilkan_table(targetController, targetMethod); 
				} else if (targetMethod === 'jurusan'){
					$('#id').val(response.data.id);
					$('#id_tahun_pelajaran').val(response.data.id_tahun_pelajaran);
					$('#nama_jurusan').val(response.data.nama_jurusan);
					$('#modal_' + targetMethod).modal('show');
					tampilkan_table(targetController, targetMethod); 
				} else if (targetMethod === 'kelas'){
					$('#id').val(response.data.id);
					$('#id_tahun_pelajaran').val(response.data.id_tahun_pelajaran);
					$('#id_jurusan').val(response.data.id_jurusan);
					$('#nama_kelas').val(response.data.nama_kelas);
					setJurusan(response.data.id_tahun_pelajaran, response.data.id_jurusan);
					$('#modal_' + targetMethod).modal('show');
					tampilkan_table(targetController, targetMethod); 
				} else if (targetMethod === 'seragam') {
					$('#form_seragam #id').val(response.data.id);
					$('#nama_seragam').val(response.data.nama_seragam);
					$('#modal_' + targetMethod).modal('show');
					tampilkan_table(targetController, targetMethod); 
				} else if (targetMethod === 'stok') {
					$('#form_stok #id').val(response.data.id);
					$('#id_seragam').val(response.data.id_seragam);
					$('#id_tahun_pelajaran').val(response.data.id_tahun_pelajaran);
					$('#ukuran').val(response.data.ukuran);
					$('#stok').val(response.data.stok);
					$('#modal_' + targetMethod).modal('show');
					tampilkan_table(targetController, targetMethod); 
				} else if (targetMethod === 'akun_pengguna') {
					$('#id').val(response.data.id);
					$('#username').val(response.data.username);
					$('#password').val(response.data.password);
					$('#modal_' + targetMethod).modal('show');
					tampilkan_table(targetController, targetMethod); 
				}
			} else {
				alert(response.message);
			}
		}
	});
});


$(document).on('click', '.deleteBtn', function() {
	var targetController = $(this).data('target');
	var targetMethod = $(this).data('method');
	var id = $(this).data('id');
	$.ajax({
		url: targetController +'/delete_' + targetMethod,
		type: 'POST',
		data: {
			id: id
		},
		dataType: 'json',
		success: function(response) {
			if (response.status) {
				alert(response.message);
				tampilkan_table(targetController, targetMethod); 
			} else {
				alert(response.message);
			}
		}
	});
});

function setJurusan(id_tahun_pelajaran, id) {
	let url = 'kelas/option_jurusan';
	$('#id_jurusan').load(url + '/' + id_tahun_pelajaran, function() {
		$('#id_jurusan').val(id);
	});
}

$(document).on('click', '#logoutBtn', function() {
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        $.ajax({
        url: 'login/logout', 
        type: 'POST',
        success: function (response) {
        	let res = JSON.parse(response);
        	if (res.status) {
                window.location.href = 'login';
            } else {
                alert('Logout gagal. Silakan coba lagi.');
            }
        },
        error: function () {
        	alert('Terjadi kesalahan. Tidak dapat logout.');
        }
    	});
    }
});