<!DOCTYPE html>
<html>

<head>
	@include('frontpage.templates.head')
</head>

<body>

	<div class="body">

		@include('frontpage.templates.header')

		<div role="main" class="main">

			@include('frontpage.sections.page_header')

			<div class="container py-4 mb-4">
				<div class="row">
					<div class="col">

						<section class="card card-admin">
							<header class="card-header">
								<h5 class="card-title mb-0">
									Ringkasan Laporan Pernyataan Keberatan Informasi Publik
								</h5>
							</header>

							<div class="card-body">

								{{-- ================= FILTER TAHUN --}}
								<form method="GET" class="form-horizontal form-bordered">
									<div class="form-group row">
										<label class="col-lg-3 control-label text-lg-right pt-2">
											Silahkan pilih tahun rekap
										</label>
										<div class="col-lg-6">
											<select name="tahun" class="form-control mb-3"
												onchange="this.form.submit()">
												@for ($i = 2020; $i <= date('Y'); $i++)
													<option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
														{{ $i }}
													</option>
												@endfor
											</select>
										</div>
									</div>
								</form>

								{{-- ================= TABEL REKAP --}}
								<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<thead class="text-center">
											<tr>
												<th>Bulan</th>
												<th>Jumlah Keberatan</th>
												<th>Rerata Waktu Menjawab (hari)</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($bulan_list as $num => $nama)
																					@php
																						$d = $rekap->firstWhere('bulan', $num);
																					@endphp
																					<tr>
																						<td>{{ $nama }}</td>
																						<td class="text-center">{{ $d->jumlah_keberatan ?? 0 }}</td>
																						<td class="text-center">
																							{{ $d && $d->rata_waktu !== null
												? number_format($d->rata_waktu, 2, ',', '.')
												: '-' }}
																						</td>
																					</tr>
											@endforeach
										</tbody>
									</table>
								</div>

								<hr>

								{{-- ================= GRAFIK --}}
								<h4 class="mt-5">Rerata Waktu Menjawab Keberatan</h4>
								<canvas id="lineChart"></canvas>

								<h4 class="mt-5">Persentase Permohonan Berujung Keberatan</h4>
								<canvas id="donutChart"></canvas>

								{{-- ================= ALASAN TERBANYAK --}}
								<h4 class="mt-5">Alasan Keberatan Terbanyak</h4>
								<ul>
									@forelse ($alasanTerbanyak as $item)
										<li>
											{{ $item->alasan_keberatan }}
											<span class="text-muted">
												({{ $item->total }} permohonan)
											</span>
										</li>
									@empty
										<li class="text-muted">Belum ada data keberatan</li>
									@endforelse
								</ul>

							</div>
						</section>

					</div>
				</div>
			</div>

		</div>
	</div>

	@include('frontpage.templates.footer')

	{{-- ================= DATA UNTUK CHART --}}
	<script>
		window.REKAP_DATA = {
			labels: {!! json_encode($labels) !!},
			chart_rerata: {!! json_encode($chart_rerata) !!},
			persentase_keberatan: {{ $persentaseKeberatan }}
    };
	</script>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="{{ asset('frontpage/js/rekap_keberatan.js') }}"></script>

	@include('frontpage.templates.js')

</body>

</html>