$(document).ready(function () {
    // Iterasi untuk setiap elemen dengan class "chainedSelect"
    $('.chainedSelect').each(function () {
        let $element = $(this); // Elemen dropdown saat ini
        let parentId = $element.data('parent'); // ID parent
        let target = $element.data('target'); // Nama target
        // let baseClass = $element.data('base-class') || ''; // Base URL

        if (parentId) {
            // Jika ada parent, tambahkan event change pada parent
            $('#' + parentId).change(function () {
                let parentValue = $(this).val(); // Nilai parent
                if (parentValue) {
                    // URL untuk memuat opsi
                    let url = baseClass + "/option_" + target + "/" + parentValue;

                    // Load opsi ke elemen target
                    $element.load(url, function () {
                        $element.trigger('change'); // Trigger event change setelah opsi dimuat
                    });
                } else {
                    // Kosongkan elemen jika parent kosong
                    $element.html('<option value="">-Pilih Jurusan</option>');
                }
            });
        } else {
            // Jika tidak ada parent, load opsi langsung saat halaman dimuat
            if (target) {
                let url = baseClass + "/option_" + target;
                $element.load(url, function () {
                    $element.trigger('change'); // Trigger event change setelah opsi dimuat
                });
            }
        }
    });
});