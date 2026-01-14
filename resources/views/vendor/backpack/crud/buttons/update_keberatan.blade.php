
{{-- TOMBOL HANYA MUNCUL JIKA STATUS MASIH BELUM DIRESPON --}}
@if ($entry->status === 'belum direspon')
	<button class="btn btn-xs btn-warning update-keberatan-btn" data-id="{{ $entry->getKey() }}">
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
						Update Status Pernyataan Keberatan
					</h4>

					<div class="form-group text-left px-4">
						<!-- <label for="statusSelect" class="font-weight-bold"></label> -->
						<select id="statusSelect" class="form-control">
							<option value="">-- Pilih Status --</option>
							<option value="diterima">Diterima</option>
							<option value="ditolak">Ditolak</option>
						</select>
					</div>

					<div class="form-group text-left px-4">
						<label class="font-weight-bold"> Respon PPID: </label>
						<textarea id="respon" class="form-control" rows="3" placeholder="Masukkan respon..."></textarea>
					</div>

				</div>

				<div class="modal-footer justify-content-center pb-4">

					<button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border:1px solid #ddd;">
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
		(function waitForJquery() {
			if (typeof window.jQuery === 'undefined') {
				setTimeout(waitForJquery, 50);
				return;
			}

			// ===============================
			// jQuery SUDAH SIAP
			// ===============================
			jQuery(function ($) {

				if (typeof window.updateStatusInit !== "undefined") {
					return;
				}
				window.updateStatusInit = true;

				let selectedId = null;

				$(document).on('click', '.update-keberatan-btn', function () {
					selectedId = $(this).data('id');

					$('#statusSelect').val("");
					// $('#alasanDitolak').val("");
					// $('#alasanDitolakWrapper').addClass('d-none');

					$('#updateStatusModal').modal('show');
				});

				// $('#statusSelect').on('change', function() {
				// 	if ($(this).val() === 'ditolak') {
				// 		$('#alasanDitolakWrapper').removeClass('d-none');
				// 	} else {
				// 		$('#alasanDitolakWrapper').addClass('d-none');
				// 		$('#alasanDitolak').val('');
				// 	}
				// });

				$('#confirmUpdateStatus').on('click', function () {

					let status = $('#statusSelect').val();
					let respon = $('#respon').val();

					if (!status) {
						new Noty({
							type: 'warning',
							text: 'Silakan pilih status terlebih dahulu.'
						}).show();
						return;
					}

					// if (status === 'ditolak' && !alasanDitolak.trim()) {
					// 	new Noty({
					// 		type: 'warning',
					// 		text: 'Alasan penolakan wajib diisi.'
					// 	}).show();
					// 	return;
					// }

					$.ajax({
						url: "{{ url(config('backpack.base.route_prefix') . '/pernyataan-keberatan') }}/" +
							selectedId + "/update-status",
						type: "POST",
						data: {
							_token: "{{ csrf_token() }}",
							status: status,
							respon: respon
						},
						success: function () {
							new Noty({
								type: 'success',
								text: 'Status berhasil diperbarui!'
							}).show();

							$('#updateStatusModal').modal('hide');

							if (typeof crud !== 'undefined' && crud.table) {
								crud.table.ajax.reload(null, false);
							} else {
								location.reload();
							}
						},
						error: function () {
							new Noty({
								type: 'error',
								text: 'Terjadi kesalahan saat update status.'
							}).show();
						}
					});
				});

			});

		})(); 
	</script>

@endif