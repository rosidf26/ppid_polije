<!DOCTYPE html>
<html>

<head>
	<!-- ini head -->
	@include('frontpage.templates.head')
</head>

<body>

	<div class="body">
		<!-- ini header -->
		@include('frontpage.templates.header')

		<div role="main" class="main">

			<!-- ini header -->
			@include('frontpage.sections.page_header')

			<div class="container py-4 mb-4">

				<div class="row">
					<div class="col">

						<section class="card card-admin">
							<header class="card-header">
								<h5 class="card-title mb-0">Ringkasan Laporan Layanan Informasi Publik</h5>
							</header>

							<div class="card-body">
								<!-- Dropdown Tahun -->
								<form method="GET" class="form-horizontal form-bordered">
									<div class="form-group row">
										<label class="col-lg-3 control-label text-lg-right pt-2">Silahkan pilih tahun
											rekap</label>
										<div class="col-lg-6">
											<select name="tahun" class="form-control mb-3"
												onchange="this.form.submit()">
												@for ($i = 2020; $i <= date('Y'); $i++) <option value="{{ $i }}"
													{{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
													@endfor
											</select>
										</div>
									</div>
								</form>
								<!-- Tabel Rekap -->
								<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<thead class="text-center">
											<tr>
												<th>Bulan</th>
												<th>Jumlah Permohonan</th>
												<th>Rerata Waktu Menjawab (hari)</th>
												<th>Diterima</th>
												<th>Ditolak</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($bulan_list as $num => $nama)
											@php
											$d = $rekap->firstWhere('bulan', $num);
											@endphp
											<tr>
												<td>{{ $nama }}</td>
												<td>{{ $d->jumlah_permohonan ?? 0 }}</td>
												<td>{{ $d->rerata_menjawab ?? 0 }}</td>
												<td>{{ $d->diterima ?? 0 }}</td>
												<td>{{ $d->ditolak ?? 0 }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<hr>

								<!-- Grafik LINE -->
								<h4 class="mt-5">Rerata Waktu Menjawab</h4>
								<canvas id="lineChart"></canvas>

								<!-- Grafik BATANG -->
								<h4 class="mt-5">Permohonan Diterima vs Ditolak</h4>
								<canvas id="barChart"></canvas>

								<!-- Grafik DONUT -->
								<h4 class="mt-5">Jumlah Permohonan Informasi</h4>
								<canvas id="donutChart"></canvas>
							</div>

						</section>

					</div>
				</div>
			</div>

		</div>

	</div>

	<!-- ini footer -->
	@include('frontpage.templates.footer')
	</div>

{{-- Kirim data Chart ke file JS eksternal --}}
<script>
    window.REKAP_DATA = {
        labels: {!! json_encode($labels) !!},
        chart_rerata: {!! json_encode($chart_rerata) !!},
        chart_diterima: {!! json_encode($chart_diterima) !!},
        chart_ditolak: {!! json_encode($chart_ditolak) !!},
        chart_jumlah: {!! json_encode($chart_jumlah) !!}
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('frontpage/js/rekapitulasi.js') }}"></script>

	

	<!-- ini js -->
	@include('frontpage.templates.js')

</body>

</html>