$(document).ready(function() {
    $('.loadSelect').each(function() {
        let targetController = $(this).data('target');
        let url = baseClass + '/option_' + targetController;
        $(this).load(url);
    });

    $('.table').each(function() {
        let target = $(this).data('target');
        let table = $("#table_" + target);
        loadDataTable(table);
    });

    $("#check-all").click(function() {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });

    $(document).on('hidden.bs.modal', '.modal', function() {
        const modal = $(this);
        const form = modal.find('form')[0];

        if (form) {
            form.reset();
        }

        modal.find('.text-danger').text('');
        modal.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
    });
});

$(document).on("click", ".btnRefresh", function() {
    let target = $(this).data('target');
    let table = $("#table_" + target);
    reloadTable(table);
});

function reloadTable(el) {
    return el.DataTable().ajax.reload(null, false);
}

function initTable(el) {
    el.DataTable({
        "retrieve": true,
        "processing": true,
        "order": [],
        "columnDefs": []
    });
}

function loadDataTable(el, filter = '') {
    let ds = el.data("target");
    el.DataTable().destroy();
    el.DataTable({
        "retrieve": true,
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "scrollX": true,
        "ajax": {
            "url": baseClass + '/' + 'table_' + ds,
            "type": "POST",
            "data": function(data) {
                data.filter = filter;
            }
        },
        "columnDefs": [
            {
                "targets": [-1],
                "orderable": false
            }
        ],
        "fnDrawCallback": function() {}
    });
}

$(document).on('click', '.tambahBtn', function() {
    let targetController = $(this).data('target');
    $('#id').val('');
    $('#form_' + targetController).trigger('reset');
    $('#modal_' + targetController).modal('show');
});

$(document).on('click', '.saveBtn', function() {
    $('.text-danger').html('');
    $('input').removeClass('is-invalid');
    let targetController = $(this).data('target');
    let formElement = $('#form_' + targetController)[0];
    let table = $("#table_" + targetController);
    let formData = new FormData(formElement);

    $.ajax({
        url: baseClass + '/save_' + targetController,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                alert(response.message);
                $('#modal_' + targetController).modal('hide');
                reloadTable(table);
            } else {
                $('.text-danger').html('');
                $('input').removeClass('is-invalid').removeClass('is-valid');
                if (response.error) {
                    for (let prop in response.error) {
                        if (response.error[prop] !== '') {
                            $('#form_' + targetController + " [name=" + prop + "] ")
                                .addClass('is-invalid')
                                .next('.text-danger').html(response.error[prop]);
                        }
                    }
                }
            }
        }
    });
});

$(document).on('click', '.editBtn', function() {
    let targetController = $(this).data('target');
    let id = $(this).data('value');
    let url = baseClass + '/edit_' + targetController + '/' + id;
    let form = '#form_' + targetController;

    $.ajax({
        url: url,
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $.each(response.data, function(i, item) {
                    $(form + ' [name="' + i + '"]').val(item);
                });
                $('#modal_' + targetController).modal('show');
            } else {
                alert(response.message);
            }
        }
    });
});

$(document).on('click', '.detailBtn', function() {
    let targetController = $(this).data('target');
    let id = $(this).data('value');
    let url = baseClass + '/get_detail_' + targetController + '/' + id;

    $.ajax({
        url: url,
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                $.each(response.data, function(i, item) {
                    $('#detailModal [name="' + i + '"]').val(item);
                });
                $('#detailModal').modal('show');
            } else {
                alert(response.message);
            }
        }
    });
});

$(document).on('click', '.deleteBtn', function() {
    let targetController = $(this).data('target');
    let table = $("#table_" + targetController);
    let id = $(this).data('value');

    $.ajax({
        url: baseClass + '/delete_' + targetController,
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                alert(response.message);
                reloadTable(table);
            } else {
                alert(response.message);
            }
        }
    });
});

$(document).on('click', '#logoutBtn', function() {
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        $.ajax({
            url: 'login/logout',
            type: 'POST',
            success: function(response) {
                let res = JSON.parse(response);
                if (res.status) {
                    window.location.href = 'login';
                } else {
                    alert('Logout gagal. Silakan coba lagi.');
                }
            },
            error: function() {
                alert('Terjadi kesalahan. Tidak dapat logout.');
            }
        });
    }
});
