$(document).ready(function() {

	$('.table').each(function () {
		let target = $(this).data('target');
		loadTabel(target);
	});

	$('.loadSelect').each(function () {
		let targetController = $(this).data('target');
		// $('#id_' + targetController)
		let url = baseClass + '/option_' + targetController;
		$(this).load(url);

	});



})

$(document).on('click', '.tambahBtn', function(){
	var targetController = $(this).data('target');
	$('#id').val('');
	
	$('#form_' + targetController).trigger('reset');
	$('#modal_' + targetController).modal('show');

})

function loadTabel(target) {
	let table = $('#table_' + target);
	let url = baseClass + '/table_' + target;
	let tr = '';
	let th = '';
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		success: function (response) {
			if (response.status) {
				generateTable(response.data, target);
			} else {
				tr = $('<tr>');
				table.find('tbody').html('');
				th = table.find('thead th').length;
				tr.append('<td colspan="' + th + '"> <h4>' + response.message + '</h4></td>');
			}
		}
	});
}


function generateTable(data, target) {
	const $table = $(`#table_${target}`);
	const $thead = $table.find('thead th');
	const $tbody = $table.find('tbody');

	let rows = "";

	data.forEach((item, index) => {
		let row = "<tr>";

		$thead.each(function () {
			const key = $(this).data('key');

			if (key === "no") {
				// nomor urut
				row += `<td style="${$(this).attr('style')}">${index + 1}</td>`;
			} else if (key === "btn_aksi") {
				// aksi
				row += `
					<td style="${$(this).attr('style')}">
						<button class="btn btn-primary editBtn" data-id="${item.id}" data-target="${target}" >Edit</button>
						<button class="btn btn-danger deleteBtn" data-id="${item.id}" data-target="${target}" >Delete</button>
					</td>`;
			} else {
				// lainnya
				row += `<td style="${$(this).attr('style')}">${item[key] || '-'}</td>`;
			}
		});

		row += "</tr>";
		rows += row;
	});

	$tbody.html(rows);
}


$(document).on('click', '.saveBtn', function()  {
	$('.error-block').html('');
	$('input').removeClass('is-invalid');
	var targetController = $(this).data('target');
	var formData = new FormData($('#form_' + targetController)[0]);
	$.ajax({
		url: baseClass +'/save_' + targetController,
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		dataType: 'json',
		success: function(response) {
			if (response.status) {
				alert(response.message);
				$('#modal_' + targetController).modal('hide');
				loadTabel(targetController);

			} else {
				if (response.error) {
					for (var prop in response.error) {
						if (response.error[prop] !== '') {
							$('#form_' + targetController + " [name= " + prop + "] ").addClass('is-invalid').next('div .error-block').html(response.error[prop]);
						}
					}
				} else {
					
				}
			}
		}

	})
})

$(document).on('click', '.editBtn', function() {
	let targetController = $(this).data('target');
	let id = $(this).data('id');
	let url = baseClass +'/edit_' + targetController + '/' + id;
	let form = '#form_' + targetController;
	$.ajax({
		url: url,
		type: 'POST',
		data: {
			id: id
		},
		dataType: 'json',
		success: function(response) {
			if (response.status) {
				$.each(response.data, function (i, item) {
					$(form + ' [name="' + i + '"]').val(item);
				});


				$('#modal_' + targetController).modal('show');
			} else {
				alert(response.message);
			}
		}

	})
});


$(document).on('click', '.deleteBtn', function() {
	var targetController = $(this).data('target');
	var id = $(this).data('id');
	$.ajax({
		url: baseClass +'/delete_' + targetController,
		type: 'POST',
		data: {
			id: id
		},
		dataType: 'json',
		success: function(response) {
			if (response.status) {
				alert(response.message);
				loadTabel(targetController);
			} else {
				alert(response.message);
			}
		}

	})
})


$(document).on('click', '#logoutBtn', function() {
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