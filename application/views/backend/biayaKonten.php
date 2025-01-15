<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Jenis Biaya</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Harga</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <div class="btn btn-primary btnTambahBiaya mb-2"> <i class="fas fa-plus"></i> Tambah</div>
                <div class="row">
                    <table class="table table-striped" id="tabelBiaya">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Biaya</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <div class="btn btn-primary btnTambahHargaBiaya mb-2"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="row">
					<table class="table table-striped" id="tabelHargaBiaya">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Biaya</th>
								<th>Tahun Pelajaran</th>
								<th>Jurusan</th>
								<th>Kelas</th>
								<th>Harga</th>
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

<div class="modal" id="modalBiaya" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Jenis Biaya</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="formBiaya" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="nama_biaya" class="form-label">Nama Biaya</label>
							<input type="text" class="form-control" id="nama_biaya" name="nama_biaya" value="">
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="deskripsi" class="form-label">Deskripsi</label>
							<input type="text" class="form-control" id="deskripsi" name="deskripsi" value="">
							<div class="error-block"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtnBiaya">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="modalHargaBiaya" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Harga Biaya</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="formHargaBiaya" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="id_biaya" class="form-label">Nama Biaya</label>
							<select class="form-control" name="id_biaya" id="id_biaya">
								<option value="">- Pilih Biaya -</option>
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
							<label for="harga" class="form-label">Harga</label>
							<input type="text" class="form-control" id="harga" name="harga" value="">
							<div class="error-block"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtnHargaBiaya">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function() {
		tabelBiaya();
        tabelHargaBiaya();
	})

    $('#id_tahun_pelajaran').load('<?php echo base_url('biaya/option_tahun_pelajaran'); ?>');
	$('#id_tahun_pelajaran').change(function() {
		let id = $(this).val(); // id tahun pelajaran
		let url = '<?php echo base_url('biaya/option_jurusan'); ?>';
		$('#id_jurusan').load(url + '/' + id);

	})
    $('#id_jurusan').change(function() {
		let id = $(this).val();
		let url = '<?php echo base_url('biaya/option_kelas'); ?>';
		$('#id_kelas').load(url + '/' + id);
	})
    $('#id_biaya').load('<?php echo base_url('biaya/option_biaya'); ?>');


    $('.btnTambahBiaya').click(function() {
		$('#id').val('');
		$('#formBiaya').trigger('reset');
		$('#modalBiaya').modal('show');
	});

    $('.btnTambahHargaBiaya').click(function() {
		$('#id').val('');
		$('#formHargaBiaya').trigger('reset');
		$('#modalHargaBiaya').modal('show');
	});

    function tabelBiaya() {
		let tabelBiaya = $('#tabelBiaya');
		let tr = $('<tr>');
		$.ajax({
			url: '<?php echo base_url('biaya/table_biaya'); ?>',
			type: 'GET',

			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabelBiaya.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {
						let tr = $('<tr>');
						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_biaya + '</td>');
						tr.append('<td>' + item.deskripsi + '</td>');
						tr.append('<td>	<button class="btn btn-primary" onclick="editBiaya(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteBiaya(' + item.id + ')">Delete</button></td>');
						tabelBiaya.find('tbody').append(tr);
					});

				} else {
					tabelBiaya.find('tbody').html('');
					tr.append('<td colspan="4">' + response.message + '</td>');
				}
			}
		});
	}

    function tabelHargaBiaya() {
		let tabelHargaBiaya = $('#tabelHargaBiaya');
		let tr = $('<tr>');
		$.ajax({
			url: '<?php echo base_url('biaya/table_harga_biaya'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabelHargaBiaya.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {
						let tr = $('<tr>');
						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_biaya + '</td>');
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.nama_jurusan + '</td>');
						tr.append('<td>' + item.nama_kelas + '</td>');
						tr.append('<td>' + item.harga + '</td>');
						tr.append('<td>	<button class="btn btn-primary" onclick="editHargaBiaya(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteHargaBiaya(' + item.id + ')">Delete</button></td>');
						tabelHargaBiaya.find('tbody').append(tr);
					});

				} else {
					tabelHargaBiaya.find('tbody').html('');
					tr.append('<td colspan="4">' + response.message + '</td>');
				}
			}
		});
	}

    $('.saveBtnBiaya').click(function() {
		$.ajax({
			url: '<?php echo base_url('biaya/saveBiaya'); ?>',
			type: 'POST',
			data: {
				id: $('#id').val(),
				nama_biaya: $('#nama_biaya').val(),
				deskripsi: $('#deskripsi').val(),
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					$('#modalBiaya').modal('hide');
					tabelBiaya();
				} else {
					alert(response.message);
				}
			}

		})
	})
    $('.saveBtnHargaBiaya').click(function() {
		$.ajax({
			url: '<?php echo base_url('biaya/saveHargaBiaya'); ?>',
			type: 'POST',
			data: {
				id: $('#id').val(),
				id_biaya: $('#id_biaya').val(),
				id_tahun_pelajaran: $('#id_tahun_pelajaran').val(),
				id_jurusan: $('#id_jurusan').val(),
				id_kelas: $('#id_kelas').val(),
				harga: $('#harga').val(),
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					$('#modalHargaBiaya').modal('hide');
					tabelHargaBiaya();
				} else {
					alert(response.message);
				}
			}

		})
	})

    function editBiaya(id){
			$.ajax({
				url: '<?php echo base_url('biaya/editBiaya'); ?>',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						$('#id').val(response.data.id);
						$('#nama_biaya').val(response.data.nama_biaya);
						$('#deskripsi').val(response.data.deskripsi);
						$('#modalBiaya').modal('show');
						tableBiaya();
					} else {
						alert(response.message);
					}
				}
			});
	}
    function editHargaBiaya(id){
			$.ajax({
				url: '<?php echo base_url('biaya/editHargaBiaya'); ?>',
				type: 'POST',
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						$('#id').val(response.data.id);
						$('#id_biaya').val(response.data.id_biaya);
                        $('#id_tahun_pelajaran').val(response.data.id_tahun_pelajaran);
                        $('#id_jurusan').val(response.data.id_jurusan);
                        $('#id_kelas').val(response.data.id_kelas);
                        $('#harga').val(response.data.harga);
                        setJurusan(response.data.id_tahun_pelajaran, response.data.id_jurusan);
                        setKelas(response.data.id_jurusan, response.data.id_kelas);
						$('#modalHargaBiaya').modal('show');
						tableHargaBiaya();
					} else {
						alert(response.message);
					}
				}
			});
	}

    function deleteBiaya(id) {
		if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
			let url = '<?php echo base_url('biaya/deleteBiaya'); ?>';
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
						tabelBiaya();
					} else {
						alert(response.message);
					}
				}
			});
		}

	}
    function deleteHargaBiaya(id) {
		if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
			let url = '<?php echo base_url('biaya/deleteHargaBiaya'); ?>';
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
						tabelHargaBiaya();
					} else {
						alert(response.message);
					}
				}
			});
		}

	}

    function setJurusan(id_tahun_pelajaran, id) {
		let url = '<?php echo base_url('biaya/option_jurusan'); ?>';
		$('#id_jurusan').load(url + '/' + id_tahun_pelajaran, function() {
			$('#id_jurusan').val(id);
		});

	}
    function setKelas(id_jurusan, id) {
		let url = '<?php echo base_url('biaya/option_kelas'); ?>';
		$('#id_kelas').load(url + '/' + id_jurusan, function() {
			$('#id_kelas').val(id);
		});

	}
</script>

