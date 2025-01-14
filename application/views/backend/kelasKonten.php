<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Kelas</h3>
			</div>
			<div class="card-body">
				<div class="btn btn-primary btnTambahKelas mb-2"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="row">
					<table class="table table-striped" id="tabelKelas">
						<thead>
							<tr>
								<th>No</th>
								<th>Tahun Pelajaran</th>
								<th>Mulai</th>
								<th>Akhir</th>
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

<div class="modal" id="modalKelas" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Kelas</h5>

				<button type="button" class="close " data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">

						<div class="mb-1">
							<label for="nama_kelas" class="form-label">Nama Kelas</label>
							<input type="text" class="form-control" id="nama_tahun_pelajaran" name="nama_tahun_pelajaran" value="">
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
							<input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="">
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
							<input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="">
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="status_kelas" class="form-label">Status</label>
							<select class="form-control" id="status_kelas" name="status_kelas">
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
							<div class="error-block"></div>
						</div>


					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn">Simpan</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>



<script>
	$(document).ready(function() {
		tabelKelas();
	})

	function tabelKelas() {
		let tabelKelas = $('#tabelKelas');
		let tr = $('<tr>');
		$.ajax({
			url: '<?php echo base_url('kelas/table_kelas'); ?>',
			type: 'GET',

			dataType: 'json',
			success: function(response) {
				if (response.status) {
					tabelKelas.find('tbody').html('');
					let no = 1;
					$.each(response.data, function(i, item) {

						tr.append('<td>' + no++ + '</td>');
						tr.append('<td>' + item.nama_tahun_pelajaran + '</td>');
						tr.append('<td>' + item.tanggal_mulai + '</td>');
						tr.append('<td>' + item.tanggal_akhir + '</td>');
						tr.append('<td>' + item.status_tahun_pelajaran + '</td>');
						tr.append('<td>	<button class="btn btn-primary" onclick="editKelas(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteTahunPelajarar(' + item.id + ')">Delete</button></td>');
						tabelKelas.find('tbody').append(tr);
					});

				} else {
					tabelKelas.find('tbody').html('');
					tr.append('<td colspan="4">' + response.message + '</td>');
				}
			}
		});
	}

	$('.btnTambahKelas').click(function() {
		$('#modalKelas').modal('show');
	});
	$('.saveBtn').click(function() {
		// lakukan proses simpan data, lalu tutup modal , lalu reload tabel
	})
	$('.editBtn').click(function() {
		// tampilkan data dalam modal 
	})
	$('.deleteBtn').click(function() {
		// lakukan proses delete data, lalu reload tabel
	})
</script>