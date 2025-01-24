<div class="modal" id="modal_pendaftaran_awal" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-xl" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">PENDAFTARAN AWAL</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form id="form_pendaftaran_awal" action="#" method="post" enctype="multipart/form-data">
                         <div class="card-header bg-secondary text-dark mb-2">
                             <h3 class="card-title">A. Jenis Pendaftaran</h3>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="no_pendaftaran">No. Pendaftaran</label>
                                 <input type="text" class="form-control" id="no_pendaftaran">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="id_tahun_pelajaran" class="form-label">Nama Tahun Pelajaran</label>
                                 <select class="form-control chainedSelect" data-target="tahun_pelajaran" name="id_tahun_pelajaran" id="id_tahun_pelajaran">
                                     <option value="">- Pilih Tahun Pelajaran -</option>
                                 </select>
                                 <div class="error-block"></div>
                             </div>
                         </div>

                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="id_jurusan" class="form-label">Nama Jurusan</label>
                                 <select class="form-control chainedSelect" data-parent="id_tahun_pelajaran" data-target="jurusan" name="id_jurusan" id="id_jurusan">
                                     <option value="">- Pilih Jurusan -</option>
                                 </select>
                                 <div class="error-block"></div>
                             </div>
                             
                             <div class="form-group col-md-6">
                                 <label for="id_kelas" class="form-label">Nama Kelas</label>
                                 <select class="form-control chainedSelect" data-parent="id_jurusan" data-target="kelas" name="id_kelas" id="id_kelas">
                                     <option value="">- Pilih Kelas -</option>
                                 </select>
                                 <div class="error-block"></div>
                             </div>
                         </div>

                         <div class="card-header bg-secondary text-dark mb-2">
                             <h3 class="card-title">B. Data Siswa</h3>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="nama_siswa">Nama Siswa</label>
                                 <input type="text" class="form-control" id="nama_siswa" name="nama_siswa">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="nik">NIK</label>
                                 <input type="text" class="form-control" id="nik" name="nik">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="agama">Agama</label>
                                 <input type="text" class="form-control" id="agama" name="agama">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="nisn">NISN</label>
                                 <input type="text" class="form-control" id="nisn" name="nisn">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="jenis_kelamin">Jenis Kelamin</label>
                                 <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                     <option value="">Pilih Jenis Kelamin</option>
                                     <option value="L">Laki-laki</option>
                                     <option value="P">Perempuan</option>
                                 </select>
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="tempat_lahir">Tempat Lahir</label>
                                 <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="tanggal_lahir">Tanggal Lahir</label>
                                 <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="alamat_siswa">Alamat</label>
                                 <input type="text" class="form-control" id="alamat" name="alamat_siswa">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="no_telepon_siswa">No. Telepon Siswa</label>
                                 <input type="text" class="form-control" id="no_telepon_siswa" name="no_telepon_siswa">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="asal_sekolah">Asal Sekolah</label>
                                 <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="email">Email</label>
                                 <input type="email" class="form-control" id="email" name="email">
                             </div>
                         </div>

                         <div class="card-header bg-secondary text-dark mb-2">
                             <h3 class="card-title">C. Data Orang Tua</h3>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="nama_ayah">Nama Ayah</label>
                                 <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="nama_ibu">Nama Ibu</label>
                                 <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="no_telepon_ayah">No Telepon Ayah</label>
                                 <input type="text" class="form-control" id="no_telepon_ayah" name="no_telepon_ayah">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="no_telepon_ibu">No Telepon Ibu</label>
                                 <input type="text" class="form-control" id="no_telepon_ibu" name="no_telepon_ibu">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                 <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                 <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="nama_wali">Nama Wali</label>
                                 <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="no_telepon_wali">No. Telepon Wali</label>
                                 <input type="text" class="form-control" id="no_telepon_wali" name="no_telepon_wali">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                 <input type="text" class="form-control" id="pekerjaan_wali" nome="pekerjaan_wali">
                             </div>
                             <div class="form-group col-md-6">
                                 <label for="alamat_orang_tua">Alamat Orang Tua</label>
                                 <input type="text" class="form-control" id="alamat_orang_tua" name="alamat_orang_tua">
                             </div>
                         </div>
                         <div class="form-row">
                             <div class="form-group col-md-6">
                                 <label for="sumber_informasi">Sumber Informasi</label>
                                 <input type="text" class="form-control" id="sumber_informasi" name="sumber_informasi">
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