<div class="card card-gray card-tabs">
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
            <div class="btn btn-secondary btnRefresh mb-2" data-target="seragam"> <i class="fas fa-sync"></i> Refresh</div>    
			<div class="btn btn-primary tambahBtn mb-2" data-target="seragam"> <i class="fas fa-plus"></i> Tambah</div>
                <div class="">
                    <table class="table table-striped" width="100%" id="table_seragam" data-target="seragam">
                        <thead class="text-sm">
                            <tr>
								<th><input type="checkbox" id="check-all"></th>
                                <th data-key="no">No</th>
                                <th data-key="nama_seragam">Nama Seragam</th>
                                <th data-key="btn_aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
			<div class="btn btn-secondary btnRefresh mb-2" data-target="stok"> <i class="fas fa-sync"></i> Refresh</div>
                <div class="btn btn-primary tambahBtn mb-2" data-target="stok"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="">
					<table class="table table-striped" width="100%" id="table_stok" data-target="stok">
						<thead class="text-sm">
							<tr>
								<th><input type="checkbox" id="check-all"></th>
								<th data-key="no">No</th>
								<th data-key="nama_seragam">Nama Seragam</th>
								<th data-key="nama_tahun_pelajaran">Tahun Pelajaran</th>
								<th data-key="ukuran">Ukuran</th>
								<th data-key="stok">Stok</th>
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

<div class="modal" id="modal_seragam" tabindex=" -1" role="dialog">
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
					<form id="form_seragam" action="#" method="post" enctype="multipart/form-data">
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
				<button type="button" class="btn btn-primary saveBtn" data-target="seragam">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="modal_stok" tabindex=" -1" role="dialog">
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
					<form id="form_stok" action="#" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="mb-1">
							<label for="id_seragam" class="form-label">Nama Seragam</label>
							<select class="form-control loadSelect chainedSelect" data-target="seragam" name="id_seragam" id="id_seragam">
								<option value="">- Pilih Seragam -</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="id_tahun_pelajaran" class="form-label">Tahun Pelajaran</label>
							<select class="form-control loadSelect chainedSelect" data-target="tahun_pelajaran" name="id_tahun_pelajaran" id="id_tahun_pelajaran">
								<option value="">- Pilih Tahun Pelajaran -</option>
							</select>
							<div class="error-block"></div>
						</div>
						<div class="mb-1">
							<label for="ukuran" class="form-label">Ukuran</label>
							<select class="form-control" id="ukuran" name="ukuran">
								<option value="">Pilih Ukuran</option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
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
				<button type="button" class="btn btn-primary saveBtn" data-target="stok">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('public/lib/chainedSelect.js');?>"></script>
