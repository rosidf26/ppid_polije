<button type="button" class="btn btn-default" id="refresh-datatable-btn">
    <i class="la la-refresh"></i> Refresh Data
</button>

<script>
    if (typeof window.refreshDatatableInit === 'undefined') {
        window.refreshDatatableInit = true;

        document.addEventListener('click', function(e) {
            if (e.target && e.target.id === 'refresh-datatable-btn') {

                // pastikan CRUD table tersedia
                if (typeof crud !== 'undefined' && crud.table) {

                    crud.table.ajax.reload(null, false);

                    // Noty tanpa jQuery
                    new Noty({
                        type: 'info',
                        text: 'Tabel diperbarui!'
                    }).show();
                }
            }
        });
    }
</script>