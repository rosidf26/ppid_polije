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

            <div class="container py-4">

                <div class="row">
                    <div class="col">
                        <section class="card card-admin">
								<header class="card-header">
									<h5 class="card-title mb-0">Lengkapi isian berikut!</h5>
								</header>
								<div class="card-body">
									<form class="form-horizontal form-bordered" method="get">

    <!-- Kategori Pemohon -->
    <div class="form-group row">
        <label class="col-lg-3 control-label text-lg-right pt-2">Kategori Pemohon</label>
        <div class="col-lg-6">

            <div class="radio">
                <label>
                    <input type="radio" name="kategori" value="perseorangan">
                    Perseorangan
                </label>
            </div>

            <div class="radio">
                <label>
                    <input type="radio" name="kategori" value="lembaga">
                    Lembaga
                </label>
            </div>

        </div>
    </div>

    <!-- Form Perseorangan -->
    <div id="form_perseorangan" class="category-form" style="display:none;">
                                        <div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Isi tentang Data Pemohon</label>
											<div class="col-lg-6">
												<div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-user"></i>
														</span>
													</span>
													<input type="text" name="nama_pemohon" class="form-control" placeholder="Nama Pemohon Lengkap Sesuai KTP">
												</div>
												<div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-location"></i>
														</span>
													</span>
													<input type="text" name="alamat_pemohon" class="form-control" placeholder="Alamat Pemohon Lengkap Sesuai KTP">
												</div>
                                                <div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-phone"></i>
														</span>
													</span>
													<input type="text" name="hp_pemohon" class="form-control" placeholder="No HP Pemohon">
												</div>
                                                 <div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-envelope"></i>
														</span>
													</span>
													<input type="email" name="email_pemohon" class="form-control" placeholder="Email Pemohon">
												</div>
                                                <div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-file"></i>
														</span>
													</span>
													<input type="file" name="ktp_pemohon" class="form-control" placeholder="Upload Identitas Pemohon">
                                                    <span class="help-block text-primary">(Silahkan scan / foto kartu identitas (KTP/SIM/Paspor) pemohon. Semua data pada kartu identitas harus tampak jelas dan terang)</span>
												</div>
											</div>
										</div>
                                           <div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Isi tentang Data Pengguna Informasi <div class="text-primary">(Abaikan Jika Data Pengguna sama dengan Data Pemohon)</div></label>
											<div class="col-lg-6">
												<div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-user"></i>
														</span>
													</span>
													<input type="text" name="nama_pemohon" class="form-control" placeholder="Nama Pengguna Informasi Lengkap Sesuai KTP">
												</div>
												<div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-location"></i>
														</span>
													</span>
													<input type="text" name="alamat_pemohon" class="form-control" placeholder="Alamat Pengguna Informasi Lengkap Sesuai KTP">
												</div>
                                                <div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-phone"></i>
														</span>
													</span>
													<input type="text" name="hp_pemohon" class="form-control" placeholder="No HP Pengguna Informasi">
												</div>
                                                 <div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-envelope"></i>
														</span>
													</span>
													<input type="email" name="email_pemohon" class="form-control" placeholder="Email Pengguna Informasi">
												</div>
                                                <div class="input-group mb-3">
													<span class="input-group-prepend">
														<span class="input-group-text">
															<i class="fas fa-file"></i>
														</span>
													</span>
													<input type="file" name="ktp_pengguna" class="form-control" placeholder="Upload Identitas Pengguna Informasi">
                                                    <span class="help-block text-primary">(Silahkan scan / foto kartu identitas (KTP/SIM/Paspor) pemohon. Semua data pada kartu identitas harus tampak jelas dan terang)</span>
												</div>
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="textareaInfoDibutuhkan">Informasi yang Dibutuhkan</label>
											<div class="col-lg-6">
												<textarea class="form-control" rows="3" id="textareaInfoDibutuhkan" name="info_dibutuhkan"></textarea>
											</div>
										</div>
                                         <div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="textareaAlasanButuh">Alasan Permohonan Informasi</label>
											<div class="col-lg-6">
												<textarea class="form-control" rows="3" id="textareaAlasanButuh" name="alasan_butuh"></textarea>
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Sumber Informasi</label>
											<div class="col-lg-6">
												<div class="radio">
                <label>
                    <input type="radio" name="sumber_info" value="pertanyaan" id="SumberInfo1">
                    Pertanyaan Langsung Pemohon
                </label>
            </div>

            <div class="radio">
                <label>
                    <input type="radio" name="sumber_info" value="website" id="SumberInfo2">
                    Website / Media Sosial Milik Polije
                </label>
            </div>

             <div class="radio">
                <label>
                    <input type="radio" name="sumber_info" value="medsos" id="SumberInfo3">
                    Website / Media Sosial Bukan Milik Polije
                </label>
            </div>
                                            

											</div>
										</div>

                                        <div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputALamatInfo">Alamat Sumber Informasi</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" id="inputALamatInfo" name="alamat_info">
                                                <span class="help-block text-primary">(Isikan tautan / alamat website jika pertanyaan bukan merupakan pertanyaan langsung pemohon)</span>
                                            </div>
										</div>
    </div>

    <!-- Form Lembaga -->
    <div id="form_lembaga" class="category-form" style="display:none;">
        <div class="form-group row">
            <label class="col-lg-3 control-label text-lg-right pt-2" for="inputRounded">
                Rounded Input
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control input-rounded" id="inputRounded">
            </div>
        </div>
    </div>

</form>

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

<script>
   document.addEventListener("DOMContentLoaded", function () {

    const formA = document.getElementById('form_perseorangan');
    const formB = document.getElementById('form_lembaga');

    document.querySelectorAll('input[name="kategori"]').forEach(radio => {
        radio.addEventListener('change', function () {

            if (this.value === 'perseorangan') {
                formA.style.display = 'block';
                formB.style.display = 'none';
            }

            if (this.value === 'lembaga') {
                formA.style.display = 'none';
                formB.style.display = 'block';
            }
        });
    });

});
</script>


    <!-- ini js -->
    @include('frontpage.templates.js')

</body>

</html>