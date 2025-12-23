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
                                <h5 class="card-title mb-0">Masukkan <b>Nomor Permohonan Informasi</b> yang
                                    telah Anda ajukan.</h5>
                            </header>
                            <div class="card-body">
                                <form method="POST" action="{{ route('permohonan.hasil-cari') }}">
                                    @csrf
                                    <div class="justify-content-center text-center">
                                        @if ($errors->has('not_found'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('not_found') }}
                                            </div>
                                        @endif

                                        @if ($errors->has('status'))
                                            <div class="alert alert-warning">
                                                {{ $errors->first('status') }}
                                            </div>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Permohonan</label>
                                        <input type="text" name="unik_request"
                                            class="form-control @error('unik_request') is-invalid @enderror"
                                            value="{{ old('unik_request') }}"
                                            placeholder="Contoh: REQ-20250101123000-ABC123" required>
                                        @error('unik_request')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email Pemohon / Organisasi</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button class="btn btn-success">Lanjutkan</button>
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
    <!-- ini js -->
    @include('frontpage.templates.js')
</body>

</html>