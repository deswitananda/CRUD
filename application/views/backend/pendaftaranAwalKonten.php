<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Pendaftaran Awal</h3>
			</div>
			<div class="card-body">
				<div class="btn btn-secondary btnRefresh mb-2" data-target="pendaftaran_awal"> <i class="fas fa-sync"></i> Refresh</div>
				<div class="btn btn-primary tambahBtn mb-2" data-target="pendaftaran_awal"> <i class="fas fa-plus"></i> Tambah</div>
				<div class="">
					<table class="table table-striped nowrap" width="100%" id="table_pendaftaran_awal" data-target="pendaftaran_awal">
						<thead class="text-sm">
							<tr>
								<th><input type="checkbox" id="check-all"></th>
								<th data-key="no">No</th>
								<th data-key="no_pendaftaran">Nomor Pendaftaran</th>
								<th data-key="nama_siswa">Nama Siswa</th>
								<th data-key="jenis_kelamin">Jenis Kelamin</th>
								<th data-key="asal_sekolah">Asal Sekolah</th>
								<th data-key="email">Email</th>
								<th data-key="no_telepon">No Telepon</th>
								<th data-key="nama_ayah" >Nama Orang Tua</th>
								<th data-key="no_telepon_ayah">No Orang Tua</th>
								<th data-key="btn_pendaftaran">Aksi</th>
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


<div class="modal" id="modal_pendaftaran_awal" tabindex="-2" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content modal-info">
			<div class="modal-header">
				<h5 class="modal-title">Form Pendaftaran Awal</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form_pendaftaran_awal"  action="#" method="post" enctype="multipart/form-data">
				<div class="card card-info mt-2">
					<div class="card-header">
						<h3 class="card-title">Data Kelas</h3>
					</div>
				
					<div class="form-user my-3 mx-3">

							<input type="hidden" class="form-control" id="id" name="id" value="">
							<div class="form-group row">
								<label for="no_pendaftaran" class="form-label col-sm-3">Nomor Pendaftaran</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="no_pendaftaran" name="no_pendaftaran" value="" readonly>
									<div class="text-danger"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="id_tahun_pelajaran" class="form-label col-sm-3">Nama Tahun Pelajaran</label>
								<div class="col-sm-9">
									<select class="form-control loadSelect chainedSelect" data-target="tahun_pelajaran"  name="id_tahun_pelajaran" id="id_tahun_pelajaran" required>
										<option value="">Pilih</option>
									</select>
									<div class="text-danger"></div>
								</div>
								
							</div>
							<div class="form-group row">
								<label for="id_jurusan" class="form-label col-sm-3">Nama Jurusan</label>
								<div class="col-sm-9">
									<select class="form-control chainedSelect" data-parent="id_tahun_pelajaran" data-target="jurusan" name="id_jurusan" id="id_jurusan">
										<option value="">Pilih</option>
									</select>
									<div class="text-danger"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="id_kelas" class="form-label col-sm-3">Nama Kelas</label>
								<div class="col-sm-9">
									<select class="form-control chainedSelect" data-parent="id_jurusan" data-target="kelas" name="id_kelas" id="id_kelas">
										<option value="">Pilih</option>
									</select>
									<div class="text-danger"></div>
								</div>
								
							</div>
					</div>
				</div>

				<div class="card card-info mt-2">
					<div class="card-header">
						<h3 class="card-title">Data Siswa</h3>
					</div>
				
					<div class="form-user my-3 mx-3">
<!-- 
						<input type="hidden" class="form-control" id="id" name="id" value=""> -->
						<div class="row">
							<!-- Kolom Kiri -->
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="nama_siswa" class="form-label col-sm-4">Nama</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="nik" class="form-label col-sm-4">NIK</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="nik" name="nik" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="agama" class="form-label col-sm-4">Agama</label>
									<div class="col-sm-8">
										<select class="form-control" name="agama" id="agama">
											<option value="">Pilih</option>
											<option value="Islam">Islam</option>
											<option value="Kristen Protestan">Kristen Protestan</option>
											<option value="Katolik">Katolik</option>
											<option value="Khonghucu">Khonghucu</option>
											<option value="Hindu">Hindu</option>
											<option value="Budha">Budha</option>
										</select>
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="nisn" class="form-label col-sm-4">NISN</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="nisn" name="nisn" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="jenis_kelamin" class="form-label col-sm-4">Jenis Kelamin</label>
									<div class="col-sm-8">
										<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
											<option value="">Pilih</option>
											<option value="Laki-laki">Laki-laki</option>
											<option value="Perempuan">Perempuan</option>
										</select>
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="alamat" class="form-label col-sm-4">Alamat</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="alamat" name="alamat" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
							</div>

							<!-- Kolom Kanan -->
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="tempat_lahir" class="form-label col-sm-4">Tempat Lahir</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="tanggal_lahir" class="form-label col-sm-4">Tanggal Lahir</label>
									<div class="col-sm-8">
										<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Contoh: 2003-05-08" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="no_telepon" class="form-label col-sm-4">No Telepon</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Contoh: 081300000000" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="email" class="form-label col-sm-4">Email</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="email" name="email" placeholder="Contoh: example@gmail.com" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
								<div class="form-group row">
									<label for="asal_sekolah" class="form-label col-sm-4">Asal Sekolah</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="">
										<div class="text-danger"></div>
									</div>
									
								</div>
							</div>
						</div>
				

					</div>
				</div>

				<div class="card card-info mt-2">
					<div class="card-header">
						<h3 class="card-title">Data Orang Tua</h3>
					</div>
				
					<div class="form-user my-3 mx-3">
							<!-- <input type="hidden" class="form-control" id="id" name="id" value=""> -->
							<div class="row">
								<!-- Kolom Kiri -->
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="nama_ayah" class="form-label col-sm-4">Nama Ayah</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="no_telepon_ayah" class="form-label col-sm-4">No Telepon Ayah</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="no_telepon_ayah" name="no_telepon_ayah" placeholder="Contoh: 081300000000" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="pekerjaan_ayah" class="form-label col-sm-4">Pekerjaan Ayah</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="nama_ibu" class="form-label col-sm-4">Nama Ibu</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="no_telepon_ibu" class="form-label col-sm-4">No Telepon Ibu</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="no_telepon_ibu" name="no_telepon_ibu" placeholder="Contoh: 081300000000" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="pekerjaan_ibu" class="form-label col-sm-4">Pekerjaan Ibu</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
								</div>

								<!-- Kolom Kanan -->
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="nama_wali" class="form-label col-sm-4">Nama Wali</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nama_wali" name="nama_wali" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="no_telepon_wali" class="form-label col-sm-4">No Telepon Wali</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="no_telepon_wali" name="no_telepon_wali" placeholder="Contoh: 081300000000" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="pekerjaan_wali" class="form-label col-sm-4">Pekerjaan Wali</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="alamat_wali" class="form-label col-sm-4">Alamat</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="alamat_wali" name="alamat_wali" value="">
											<div class="text-danger"></div>
										</div>
										
									</div>
									<div class="form-group row">
										<label for="sumber_informasi" class="form-label col-sm-4">Sumber Informasi</label>
										<div class="col-sm-8">
											<select class="form-control" name="sumber_informasi" id="informasi">
												<option value="">Pilih</option>
												<option value="Website">Website</option>
												<option value="Sosial Media">Sosial Media</option>
												<option value="Kerabat">Kerabat</option>
												<option value="Spanduk">Spanduk</option>
												<option value="Flayer">Flayer</option>
												<option value="Acara Sekolah">Acara Sekolah</option>
											</select>
											<div class="text-danger"></div>
										</div>
										
									</div>
								</div>
							</div>
						
					</div>
				</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary saveBtn" data-target="pendaftaran_awal">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="detailModal" tabindex="-2" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content modal-info">
			<div class="modal-header">
				<h5 class="modal-title">Form Pendaftaran Awal</h5>

				<button type="button" class="close " data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form_detail" action="#" method="post" enctype="multipart/form-data">
				<div class="card card-info mt-2">
					<div class="card-header">
						<h3 class="card-title">Data Kelas</h3>
					</div>
				
					<div class="form-user my-3 mx-3">

							<input type="hidden" class="form-control" id="id" name="id" value="">
							<div class="form-group row">
								<label for="no_pendaftaran" class="form-label col-sm-3">Nomor Pendaftaran</label>
								<div class="col-sm-9">
								<input type="text" class="form-control " id="no_pendaftaran" name="no_pendaftaran" value="" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="id_tahun_pelajaran" class="form-label col-sm-3">Nama Tahun Pelajaran</label>
								<div class="col-sm-9">
								<select class="form-control chainedSelect" data-target="tahun_pelajaran"  name="id_tahun_pelajaran" id="id_tahun_pelajaran" disabled>
									<option value="">- Pilih Tahun Pelajaran -</option>
								</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="id_jurusan" class="form-label col-sm-3">Nama Jurusan</label>
								<div class="col-sm-9">
								<select class="form-control chainedSelect" data-parent="id_tahun_pelajaran" data-target="jurusan" name="id_jurusan" id="id_jurusan" disabled>
									<option value="">- Pilih Jurusan -</option>
								</select>
								</div>
							</div>
							<div class="form-group row">
							<label for="id_kelas" class="form-label col-sm-3">Nama Kelas</label>
							<div class="col-sm-9">
								<select class="form-control chainedSelect" data-parent="id_jurusan" data-target="kelas" name="id_kelas" id="id_kelas" disabled>
									<option value="">- Pilih Kelas -</option>
								</select>
								</div>
							</div>

					</div>
				</div>

				<div class="card card-info mt-2">
					<div class="card-header">
						<h3 class="card-title">Data Siswa</h3>
					</div>
				
					<div class="form-user my-3 mx-3">

						<input type="hidden" class="form-control" id="id" name="id" value="">
						<div class="row">
							<!-- Kolom Kiri -->
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="nama_siswa" class="form-label col-sm-4">Nama</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="nik" class="form-label col-sm-4">NIK</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="nik" name="nik" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="agama" class="form-label col-sm-4">Agama</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="agama" name="agama" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="nisn" class="form-label col-sm-4">NISN</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="nisn" name="nisn" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="jenis_kelamin" class="form-label col-sm-4">Jenis Kelamin</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="alamat" class="form-label col-sm-4">Alamat</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="alamat" name="alamat" value="" readonly>
									</div>

								</div>
							</div>

							<!-- Kolom Kanan -->
							<div class="col-sm-6">
								<div class="form-group row">
									<label for="tempat_lahir" class="form-label col-sm-4">Tempat Lahir</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="tanggal_lahir" class="form-label col-sm-4">Tanggal Lahir</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="no_telepon" class="form-label col-sm-4">No Telepon</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="no_telepon" name="no_telepon" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="email" class="form-label col-sm-4">Email</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="email" name="email" value="" readonly>
									</div>

								</div>
								<div class="form-group row">
									<label for="asal_sekolah" class="form-label col-sm-4">Asal Sekolah</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="" readonly>
									</div>

								</div>
							</div>
						</div>
				

					</div>
				</div>

				<div class="card card-info mt-2">
					<div class="card-header">
						<h3 class="card-title">Data Orang Tua</h3>
					</div>
				
					<div class="form-user my-3 mx-3">
							<input type="hidden" class="form-control" id="id" name="id" value="" readonly>
							<div class="row">
								<!-- Kolom Kiri -->
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="nama_ayah" class="form-label col-sm-4">Nama Ayah</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="no_telepon_ayah" class="form-label col-sm-4">No Telepon Ayah</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="no_telepon_ayah" name="no_telepon_ayah" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="pekerjaan_ayah" class="form-label col-sm-4">Pekerjaan Ayah</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="nama_ibu" class="form-label col-sm-4">Nama Ibu</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="no_telepon_ibu" class="form-label col-sm-4">No Telepon Ibu</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="no_telepon_ibu" name="no_telepon_ibu" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="pekerjaan_ibu" class="form-label col-sm-4">Pekerjaan Ibu</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="" readonly>
										</div>
	
									</div>
								</div>

								<!-- Kolom Kanan -->
								<div class="col-sm-6">
									<div class="form-group row">
										<label for="nama_wali" class="form-label col-sm-4">Nama Wali</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nama_wali" name="nama_wali" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="no_telepon_wali" class="form-label col-sm-4">No Telepon Wali</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="no_telepon_wali" name="no_telepon_wali" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="pekerjaan_wali" class="form-label col-sm-4">Pekerjaan Wali</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="alamat_wali" class="form-label col-sm-4">Alamat</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="alamat_wali" name="alamat_wali" value="" readonly>
										</div>
	
									</div>
									<div class="form-group row">
										<label for="sumber_informasi" class="form-label col-sm-4">Sumber Informasi</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="sumber_informasi" name="sumber_informasi" value="" readonly>
										</div>
	
									</div>
								</div>
							</div>
						
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo base_url('public/lib/chainedSelect.js');?>"></script>