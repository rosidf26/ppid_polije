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

                        <form method="POST" action="{{ route('permohonan.cek-status.result') }}">
                            @csrf

                            <div class="form-group">
                                <label><strong>Nomor Permohonan</strong></label>
                                <input type="text" name="unik_request"
                                    class="form-control @error('unik_request') is-invalid @enderror"
                                    placeholder="Masukkan Nomor Permohonan, Contoh: REQ-20250101123000-ABC123" value="{{ old('unik_request') }}"
                                    required>

                                @error('unik_request')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success mt-2">
                                Cek Status
                            </button>
                        </form>
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