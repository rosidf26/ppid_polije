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
                                @if($errors->has('db_error'))
                                <div class="alert alert-danger justify-content-center text-center">
                                    {{ $errors->first('db_error') }}
                                </div>
                                @endif
                                <form class="form-horizontal form-bordered" method="POST"
                                    action="{{ route('permohonan.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    @if(session('success'))
                                    <div class="alert alert-success justify-content-center text-center">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    <!-- Kategori Pemohon -->
                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2">
                                            Kategori Pemohon
                                        </label>
                                        <div class="col-lg-6">

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="kategori" value="perseorangan"
                                                        {{ old('kategori') == 'perseorangan' ? 'checked' : '' }}>
                                                    Perseorangan
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="kategori" value="lembaga"
                                                        {{ old('kategori') == 'lembaga' ? 'checked' : '' }}>
                                                    Organisasi / Lembaga Masyarakat atau Yayasan atau Perusahaan
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Form Perseorangan -->
                                    <div id="form_perseorangan" class="category-form" style="display:none;">

                                        <!-- DATA PEMOHON -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                                Isi tentang Data Pemohon
                                            </label>
                                            <div class="col-lg-6">

                                                <!-- Nama Pemohon -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="nama_pemohon" class="form-control"
                                                        placeholder="Nama Pemohon Lengkap Sesuai KTP"
                                                        value="{{ old('nama_pemohon') }}">
                                                </div>
                                                @error('nama_pemohon')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- Alamat -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-location"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="alamat_pemohon" class="form-control"
                                                        placeholder="Alamat Pemohon Lengkap Sesuai KTP"
                                                        value="{{ old('alamat_pemohon') }}">
                                                </div>
                                                @error('alamat_pemohon')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- HP -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-phone"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="hp_pemohon" class="form-control"
                                                        placeholder="No HP Pemohon" value="{{ old('hp_pemohon') }}">
                                                </div>
                                                @error('hp_pemohon')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- Email -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-envelope"></i>
                                                        </span>
                                                    </span>
                                                    <input type="email" name="email_pemohon" class="form-control"
                                                        placeholder="Email Pemohon" value="{{ old('email_pemohon') }}">
                                                </div>
                                                @error('email_pemohon')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- KTP -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-file"></i>
                                                        </span>
                                                    </span>
                                                    <input type="file" name="ktp_pemohon" class="form-control">
                                                </div>
                                                <span class="help-block text-primary">
                                                    (Scan atau foto KTP/SIM/Paspor pemohon)
                                                </span>
                                                <br>
                                                @error('ktp_pemohon')
                                                <h6 class="text-danger mt-2 mb-0">{{ $message }}</h6>
                                                @enderror

                                                @if($errors->any())
                                                <small class="text-secondary">
                                                    Jika sebelumnya mengupload file, silakan upload ulang.
                                                </small>
                                                @endif
                                                <br>
                                            </div>
                                        </div>

                                        <!-- DATA PENGGUNA INFORMASI -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                                Isi tentang Data Pengguna Informasi
                                                <div class="text-primary">(Abaikan Jika Sama Dengan Pemohon)</div>
                                            </label>
                                            <div class="col-lg-6">

                                                <!-- Nama -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="nama_pengguna" class="form-control"
                                                        placeholder="Nama Pengguna Informasi"
                                                        value="{{ old('nama_pengguna') }}">
                                                </div>
                                                @error('nama_pengguna')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- Alamat -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-location"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="alamat_pengguna" class="form-control"
                                                        placeholder="Alamat Pengguna"
                                                        value="{{ old('alamat_pengguna') }}">
                                                </div>
                                                @error('alamat_pengguna')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- HP -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-phone"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="hp_pengguna" class="form-control"
                                                        placeholder="No HP Pengguna" value="{{ old('hp_pengguna') }}">
                                                </div>
                                                @error('hp_pengguna')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- Email -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-envelope"></i>
                                                        </span>
                                                    </span>
                                                    <input type="email" name="email_pengguna" class="form-control"
                                                        placeholder="Email Pengguna"
                                                        value="{{ old('email_pengguna') }}">
                                                </div>
                                                @error('email_pengguna')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- KTP -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-file"></i>
                                                        </span>
                                                    </span>
                                                    <input type="file" name="ktp_pengguna" class="form-control">
                                                </div>
                                                @error('ktp_pengguna')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror

                                                <span class="help-block text-primary">
                                                    (Scan atau foto KTP/SIM/Paspor pengguna)
                                                </span>

                                            </div>
                                        </div>

                                    </div> <!-- END Form Perseorangan -->


                                    <!-- Form Lembaga -->
                                    <div id="form_lembaga" class="category-form" style="display:none;">
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                                Isi tentang Data Organisasi
                                            </label>
                                            <div class="col-lg-6">

                                                <!-- Nama -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-building"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="nama_organisasi" class="form-control"
                                                        placeholder="Nama Organisasi"
                                                        value="{{ old('nama_organisasi') }}">
                                                </div>
                                                @error('nama_organisasi')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- Telp -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-phone"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="telp_organisasi" class="form-control"
                                                        placeholder="Telp Organisasi"
                                                        value="{{ old('telp_organisasi') }}">
                                                </div>
                                                @error('telp_organisasi')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- Email -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-envelope"></i>
                                                        </span>
                                                    </span>
                                                    <input type="email" name="email_organisasi" class="form-control"
                                                        placeholder="Email Organisasi"
                                                        value="{{ old('email_organisasi') }}">
                                                </div>
                                                @error('email_organisasi')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- Website / IG -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-share"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="medsos_organisasi" class="form-control"
                                                        placeholder="Website / IG Organisasi"
                                                        value="{{ old('medsos_organisasi') }}">
                                                </div>
                                                @error('medsos_organisasi')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror



                                            </div>

                                        </div>
                                        <!-- DATA NARAHUBUNG -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">
                                                Isi tentang Data Narahubung
                                            </label>
                                            <div class="col-lg-6">

                                                <!-- Nama -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="nama_narahubung" class="form-control"
                                                        placeholder="Nama Narahubung"
                                                        value="{{ old('nama_narahubung') }}">
                                                </div>
                                                @error('nama_narahubung')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- Telp -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-phone"></i>
                                                        </span>
                                                    </span>
                                                    <input type="text" name="telp_narahubung" class="form-control"
                                                        placeholder="No HP / Telpon Narahubung Organisasi"
                                                        value="{{ old('telp_narahubung') }}">
                                                </div>
                                                @error('telp_narahubung')
                                                <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror


                                                <!-- KTP -->
                                                <div class="input-group mb-1">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-file"></i>
                                                        </span>
                                                    </span>
                                                    <input type="file" name="ktp_narahubung" class="form-control">
                                                </div>
                                                <span class="help-block text-primary">
                                                    (Scan atau foto KTP/SIM/Paspor Narahubung)
                                                </span>
                                                @error('ktp_narahubung')
                                                <h6 class="text-danger mt-2 mb-0">{{ $message }}</h6>
                                                @enderror

                                                @if($errors->any())
                                                <small class="text-secondary">
                                                    Jika sebelumnya mengupload file, silakan upload ulang.
                                                </small>
                                                @endif
                                                <br>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="form_info" style="display:none;">
                                        <!-- ============================================ -->
                                        <!-- FORM INFORMASI (BERLAKU UNTUK KEDUA KATEGORI) -->
                                        <!-- ============================================ -->

                                        <!-- INFORMASI YANG DIBUTUHKAN -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Informasi yang
                                                Dibutuhkan</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" rows="3"
                                                    name="info_dibutuhkan">{{ old('info_dibutuhkan') }}</textarea>
                                                @error('info_dibutuhkan') <h6 class="text-danger mt-2">{{ $message }}
                                                </h6>@enderror
                                            </div>
                                        </div>

                                        <!-- ALASAN PERMOHONAN -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Alasan Permohonan
                                                Informasi</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" rows="3"
                                                    name="alasan_butuh">{{ old('alasan_butuh') }}</textarea>
                                                @error('alasan_butuh') <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- SUMBER INFORMASI -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Sumber
                                                Informasi</label>
                                            <div class="col-lg-6">

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sumber_info" value="pertanyaan"
                                                            {{ old('sumber_info') == 'pertanyaan' ? 'checked' : '' }}>
                                                        Pertanyaan Langsung Pemohon
                                                    </label>
                                                </div>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sumber_info" value="website"
                                                            {{ old('sumber_info') == 'website' ? 'checked' : '' }}>
                                                        Website / Media Sosial Milik Polije
                                                    </label>
                                                </div>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sumber_info" value="medsos"
                                                            {{ old('sumber_info') == 'medsos' ? 'checked' : '' }}>
                                                        Website / Media Sosial Bukan Milik Polije
                                                    </label>
                                                </div>

                                                @error('sumber_info') <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- ALAMAT SUMBER INFORMASI -->
                                        <div class="form-group row">
                                            <label class="col-lg-3 control-label text-lg-right pt-2">Alamat Sumber
                                                Informasi</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="alamat_info"
                                                    value="{{ old('alamat_info') }}">
                                                @error('alamat_info') <h6 class="text-danger mt-2">{{ $message }}</h6>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>


                                    <!-- TOMBOL (HANYA SATU) -->
                                    <div id="form_buttons" class="form-group row" style="display:none;">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"></label>
                                        <div class="col-lg-6 d-flex justify-content-between">
                                            <button type="submit" class="btn btn-success">Kirim</button>

                                            <button type="button" class="btn btn-dark" data-toggle="modal"
                                                data-target="#resetModal">
                                                Kosongkan Formulir
                                            </button>
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

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const formA = document.getElementById('form_perseorangan');
        const formB = document.getElementById('form_lembaga');
        const kategoriRadios = document.querySelectorAll('input[name="kategori"]');
        const sumberInfoRadios = document.querySelectorAll('input[name="sumber_info"]');
        const confirmResetBtn = document.getElementById('confirmReset');
        const formButtons = document.getElementById('form_buttons');
        const formInfo = document.getElementById('form_info');

        function disableLembagaFields(disabled) {
            document.querySelectorAll('#form_lembaga input, #form_lembaga textarea, #form_lembaga select')
                .forEach(el => {
                    el.disabled = disabled;
                });
        }

        function disablePeroranganFields(disabled) {
            document.querySelectorAll(
                    '#form_perseorangan input, #form_perseorangan textarea, #form_perseorangan select')
                .forEach(el => {
                    el.disabled = disabled;
                });
        }

        // Toggle form ketika klik kategori
        kategoriRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'perseorangan') {
                    formA.style.display = 'block';
                    formB.style.display = 'none';
                    formButtons.style.display = 'flex';
                    formInfo.style.display = 'block';
                    disableLembagaFields(true);
                    disablePeroranganFields(false);
                }

                if (this.value === 'lembaga') {
                    formA.style.display = 'none';
                    formB.style.display = 'block';
                    formButtons.style.display = 'flex';
                    formInfo.style.display = 'block';
                    disableLembagaFields(false);
                    disablePeroranganFields(true);
                }
            });
        });

        // Auto-show berdasarkan old()
        const oldKategori = "{{ old('kategori') }}";

        if (oldKategori === 'perseorangan') {
            document.querySelector('input[name="kategori"][value="perseorangan"]').checked = true;
            formA.style.display = 'block';
            formButtons.style.display = 'flex';
            formInfo.style.display = 'block';
            disableLembagaFields(true);
            disablePeroranganFields(false);
        }

        if (oldKategori === 'lembaga') {
            document.querySelector('input[name="kategori"][value="lembaga"]').checked = true;
            formB.style.display = 'block';
            formButtons.style.display = 'flex';
            formInfo.style.display = 'block';
            disableLembagaFields(false);
            disablePeroranganFields(true);

        }

        // RESET FORM PADA KONFIRMASI
        confirmResetBtn.addEventListener('click', function() {

            // 1. Reset semua input text/email/textarea
            document.querySelectorAll('input[type="text"], input[type="email"], textarea')
                .forEach(el => el.value = '');

            // 2. Reset file input
            document.querySelectorAll('input[type="file"]').forEach(el => el.value = '');

            // 3. Uncheck radio kategori
            kategoriRadios.forEach(r => r.checked = false);

            // 4. Uncheck Sumber Informasi
            sumberInfoRadios.forEach(r => r.checked = false);

            // 5. Hapus error message Laravel (Blade-generated)
            document.querySelectorAll('.text-danger').forEach(el => el.remove());

            // 6. Sembunyikan form kategori
            formA.style.display = 'none';
            formB.style.display = 'none';

            document.getElementById('form_buttons').style.display = 'none';
            document.getElementById('form_info').style.display = 'none';

            document.querySelectorAll('small.text-secondary').forEach(el => el.remove());

            // 7. Tutup modal Bootstrap
            $('#resetModal').modal('hide');
        });

    });
    </script>



    <!-- ini js -->
    @include('frontpage.templates.js')
    @include('frontpage.reset_blangko_info')
</body>

</html>