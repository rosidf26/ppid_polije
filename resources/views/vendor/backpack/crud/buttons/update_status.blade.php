@php
$baseUrl = url(config('backpack.base.route_prefix', 'admin').'/permohonan-informasi');
@endphp

{{-- TOMBOL HANYA MUNCUL JIKA STATUS MASIH BELUM DIRESPON --}}
@if ($entry->status === 'belum direspon')
<button class="btn btn-xs btn-warning update-status-btn" data-id="{{ $entry->id }}">
    <i class="la la-check"></i> Update Status
</button>
@endif


{{-- MODAL (ditampilkan sekali saja) --}}
@if (!isset($renderedUpdateStatusModal))
@php $renderedUpdateStatusModal = true; @endphp

<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius:10px; overflow:hidden;">

            <div class="modal-body text-center py-4">

                <div class="mb-3">
                    <i class="la la-info-circle" style="font-size:60px; color:#4a90e2;"></i>
                </div>

                <h4 class="font-weight-bold mb-3" style="color:#4a4a4a;">
                    Update Status Permohonan
                </h4>

                <div class="form-group text-left px-4">
                    <label for="statusSelect" class="font-weight-bold">Respon:</label>
                    <select id="statusSelect" class="form-control">
                        <option value="">-- Pilih Status --</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

            </div>

            <div class="modal-footer justify-content-center pb-4">

                <button type="button" class="btn btn-light px-4" data-dismiss="modal"
                        style="border:1px solid #ddd;">
                    Batal
                </button>

                <button type="button" class="btn btn-success px-4" id="confirmUpdateStatus">
                    Update
                </button>

            </div>

        </div>
    </div>
</div>

@endif


{{-- SCRIPT (ditampilkan sekali saja) --}}
@if (!isset($renderedUpdateStatusScript))
@php $renderedUpdateStatusScript = true; @endphp

<script>
if (typeof window.updateStatusInit === "undefined") {
    window.updateStatusInit = true;

   let selectedId;

$(document).on('click', '.update-status-btn', function() {
    selectedId = $(this).data('id');
    $('#statusSelect').val(""); // reset dropdown
    $('#updateStatusModal').modal('show');
});

$('#confirmUpdateStatus').click(function() {

    let status = $('#statusSelect').val();

    if (!status) {
        new Noty({
            type: 'warning',
            text: 'Silakan pilih status terlebih dahulu.'
        }).show();
        return;
    }

    $.ajax({
        url: "{{ url(config('backpack.base.route_prefix').'/permohonan-informasi') }}/" 
             + selectedId + "/update-status",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            status: status
        },
        success: function() {
            new Noty({
                type: 'success',
                text: 'Status berhasil diperbarui!'
            }).show();

            $('#updateStatusModal').modal('hide');

            crud.table.ajax.reload();
        },
        error: function() {
            new Noty({
                type: 'error',
                text: 'Terjadi kesalahan saat update status.'
            }).show();
        }
    });

});

}
</script>

@endif
