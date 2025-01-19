<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Jurusan</h3>
			</div>
			<div class="card-body">
				<div class="btn btn-primary tambahBtn mb-2" data-method="jurusan"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="row">
					<table class="table table-striped" id="table_jurusan">
						<thead>
							<tr>
								<th>No</th>
								<th>Tahun Pelajaran</th>
                                <th>Nama Jurusan</th>
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

<div class="modal" id="modal_jurusan" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Data Jurusan</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="form_jurusan" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">

						<div class="mb-1">
							<label for="nama_tahun_pelajaran" class="form-label">Tahun Pelajaran</label>
							<select class="form-control" id="id_tahun_pelajaran" name="id_tahun_pelajaran">
								<option value="">Pilih Tahun Pelajaran</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="nama_jurusan" class="form-label">Nama Jurusan</label>
							<input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="">
							<div class="error-block"></div>
						</div>
					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="jurusan" data-method="jurusan">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

