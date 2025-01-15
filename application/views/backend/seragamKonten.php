<div class="row">
    <div class="col-12">
        <!-- Nav Tabs -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Seragam</h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="seragamTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="jenisSeragamTab" data-toggle="tab" href="#jenisSeragam" role="tab" aria-controls="jenisSeragam" aria-selected="true">Jenis Seragam</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="stokSeragamTab" data-toggle="tab" href="#stokSeragam" role="tab" aria-controls="stokSeragam" aria-selected="false">Stok Seragam</a>
                    </li>
                </ul>
                <div class="tab-content" id="seragamTabContent">
                    <!-- Tab Content for Jenis Seragam -->
                    <div class="tab-pane fade show active" id="jenisSeragam" role="tabpanel" aria-labelledby="jenisSeragamTab">
                        <div class="btn btn-primary btnTambah mb-2"> <i class="fas fa-plus"></i> Tambah</div>
                        <div class="row">
                            <table class="table table-striped" id="tabelJenisSeragam">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Seragam</th>
										<th>Ukuran</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tab Content for Stok Seragam -->
                    <div class="tab-pane fade" id="stokSeragam" role="tabpanel" aria-labelledby="stokSeragamTab">
						<div class="btn btn-primary btnTambahStok mb-2"><i class="fas fa-plus"></i> Tambah Stok</div>
                        <div class="row">
                            <table class="table table-striped" id="tabelStokSeragam">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Seragam</th>
                                        <th>Stok</th>
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
    </div>
</div>

<!-- Modal Tambah/Edit Seragam -->
<div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah/Edit Seragam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-user">
                    <form id="formSeragam" action="#" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="id" name="id" value="">
                        <div class="mb-1">
                            <label for="jenis_seragam" class="form-label">Jenis Seragam</label>
                            <input type="text" class="form-control" id="jenis_seragam" name="jenis_seragam" value="">
                            <div class="error-block"></div>
                        </div>

                        <div class="mb-1">
                            <label for="ukuran_seragam" class="form-label">Ukuran</label>
                            <input type="text" class="form-control" id="ukuran_seragam" name="ukuran_seragam" value="">
                            <div class="error-block"></div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveBtn">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        tabelJenisSeragam();
        tabelStokSeragam();
    });

    function tabelJenisSeragam() {
        let tabel = $('#tabelJenisSeragam');
        let tr = '';
        $.ajax({
            url: '<?php echo base_url('seragam/table_jenis_seragam'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    tabel.find('tbody').html('');
                    let no = 1;
                    $.each(response.data, function(i, item) {
                        tr = $('<tr>');
                        tr.append('<td>' + no++ + '</td>');
                        tr.append('<td>' + item.jenis_seragam + '</td>');
                        tr.append('<td>' + item.ukuran_seragam + '</td>');
                        tr.append('<td>' + item.jumlah_seragam + '</td>');
                        tr.append('<td><button class="btn btn-primary" onclick="editSeragam(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteSeragam(' + item.id + ')">Delete</button></td>');
                        tabel.find('tbody').append(tr);
                    });
                } else {
                    tr = $('<tr>');
                    tabel.find('tbody').html('');
                    tr.append('<td colspan="5">' + response.message + '</td>');
                }
            }
        });
    }

    function tabelStokSeragam() {
        let tabel = $('#tabelStokSeragam');
        let tr = '';
        $.ajax({
            url: '<?php echo base_url('seragam/table_stok_seragam'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    tabel.find('tbody').html('');
                    let no = 1;
                    $.each(response.data, function(i, item) {
                        tr = $('<tr>');
                        tr.append('<td>' + no++ + '</td>');
                        tr.append('<td>' + item.jenis_seragam + '</td>');
                        tr.append('<td>' + item.ukuran_seragam + '</td>');
                        tr.append('<td>' + item.stok_seragam + '</td>');
                        tr.append('<td><button class="btn btn-primary" onclick="editSeragam(' + item.id + ')">Edit</button> <button class="btn btn-danger" onclick="deleteSeragam(' + item.id + ')">Delete</button></td>');
                        tabel.find('tbody').append(tr);
                    });
                } else {
                    tr = $('<tr>');
                    tabel.find('tbody').html('');
                    tr.append('<td colspan="5">' + response.message + '</td>');
                }
            }
        });
    }

    $('.btnTambah').click(function() {
        $('#id').val('');
        $('#formSeragam').trigger('reset');
        $('#modal').modal('show');
    });

    $('.saveBtn').click(function() {
        $.ajax({
            url: '<?php echo base_url('seragam/save'); ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                jenis_seragam: $('#jenis_seragam').val(),
                ukuran_seragam: $('#ukuran_seragam').val(),
            },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    alert(response.message);
                    $('#modal').modal('hide');
                    tabelJenisSeragam();
                    tabelStokSeragam();
                } else {
                    alert(response.message);
                }
            }
        });
    });
	$('.btn-secondary').click(function(){
		$('#modal').modal('hide');
	});

    function editSeragam(id) {
        $.ajax({
            url: '<?php echo base_url('seragam/edit'); ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $('#id').val(response.data.id);
                    $('#jenis_seragam').val(response.data.jenis_seragam);
                    $('#ukuran_seragam').val(response.data.ukuran_seragam);
                    $('#modal').modal('show');
                } else {
                    alert(response.message);
                }
            }
        });
    }

    function deleteSeragam(id) {
        $.ajax({
            url: '<?php echo base_url('seragam/delete'); ?>',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    alert(response.message);
                    tabelJenisSeragam();
                    tabelStokSeragam();
                } else {
                    alert(response.message);
                }
            }
        });
    }
</script>
