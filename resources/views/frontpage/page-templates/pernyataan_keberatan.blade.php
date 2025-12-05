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
                  action="{{ route('keberatan.store') }}" enctype="multipart/form-data">
                  @csrf
                  @if(session('success'))
                  <div class="alert alert-success justify-content-center text-center">
                    {{ session('success') }}
                  </div>
                  @endif

                  <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">Nama Pemohon</label>
                    <div class="col-lg-6">
                      <input type="text" class="form-control" name="nama_pemohon"
                        value="{{ old('nama_pemohon') }}">
                      @error('nama_pemohon') <h6 class="text-danger mt-2">{{ $message }}</h6>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">Pekerjaan
                      Pemohon</label>
                    <div class="col-lg-6">
                      <input type="text" class="form-control" name="pekerjaan_pemohon"
                        value="{{ old('pekerjaan_pemohon') }}">
                      @error('pekerjaan_pemohon') <h6 class="text-danger mt-2">{{ $message }}</h6>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">Nama Kuasa
                      Pemohon</label>
                    <div class="col-lg-6">
                      <input type="text" class="form-control" name="nama_kuasa_pemohon"
                        value="{{ old('nama_kuasa_pemohon') }}">
                      @error('nama_kuasa_pemohon') <h6 class="text-danger mt-2">{{ $message }}
                      </h6>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">Alasan Pengajuan
                      Keberatan</label>
                    <div class="col-lg-6">
                      <select class="form-control mb-3" name="alasan_keberatan">
                        <option value="">-- Pilih Alasan --</option>

                        @foreach($alasan_keberatan as $item)
                        <option value="{{ $item }}"
                          {{ old('alasan_keberatan') == $item ? 'selected' : '' }}>
                          {{ $item }}
                        </option>
                        @endforeach
                      </select>
                      @error('alasan_keberatan') <h6 class="text-danger mt-2">{{ $message }}
                      </h6>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-lg-3 control-label text-lg-right pt-2">Kasus Posisi</label>
                    <div class="col-lg-6">
                      <textarea class="form-control" rows="3"
                        name="kasus_posisi">{{ old('kasus_posisi') }}</textarea>
                      @error('kasus_posisi') <h6 class="text-danger mt-2">{{ $message }}
                      </h6>@enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <!-- LEFT SIDE LABEL (kosong tapi tetap berukuran col-lg-3) -->
                    <label class="col-lg-3 control-label text-lg-right pt-2"></label>

                    <!-- RIGHT SIDE BUTTONS -->
                    <div class="col-lg-6 d-flex justify-content-between align-items-center">

                      <button type="submit" class="btn btn-primary">
                        Kirim
                      </button>

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

      const confirmResetBtn = document.getElementById('confirmReset');
      // RESET FORM PADA KONFIRMASI
      confirmResetBtn.addEventListener('click', function() {

        // 1. Reset semua input text/email/textarea
        document.querySelectorAll('input[type="text"], input[type="email"], textarea')
          .forEach(el => el.value = '');

        // 3. Uncheck radio kategori
        document.querySelectorAll('select')
          .forEach(select => select.selectedIndex = 0);

        // 5. Hapus error message Laravel (Blade-generated)
        document.querySelectorAll('.text-danger').forEach(el => el.remove());

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