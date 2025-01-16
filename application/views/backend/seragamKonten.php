<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Jenis Seragam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Stok Seragam</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <div class="btn btn-primary btnTambahSeragam mb-2"> <i class="fas fa-plus"></i> Tambah</div>
                <div class="row">
                    <table class="table table-striped" id="tabelSeragam">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Seragam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <div class="btn btn-primary btnTambahStok mb-2"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="row">
					<table class="table table-striped" id="tabelStok">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Seragam</th>
								<th>Tahun Pelajaran</th>
								<th>Jurusan</th>
								<th>Kelas</th>
								<th>Ukuran</th>
								<th>Stok</th>
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

<div class="modal" id="modalSeragam" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Jenis Seragam</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="formSeragam" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="nama_seragam" class="form-label">Nama Seragam</label>
							<input type="text" class="form-control" id="nama_seragam" name="nama_seragam" value="">
							<div class="error-block"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtnSeragam">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="modalStok" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Stok Seragam</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="formStok" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="id_seragam" class="form-label">Nama Seragam</label>
							<select class="form-control" name="id_seragam" id="id_seragam">
								<option value="">- Pilih Seragam -</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="id_tahun_pelajaran" class="form-label">Tahun Pelajaran</label>
							<select class="form-control" name="id_tahun_pelajaran" id="id_tahun_pelajaran">
								<option value="">- Pilih Tahun Pelajaran -</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="id_jurusan" class="form-label">Jurusan</label>
							<select class="form-control" name="id_jurusan" id="id_jurusan">
								<option value="">- Pilih Jurusan -</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="id_kelas" class="form-label">Kelas</label>
							<select class="form-control" name="id_kelas" id="id_kelas">
								<option value="">- Pilih Kelas -</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="ukuran" class="form-label">Ukuran</label>
							<input type="text" class="form-control" id="ukuran" name="ukuran" value="">
							<div class="error-block"></div>
						</div>
            			<div class="mb-1">
							<label for="stok" class="form-label">Stok</label>
							<input type="text" class="form-control" id="stok" name="stok" value="">
							<div class="error-block"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtnStok">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function() {
      tabelSeragam();
      tabelStok();
    })
	
    $('#id_tahun_pelajaran').load('<?php echo base_url('seragam/option_tahun_pelajaran'); ?>');
	  $('#id_tahun_pelajaran').change(function() {
      let id = $(this).val(); // id tahun pelajaran
      let url = '<?php echo base_url('seragam/option_jurusan'); ?>';
      $('#id_jurusan').load(url + '/' + id);
    })
    $('#id_jurusan').change(function() {
      let id = $(this).val();
      let url = '<?php echo base_url('seragam/option_kelas'); ?>';
      $('#id_kelas').load(url + '/' + id);
    })
    $('#id_seragam').load('<?php echo base_url('seragam/option_seragam'); ?>');


    $('.btnTambahSeragam').click(function() {
      $('#id').val('');
      $('#formSeragam').trigger('reset');
      $('#modalSeragam').modal('show');
    });



    function tabelSeragam() {
		let tabelSeragam = $('#tabelSeragam');
		let tr = $('<tr>');
		$.ajax({
			url: '<?php echo base_url('seragam/table_seragam'); ?>',
			type: 'GET',

			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabelSeragam.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {
						let tr = $('<tr>');
						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_seragam + '</td>');
						tr.append('<td>	<button class="btn btn-primary" onclick="editSeragam(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteSeragam(' + item.id + ')">Delete</button></td>');
						tabelSeragam.find('tbody').append(tr);
					});

				} else {
					tabelSeragam.find('tbody').html('');
					tr.append('<td colspan="4">' + response.message + '</td>');
				}
			}
		});
	}

	$('.saveBtnSeragam').click(function() {
		$.ajax({
			url: '<?php echo base_url('seragam/saveSeragam'); ?>',
			type: 'POST',
			data: {
				id: $('#id').val(),
				nama_seragam: $('#nama_seragam').val(),
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					$('#modalSeragam').modal('hide');
					tabelSeragam();
				} else {
					alert(response.message);
				}
			}

		})
	})

	function editSeragam(id){
			$.ajax({
				url: '<?php echo base_url('seragam/editSeragam'); ?>',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						$('#id').val(response.data.id);
						$('#nama_seragam').val(response.data.nama_seragam);
						$('#modalSeragam').modal('show');
						tabelSeragam();
					} else {
						alert(response.message);
					}
				}
			});
	}

	function deleteSeragam(id) {
		if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
			let url = '<?php echo base_url('seragam/deleteSeragam'); ?>';
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						alert(response.message);
						tabelSeragam();
					} else {
						alert(response.message);
					}
				}
			});
		}

	}

	$('.btnTambahStok').click(function() {
      $('#id').val('');
      $('#formStok').trigger('reset');
      $('#modalStok').modal('show');
    });

    function tabelStok() {
		let tabelStok = $('#tabelStok');
		let tr = $('<tr>');
		$.ajax({
			url: '<?php echo base_url('seragam/table_stok'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabelStok.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {
						let tr = $('<tr>');
						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_seragam + '</td>');
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.nama_jurusan + '</td>');
						tr.append('<td>' + item.nama_kelas + '</td>');
						tr.append('<td>' + item.ukuran + '</td>');
						tr.append('<td>' + item.stok + '</td>');
						tr.append('<td>	<button class="btn btn-primary" onclick="editStok(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteStok(' + item.id + ')">Delete</button></td>');
						tabelStok.find('tbody').append(tr);
					});
				} else {
					tabelStok.find('tbody').html('');
					tr.append('<td colspan="4">' + response.message + '</td>');
				}
			}
		});
	}

    
    $('.saveBtnStok').click(function() {
		$.ajax({
			url: '<?php echo base_url('seragam/saveStok'); ?>',
			type: 'POST',
			data: {
				id: $('#id').val(),
				id_seragam: $('#id_seragam').val(),
				id_tahun_pelajaran: $('#id_tahun_pelajaran').val(),
				id_jurusan: $('#id_jurusan').val(),
				id_kelas: $('#id_kelas').val(),
				ukuran: $('#ukuran').val(),
				stok: $('#stok').val(),
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					$('#modalStok').modal('hide');
					tabelStok();
				} else {
					alert(response.message);
				}
			}

		})
	})

    
    function editStok(id){
			$.ajax({
				url: '<?php echo base_url('seragam/editStok'); ?>',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						$('#id').val(response.data.id);
						$('#id_seragam').val(response.data.id_seragam);
						$('#id_tahun_pelajaran').val(response.data.id_tahun_pelajaran);
						$('#id_jurusan').val(response.data.id_jurusan);
						$('#id_kelas').val(response.data.id_kelas);
						$('#ukuran').val(response.data.ukuran);
						$('#stok').val(response.data.stok);
						setJurusan(response.data.id_tahun_pelajaran, response.data.id_jurusan);
						setKelas(response.data.id_jurusan, response.data.id_kelas);
						$('#modalStok').modal('show');
						tableStok();
					} else {
						alert(response.message);
					}
				}
			});
	}

    
    function deleteStok(id) {
		if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
			let url = '<?php echo base_url('seragam/deleteStok'); ?>';
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						alert(response.message);
						tabelStok();
					} else {
						alert(response.message);
					}
				}
			});
		}

	}

    function setJurusan(id_tahun_pelajaran, id) {
		let url = '<?php echo base_url('seragam/option_jurusan'); ?>';
		$('#id_jurusan').load(url + '/' + id_tahun_pelajaran, function() {
			$('#id_jurusan').val(id);
		});

	}
    function setKelas(id_jurusan, id) {
		let url = '<?php echo base_url('seragam/option_kelas'); ?>';
		$('#id_kelas').load(url + '/' + id_jurusan, function() {
			$('#id_kelas').val(id);
		});

	}
</script>