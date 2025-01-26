<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Jurusan</h3>
			</div>
			<div class="card-body">
				<div class="btn btn-secondary btnRefresh mb-2" data-target="jurusan"> <i class="fas fa-sync"></i> Refresh</div>
				<div class="btn btn-primary tambahBtn mb-2" data-target="jurusan"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="">
					<table class="table table-striped" width="100%" id="table_jurusan" data-target="jurusan">
						<thead class="text-sm">
							<tr>
								<th style="width: 10%"><input type="checkbox" id="check-all"></th>
								<th data-key="no">No</th>
								<th data-key="nama_tahun_pelajaran">Tahun Pelajaran</th>
                                <th data-key="nama_jurusan">Nama Jurusan</th>
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
							<select class="form-control loadSelect chainedSelect" data-target="tahun_pelajaran" id="id_tahun_pelajaran" name="id_tahun_pelajaran" value="">
								<option value="">- Pilih Tahun Pelajaran -</option>
							</select>
							<div class="text-danger"></div>
						</div>
						<div class="mb-1">
							<label for="nama_jurusan" class="form-label">- Nama Jurusan -</label>
							<input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="">
							<div class="text-danger"></div>
						</div>
					</form>

					<div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="jurusan">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('public/lib/chainedSelect.js');?>"></script>




