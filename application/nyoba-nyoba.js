$(document).ready(function () {
    // Load select options
    $('.loadSelect').each(function () {
        let targetController = $(this).data('target');
        let url = baseClass + '/option_' + targetController;
        $(this).load(url);
    });

    // Initialize data tables
    $('.table').each(function () {
        let target = $(this).data('target');
        let table = $("#table_" + target);
        loadDataTable(table);
    });

    // Check-all functionality
    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });

    // Reset modal form on hide
    $(document).on('hidden.bs.modal', '.modal', function () {
        const modal = $(this);
        const form = modal.find('form')[0];
        if (form) form.reset(); // Reset form
        modal.find('.text-danger').text(''); // Clear error messages
        modal.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid'); // Clear validation classes
    });

    // Refresh table
    $(document).on("click", ".btnRefresh", function () {
        let target = $(this).data('target');
        let table = $("#table_" + target);
        reloadTable(table);
    });

    // Add new entry
    $(document).on('click', '.tambahBtn', function () {
        let targetController = $(this).data('target');
        $('#id').val('');
        $('#form_' + targetController).trigger('reset');
        $('#modal_' + targetController).modal('show');
    });

    // Save data
    $(document).on('click', '.saveBtn', function () {
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
            success: function (response) {
                if (response.status) {
                    alert(response.message);
                    $('#modal_' + targetController).modal('hide');
                    reloadTable(table);
                } else {
                    handleValidationErrors(response.error, targetController);
                }
            }
        });
    });

    // Edit data
    $(document).on('click', '.editBtn', function () {
        let targetController = $(this).data('target');
        let id = $(this).data('value');
        let url = baseClass + '/edit_' + targetController + '/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    populateForm(response.data, targetController);
                    $('#modal_' + targetController).modal('show');
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // View details
    $(document).on('click', '.detailBtn', function () {
        let targetController = $(this).data('target');
        let id = $(this).data('value');
        let url = baseClass + '/get_detail_' + targetController + '/' + id;

        $.ajax({
            url: url,
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    populateForm(response.data, 'detailModal');
                    $('#detailModal').modal('show');
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // Delete data
    $(document).on('click', '.deleteBtn', function () {
        let targetController = $(this).data('target');
        let table = $("#table_" + targetController);
        let id = $(this).data('value');

        $.ajax({
            url: baseClass + '/delete_' + targetController,
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    alert(response.message);
                    reloadTable(table);
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // Logout
    $(document).on('click', '#logoutBtn', function () {
        if (confirm('Apakah Anda yakin ingin keluar?')) {
            $.ajax({
                url: 'login/logout',
                type: 'POST',
                success: function (response) {
                    let res = JSON.parse(response);
                    if (res.status) {
                        window.location.href = 'login';
                    } else {
                        alert('Logout gagal. Silakan coba lagi.');
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan. Tidak dapat logout.');
                }
            });
        }
    });

    // Utility functions
    function reloadTable(el) {
        return el.DataTable().ajax.reload(null, false);
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
                "url": baseClass + '/table_' + ds,
                "type": "POST",
                "data": function (data) {
                    data.filter = filter;
                }
            },
            "columnDefs": [
                {
                    "targets": [-1],
                    "orderable": false,
                }
            ]
        });
    }

    function handleValidationErrors(errors, targetController) {
        for (let prop in errors) {
            if (errors[prop]) {
                $(`#form_${targetController} [name="${prop}"]`)
                    .addClass('is-invalid')
                    .next('.text-danger').html(errors[prop]);
            }
        }
    }

    function populateForm(data, targetController) {
        $.each(data, function (key, value) {
            $(`#form_${targetController} [name="${key}"]`).val(value);
        });
    }
});
