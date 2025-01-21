<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Tahun Pelajaran</h3>
			</div>
			<div class="card-body">
				<div class="btn btn-primary tambahBtn mb-2" data-target="tahun_pelajaran"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="row">
					<table class="table table-striped" id="table_tahun_pelajaran" data-target="tahun_pelajaran">
						<thead>
							<tr>
								<th data-key="no">No</th>
								<th data-key="nama_tahun_pelajaran">Tahun Pelajaran</th>
								<th data-key="tanggal_mulai">Mulai</th>
								<th data-key="tanggal_akhir">Akhir</th>
								<th data-key="status_tahun_pelajaran">Status</th>
								<th data-key="btn_aksi">Aksi</th>
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

<div class="modal" id="modal_tahun_pelajaran" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Tahun Pelajaran</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-user">
					<form id="form_tahun_pelajaran" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="nama_tahun_pelajaran" class="form-label">Nama Tahun Pelajaran</label>
							<input type="text" class="form-control" id="nama_tahun_pelajaran" name="nama_tahun_pelajaran" placeholder="Contoh: 2024-2025" value="">
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
						<label for="status_tahun_pelajaran" class="form-label">Status</label>
							<select class="form-control" id="status_tahun_pelajaran" name="status_tahun_pelajaran">
								<option value="">Pilih Status</option>
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
							<div class="error-block"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success saveBtn" data-target="tahun_pelajaran">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>