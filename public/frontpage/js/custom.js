// handle form komentar
$(document).ready(function() {
    $('#commentForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        let formData = $(this).serialize(); // Serialize form data

        $.ajax({
    url: "/kirim_komentar", // Your Laravel route for storing comments
    method: "POST",
    data: formData,
    // Menambahkan konfigurasi tambahan untuk penanganan error yang lebih baik (optional, tapi disarankan)
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Pastikan CSRF token terkirim
    },
    success: function(response) {
        // --- Custom Success Message ---
        // Asumsi server mengembalikan JSON seperti: {"success": true, "message": "Komentar berhasil ditambahkan!"}
        if(response.message) {
            $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
        } else {
            // Pesan default jika server tidak mengirim 'message'
            $('#responseMessage').html('<div class="alert alert-success">Operasi berhasil!</div>');
        }
        
        $('#commentForm')[0].reset(); // Clear the form
    },
    error: function(response) {
        // --- Custom Error Messages ---
        let errorHtml = '<div class="alert alert-danger">';

        // Cek jika server mengembalikan error validasi (status 422 Unprocessable Entity di Laravel)
        if (response.status === 422 && response.responseJSON && response.responseJSON.errors) {
            let errors = response.responseJSON.errors;
            errorHtml += '<ul>';
            for (let key in errors) {
                // Menampilkan pesan error validasi spesifik dari Laravel
                errorHtml += '<li>' + errors[key][0] + '</li>';
            }
            errorHtml += '</ul>';
        } 
        // Cek jika ada pesan error umum dari server (misal status 500 Internal Server Error)
        else if (response.responseJSON && response.responseJSON.message) {
            // Menampilkan pesan error kustom dari server (misal dari abort(500, 'Pesan Error Kustom'))
            errorHtml += '<p>' + response.responseJSON.message + '</p>';
        }
        // Pesan error umum (misal masalah koneksi)
        else {
            errorHtml += '<p>Terjadi kesalahan yang tidak diketahui. Mohon coba lagi.</p>';
        }
        
        errorHtml += '</div>';
        $('#responseMessage').html(errorHtml);
    }
});
    });
});