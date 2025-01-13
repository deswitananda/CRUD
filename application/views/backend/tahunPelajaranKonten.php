<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tahun Pelajaran</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btnTambahTahunPelajaran mb-2"> <i class="fas fa-plus"></i> Tambah</button>
                <div class="row">
                    <table class="table table-striped" id="tabelTahunPelajaran">
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
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalTahunPelajaran" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tahun Pelajaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTahunPelajaran">
                    <input type="hidden" class="form-control" id="id" name="id">

                    <div class="mb-1">
                        <label for="nama_tahun_pelajaran" class="form-label">Nama Tahun Pelajaran</label>
                        <input type="text" class="form-control" id="nama_tahun_pelajaran" name="nama_tahun_pelajaran">
                    </div>
                    <div class="mb-1">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                    </div>
                    <div class="mb-1">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                    </div>
                    <div class="mb-1">
                        <label for="status_tahun_pelajaran" class="form-label">Status</label>
                        <select class="form-control" id="status_tahun_pelajaran" name="status_tahun_pelajaran">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveBtn">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Load tabel data saat halaman siap
        loadTabelTahunPelajaran();

        // Tampilkan modal untuk tambah data
        $('.btnTambahTahunPelajaran').click(function () {
            $('#formTahunPelajaran')[0].reset(); // Reset form
            $('#id').val(''); // Reset ID untuk tambah data baru
            $('#modalTahunPelajaran').modal('show');
        });

        // Simpan data tahun pelajaran
        $('.saveBtn').click(function () {
            const formData = $('#formTahunPelajaran').serialize();

            $.ajax({
                url: '<?php echo base_url("tahun_pelajaran/save_tahun_pelajaran"); ?>',
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.status) {
                        alert('Data berhasil disimpan!');
                        $('#modalTahunPelajaran').modal('hide');
                        loadTabelTahunPelajaran();
                    } else {
                        alert('Gagal menyimpan data.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });
    });

    // Fungsi untuk memuat data ke tabel
    function loadTabelTahunPelajaran() {
        const tabelTahunPelajaran = $('#tabelTahunPelajaran tbody');
        tabelTahunPelajaran.html(''); // Kosongkan tabel

        $.ajax({
            url: '<?php echo base_url("tahun_pelajaran/table_tahun_pelajaran"); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    let no = 1;
                    response.data.forEach(item => {
                        const statusText = item.status_tahun_pelajaran === '1' ? 'Aktif' : 'Tidak Aktif';
                        const row = `<tr>
                            <td>${no++}</td>
                            <td>${item.nama_tahun_pelajaran}</td>
                            <td>${item.tanggal_mulai}</td>
                            <td>${item.tanggal_akhir}</td>
                            <td>${statusText}</td>
                            <td>
                                <button class="btn btn-primary" onclick="editTahunPelajaran(${item.id})">Edit</button>
                                <button class="btn btn-danger" onclick="deleteTahunPelajaran(${item.id})">Delete</button>
                            </td>
                        </tr>`;
                        tabelTahunPelajaran.append(row);
                    });
                } else {
                    tabelTahunPelajaran.html('<tr><td colspan="6">Tidak ada data tersedia</td></tr>');
                }
            }
        });
    }

    // Fungsi untuk menghapus data
    function deleteTahunPelajaran(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '<?php echo base_url("tahun_pelajaran/delete_tahun_pelajaran"); ?>/' + id,
                type: 'POST',
                success: function (response) {
                    if (response.status) {
                        alert('Data berhasil dihapus.');
                        loadTabelTahunPelajaran();
                    } else {
                        alert('Gagal menghapus data.');
                    }
                }
            });
        }
    }

    // Fungsi untuk mengedit data
    function editTahunPelajaran(id) {
        $.ajax({
            url: '<?php echo base_url("tahun_pelajaran/get_tahun_pelajaran"); ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    const data = response.data;
                    $('#id').val(data.id);
                    $('#nama_tahun_pelajaran').val(data.nama_tahun_pelajaran);
                    $('#tanggal_mulai').val(data.tanggal_mulai);
                    $('#tanggal_akhir').val(data.tanggal_akhir);
                    $('#status_tahun_pelajaran').val(data.status_tahun_pelajaran);
                    $('#modalTahunPelajaran').modal('show');
                } else {
                    alert('Gagal mengambil data.');
                }
            }
        });
    }
</script>
