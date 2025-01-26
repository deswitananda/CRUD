<div class="card card-gray card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs tab_harga_biaya" id="custom-tabs-one-tab" role="tablist">
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
				<div class="btn btn-secondary btnRefresh mb-2" data-target="biaya"> <i class="fas fa-sync"></i> Refresh</div>
                <div class="btn btn-primary tambahBtn mb-2" data-target="biaya"> <i class="fas fa-plus"></i> Tambah</div>
                <div class="">
                    <table class="table table-striped" width="100%" data-target="biaya"  id="table_biaya">
                        <thead class="text-sm">
                            <tr>
								<th><input type="checkbox" id="check-all"></th>
                                <th data-key="no">No</th>
                                <th data-key="nama_biaya">Nama Biaya</th>
                                <th data-key="deskripsi">Deskripsi</th>
                                <th data-key="btn_aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
            <div class="btn btn-secondary btnRefresh mb-2" data-target="harga_biaya"> <i class="fas fa-sync"></i> Refresh</div>    
			<div class="btn btn-primary tambahBtn mb-2" data-target="harga_biaya"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="">
					<table class="table table-striped" width="100%" data-target="harga_biaya" id="table_harga_biaya">
						<thead class="text-sm">
							<tr>
								<th><input type="checkbox" id="check-all"></th>
								<th data-key="no">No</th>
								<th data-key="nama_biaya">Nama Biaya</th>
								<th data-key="nama_tahun_pelajaran">Tahun Pelajaran</th>
								<th data-key="harga">Harga</th>
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

<div class="modal" id="modal_biaya" tabindex=" -1" role="dialog">
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
					<form id="form_biaya" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="nama_biaya" class="form-label">Nama Biaya</label>
							<input type="text" class="form-control" id="nama_biaya" name="nama_biaya" value="">
							<div class="text-danger"></div>
						</div>
						<div class="mb-1">
							<label for="deskripsi" class="form-label">Deskripsi</label>
							<input type="text" class="form-control" id="deskripsi" name="deskripsi" value="">
							<div class="text-danger"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="biaya">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="modal_harga_biaya" tabindex=" -1" role="dialog">
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
					<form id="form_harga_biaya" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="id_biaya" class="form-label">Nama Biaya</label>
							<select class="form-control loadSelect chainedSelect" data-target="biaya" name="id_biaya" id="id_biaya">
								<option value="">- Pilih Biaya -</option>
							</select>
							<div class="text-danger"></div>
						</div>
						<div class="mb-1">
							<label for="id_tahun_pelajaran" class="form-label">Tahun Pelajaran</label>
							<select class="form-control loadSelect chainedSelect" data-target="tahun_pelajaran" name="id_tahun_pelajaran" id="id_tahun_pelajaran">
								<option value="">- Pilih Tahun Pelajaran -</option>
							</select>
							<div class="text-danger"></div>
						</div>
                        <div class="mb-1">
							<label for="harga" class="form-label">Harga</label>
							<input type="text" class="form-control" id="harga" name="harga" placeholder="Contoh: Rp 100.000" value="">
							<div class="text-danger"></div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="harga_biaya">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('public/lib/chainedSelect.js');?>"></script>