$(document).ready(function () {
    $('.chainedSelect').each(function () {
        let $element = $(this); // Elemen dropdown saat ini
        let parentId = $element.data('parent'); // ID parent dropdown
        let target = $element.data('target'); // Nama target

        if (parentId) {
            $('#' + parentId).change(function () {
                let parentValue = $(this).val(); // Nilai yang dipilih pada parent dropdown

                if (parentValue) {
                    // Buat URL untuk memuat opsi berdasarkan parentValue
                    let url = baseClass + "/option_" + target + "/" + parentValue;

                    // Debug URL untuk memastikan pembentukan URL benar
                    console.log("Loading from URL:", url);

                    // Load opsi ke elemen target
                    $element.load(url, function (response, status, xhr) {
                        if (status === "error") {
                            console.error("Error loading options:", xhr.status, xhr.statusText);
                            $element.html('<option value="">-Tidak Ada Opsi Tersedia-</option>');
                        } else {
                            $element.trigger('change'); // Trigger event change setelah opsi berhasil dimuat
                        }
                    });
                } else {
                    // Jika parent value kosong, kosongkan dropdown
                    console.log("Parent value kosong. Mengosongkan elemen target.");
                    $element.html('<option value="">-Pilih Opsi-</option>');
                }
            });
        } else {
            // Jika dropdown ini tidak memiliki parent, langsung load opsi dari target
            if (target) {
                let url = baseClass + "/option_" + target;

                console.log("Loading options from:", url);

                $element.load(url, function (response, status, xhr) {
                    if (status === "error") {
                        console.error("Error loading options:", xhr.status, xhr.statusText);
                        $element.html('<option value="">-Tidak Ada Opsi Tersedia-</option>');
                    } else {
                        $element.trigger('change'); // Trigger event change setelah opsi berhasil dimuat
                    }
                });
            }
        }
    });
});
