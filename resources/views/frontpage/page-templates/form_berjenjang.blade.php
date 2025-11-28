@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Form Kategori Pemohon</h3>

    {{-- Radio Button --}}
    <div class="form-group">
        <label><strong>Kategori Pemohon:</strong></label><br>

        <label>
            <input type="radio" name="kategori" value="perseorangan"> Perseorangan
        </label>

        &nbsp;&nbsp;

        <label>
            <input type="radio" name="kategori" value="lembaga"> Lembaga
        </label>
    </div>

    <hr>

    {{-- ====================== --}}
    {{-- FORM A : PERSEORANGAN --}}
    {{-- ====================== --}}
    <div id="form_perseorangan" style="display:none;">
        <h4>Form A - Data Perseorangan</h4>

        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" class="form-control" name="nama_lengkap">
        </div>

        <div class="form-group">
            <label>NIK:</label>
            <input type="text" class="form-control" name="nik">
        </div>

        <div class="form-group">
            <label>Alamat:</label>
            <textarea class="form-control" name="alamat"></textarea>
        </div>
    </div>

    {{-- ================= --}}
    {{-- FORM B : LEMBAGA --}}
    {{-- ================= --}}
    <div id="form_lembaga" style="display:none;">
        <h4>Form B - Data Lembaga</h4>

        <div class="form-group">
            <label>Nama Lembaga:</label>
            <input type="text" class="form-control" name="nama_lembaga">
        </div>

        <div class="form-group">
            <label>Nomor Registrasi / NPWP:</label>
            <input type="text" class="form-control" name="no_registrasi">
        </div>

        <div class="form-group">
            <label>Alamat Kantor:</label>
            <textarea class="form-control" name="alamat_kantor"></textarea>
        </div>

        <div class="form-group">
            <label>Penanggung Jawab:</label>
            <input type="text" class="form-control" name="penanggung_jawab">
        </div>
    </div>

</div>
@endsection


@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const radioButtons = document.querySelectorAll('input[name="kategori"]');
        const perseorangan = document.getElementById('form_perseorangan');
        const lembaga = document.getElementById('form_lembaga');

        radioButtons.forEach(function(radio) {
            radio.addEventListener('change', function() {

                if (this.value === "perseorangan") {
                    perseorangan.style.display = "block";
                    lembaga.style.display = "none";
                } else if (this.value === "lembaga") {
                    perseorangan.style.display = "none";
                    lembaga.style.display = "block";
                }

            });
        });

    });
</script>
@endsection
