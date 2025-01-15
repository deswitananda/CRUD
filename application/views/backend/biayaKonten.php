<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Biaya</h3>
			</div>
			<div class="card-body">
				<!-- Tab Navigation -->
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="jenis-biaya-tab" data-toggle="tab" href="#jenis-biaya" role="tab" aria-controls="jenis-biaya" aria-selected="true">Jenis Biaya</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="harga-biaya-tab" data-toggle="tab" href="#harga-biaya" role="tab" aria-controls="harga-biaya" aria-selected="false">Harga Biaya per Kelas</a>
					</li>
				</ul>
				<!-- Tab Content -->
				<div class="tab-content" id="myTabContent">
					<!-- Tab 1: Jenis Biaya -->
					<div class="tab-pane fade show active" id="jenis-biaya" role="tabpanel" aria-labelledby="jenis-biaya-tab">
						<div class="btn btn-primary btnTambah mb-2"> <i class="fas fa-plus"></i> Tambah</div>
						<div class="row">
							<table class="table table-striped" id="tabelJenisBiaya">
								<thead>
									<tr>
										<th>No</th>
										<th>Jenis Biaya</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<!-- Tab 2: Harga Biaya per Kelas -->
					<div class="tab-pane fade" id="harga-biaya" role="tabpanel" aria-labelledby="harga-biaya-tab">
						<div class="btn btn-primary btnTambahHarga mb-2"> <i class="fas fa-plus"></i> Tambah Harga</div>
						<div class="row">
							<table class="table table-striped" id="tabelHargaBiaya">
								<thead>
									<tr>
										<th>No</th>
										<th>Kelas</th>
										<th>Tahun Pelajaran</th>
										<th>Jenis Biaya</th>
										<th>Harga</th>
										
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

<!-- Modal untuk Jenis Biaya -->
<div class="modal" id="modalJenis" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Jenis Biaya</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formJenisBiaya" action="#" method="post">
					<input type="hidden" id="idJenis" name="idJenis" value="">
					<div class="mb-1">
						<label for="nama_jenis_biaya" class="form-label">Nama Jenis Biaya</label>
						<input type="text" class="form-control" id="nama_jenis_biaya" name="nama_jenis_biaya">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtnJenis">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal untuk Harga Biaya -->
<div class="modal" id="modalHarga" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Harga Biaya</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formHargaBiaya" action="#" method="post">
					<input type="hidden" id="idHarga" name="idHarga" value="">
					<div class="mb-1">
						<label for="kelas" class="form-label">Kelas</label>
						<input type="text" class="form-control" id="kelas" name="kelas">
					</div>
					<div class="mb-1">
						<label for="nama_biaya_harga" class="form-label">Nama Biaya</label>
						<input type="text" class="form-control" id="nama_biaya_harga" name="nama_biaya_harga">
					</div>
					<div class="mb-1">
						<label for="harga_biaya" class="form-label">Harga</label>
						<input type="number" class="form-control" id="harga_biaya" name="harga_biaya">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtnHarga">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<script>
    $(document).ready(function() {
        tabelJenisBiaya();
        tabelHargaBiaya();
        tableKelas();
    });

    function tabelJenisBiaya() {
        let tabel = $('#tabelJenisBiaya');
        $.ajax({
            url: '<?php echo base_url('biaya/getJenisBiaya'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    let tr = '';
                    $.each(response.data, function(i, item) {
                        tr = $('<tr>');
                        tr.append('<td>' + (i+1) + '</td>');
                        tr.append('<td>' + item.nama_jenis_biaya + '</td>');
                        tr.append('<td><button class="btn btn-primary" onclick="editJenisBiaya(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteJenisBiaya(' + item.id + ')">Delete</button></td>');
                        tabel.find('tbody').append(tr);
                    });
                } else {
                    alert(response.message);
                }
            }
        });
    }

    function tabelHargaBiaya() {
        let tabel = $('#tabelHargaBiaya');
        $.ajax({
            url: '<?php echo base_url('biaya/getHargaBiayaPerKelas'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    let tr = '';
                    $.each(response.data, function(i, item) {
                        tr = $('<tr>');
                        tr.append('<td>' + (i+1) + '</td>');
                        tr.append('<td>' + item.kelas + '</td>');
                        tr.append('<td>' + item.nama_biaya + '</td>');
                        tr.append('<td>' + item.harga + '</td>');
                        tr.append('<td><button class="btn btn-primary" onclick="editHargaBiaya(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteHargaBiaya(' + item.id + ')">Delete</button></td>');
                        tabel.find('tbody').append(tr);
                    });
                } else {
                    alert(response.message);
                }
            }
        });
    }


    function tabelKelas() {
        let tabel = $('#tabelKelas');
        $.ajax({
            url: '<?php echo base_url('biaya/getKelas'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    let tr = '';
                    $.each(response.data, function(i, item) {
                        tr = $('<tr>');
                        tr.append('<td>' + (i+1) + '</td>');
                        tr.append('<td>' + item.nama_kelas + '</td>');
                        tr.append('<td><button class="btn btn-primary" onclick="editKelas(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteKelas(' + item.id + ')">Delete</button></td>');
                        tabel.find('tbody').append(tr);
                    });
                } else {
                    alert(response.message);
                }
            }
        });
    }

    $('.btnTambahKelas').click(function() {
        $('#idKelas').val('');
        $('#formKelas').trigger('reset');
        $('#modalKelas').modal('show');
    });

    $('.saveBtnKelas').click(function() {
        $.ajax({
            url: '<?php echo base_url('biaya/saveKelas'); ?>',
            type: 'POST',
            data: {
                id: $('#idKelas').val(),
                nama_kelas: $('#nama_kelas').val(),
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    alert(response.message);
                    $('#modalKelas').modal('hide');
                    tabelKelas();
                } else {
                    alert(response.message);
                }
            }
        })
    });

    function editKelas(id) {
        $.ajax({
            url: '<?php echo base_url('biaya/editKelas'); ?>',
            type: 'POST',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#idKelas').val(response.data.id);
                    $('#nama_kelas').val(response.data.nama_kelas);
                    $('#modalKelas').modal('show');
                } else {
                    alert(response.message);
                }
            }
        })
    }

    function deleteKelas(id) {
        $.ajax({
            url: '<?php echo base_url('biaya/deleteKelas'); ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    alert(response.message);
                    tabelKelas();
                } else {
                    alert(response.message);
                }
            }
        })
    }



	$('.btnTambah').click(function() {
		$('#id').val('');
		$('#formBiaya').trigger('reset');
		$('#modal').modal('show');
	});
	$('.saveBtn').click(function() {
		// lakukan proses simpan data, lalu tutup modal , lalu reload tabel
		$.ajax({
			url: '<?php echo base_url('biaya/save'); ?>',
			type: 'POST',
			data: {
				id: $('#id').val(),
				nama_biaya: $('#nama_biaya').val(),
				jumlah_biaya: $('#jumlah_biaya').val(),
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					$('#modal').modal('hide');
					tabel();
				} else {
					alert(response.message);
				}
			}

		})
	})
    $('.btn-secondary').click(function(){
		$('#modal').modal('hide');
	});


	function editBiaya(id) {
		// tampilkan data dalam modal 
		$.ajax({
			url: '<?php echo base_url('biaya/edit'); ?>',
			type: 'POST',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					$('#id').val(response.data.id);
					$('#nama_biaya').val(response.data.nama_biaya);
					$('#jumlah_biaya').val(response.data.jumlah_biaya);

					$('#modal').modal('show');
				} else {
					alert(response.message);
				}
			}
		})
	};

	function deleteBiaya(id) {
		// lakukan proses delete data, lalu reload tabel
		$.ajax({
			url: '<?php echo base_url('biaya/delete'); ?>',
			type: 'POST',
			data: {
				id: id,
			},
			dataType: 'json',
			success: function(response) {
				if (response.status) {
					alert(response.message);
					tabel();
				} else {
					alert(response.message);
				}
			}
		})
	};
</script>
