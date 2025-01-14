<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kelas</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btnTambahKelas mb-2">
                    <i class="fas fa-plus"></i> Tambah
                </button>
                <table class="table table-striped" id="tabelKelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
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

<div class="modal" id="modalKelas" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kelas</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formKelas" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id" name="id" value="">

                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_tahun_pelajaran" name="nama_tahun_pelajaran">
                        <div class="error-block"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                        <div class="error-block"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                        <div class="error-block"></div>
                    </div>
                    <div class="mb-3">
                        <label for="status_kelas" class="form-label">Status</label>
                        <select class="form-control" id="status_kelas" name="status_kelas">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        <div class="error-block"></div>
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
        loadTabelKelas();
    });

    function loadTabelKelas() {
        let tabelKelas = $('#tabelKelas tbody');
        tabelKelas.html('');

        $.ajax({
            url: '<?php echo base_url("kelas/table_kelas"); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    let no = 1;
                    response.data.forEach(function (item) {
                        let row = `
                            <tr>
                                <td>${no++}</td>
                                <td>${item.nama_tahun_pelajaran}</td>
                                <td>${item.status_tahun_pelajaran === "1" ? "Aktif" : "Tidak Aktif"}</td>
                                <td>
                                    <button class="btn btn-primary" onclick="editKelas(${item.id})">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteKelas(${item.id})">Delete</button>
                                </td>
                            </tr>`;
                        tabelKelas.append(row);
                    });
                } else {
                    tabelKelas.html('<tr><td colspan="4" class="text-center">' + response.message + '</td></tr>');
                }
            },
            error: function () {
                tabelKelas.html('<tr><td colspan="4" class="text-center">Error loading data.</td></tr>');
            }
        });
    }

    $('.btnTambahKelas').click(function () {
        $('#formKelas')[0].reset();
        $('#modalKelas').modal('show');
    });

    $('.saveBtn').click(function () {
        let formData = $('#formKelas').serialize();
        $.post('<?php echo base_url("kelas/save"); ?>', formData, function (response) {
            if (response.status) {
                alert(response.message);
                $('#modalKelas').modal('hide');
                loadTabelKelas();
            } else {
                alert(response.message);
            }
        }, 'json');
    });

    function editKelas(id) {
        $.get('<?php echo base_url("kelas/get"); ?>/' + id, function (response) {
            if (response.status) {
                $('#id').val(response.data.id);
                $('#nama_tahun_pelajaran').val(response.data.nama_tahun_pelajaran);
                $('#tanggal_mulai').val(response.data.tanggal_mulai);
                $('#tanggal_akhir').val(response.data.tanggal_akhir);
                $('#status_kelas').val(response.data.status_kelas);
                $('#modalKelas').modal('show');
            } else {
                alert(response.message);
            }
        }, 'json');
    }

    function deleteKelas(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.post('<?php echo base_url("kelas/delete"); ?>', { id: id }, function (response) {
                if (response.status) {
                    alert(response.message);
                    loadTabelKelas();
                } else {
                    alert(response.message);
                }
            }, 'json');
        }
    }
</script>
