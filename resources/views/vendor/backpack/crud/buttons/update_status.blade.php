@php
$baseUrl = url(config('backpack.base.route_prefix', 'admin').'/permohonan-informasi');
@endphp

@if ($entry->status !== 'sudah direspon')
<button class="btn btn-xs btn-warning update-status-btn" data-id="{{ $entry->id }}">
    <i class="la la-check"></i> Update Status
</button>
@endif

@if (!isset($renderedUpdateStatusModal))
@php $renderedUpdateStatusModal = true; @endphp

<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius:10px; overflow:hidden;">

            <div class="modal-body text-center py-4">

                {{-- ICON --}}
                <div class="mb-3">
                    <i class="la la-exclamation-circle" style="font-size:60px; color:#f8b84a;"></i>
                </div>

                {{-- JUDUL --}}
                <h4 class="font-weight-bold mb-2" style="color:#4a4a4a;">
                    Peringatan
                </h4>

                {{-- TEKS --}}
                <p class="mb-0" style="color:#777;">
                    Apakah Anda yakin ingin mengubah status ?
                </p>

            </div>

            <div class="modal-footer justify-content-center pb-4">

                <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border:1px solid #ddd;">
                    Batal
                </button>

                <button type="button" class="btn btn-success px-4" id="confirmUpdateStatus">
                    Ya
                </button>

            </div>

        </div>
    </div>
</div>

@endif


<script>
    if (typeof window.updateStatusInit === "undefined") {
        window.updateStatusInit = true;

        let selectedId = null;

        // ketika tombol di dalam datatable diklik
        $(document).on('click', '.update-status-btn', function() {
            selectedId = $(this).data('id');
            $('#updateStatusModal').modal('show');
        });

        // ketika klik konfirmasi
        $('#confirmUpdateStatus').click(function() {

            let url = "{{ url(config('backpack.base.route_prefix') . '/permohonan-informasi') }}/" +
                selectedId + "/update-status";

            $.post(url, {
                    _token: '{{ csrf_token() }}'
                })
                .done(function() {
                    new Noty({
                        type: 'success',
                        text: 'Status berhasil diperbarui!'
                    }).show();

                    $('#updateStatusModal').modal('hide');

                    crud.table.ajax.reload();
                })
                .fail(function() {
                    new Noty({
                        type: 'error',
                        text: 'Terjadi kesalahan saat update status.'
                    }).show();
                });
        });
    }
</script>