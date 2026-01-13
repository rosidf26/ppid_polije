@extends(backpack_view('layouts.top_left'))

@section('header')
    <section class="content-header">
        <div class="container-fluid">
            <h1>Dashboard Admin</h1>
            <small>Monitoring Layanan Informasi Publik</small>
        </div>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-6 col-xl-4">
            <section class="card card-featured-left card-featured-primary mb-4">
                <div class="card-body">
                    <div class="widget-summary widget-summary-md">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Permohonan Informasi Belum Direspon</h4>
                                <div class="info">
                                    <strong class="amount">{{ $permohonanBaru }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-lg-6 col-xl-4">
            <section class="card card-featured-left card-featured-success mb-4">
                <div class="card-body">
                    <div class="widget-summary widget-summary-md">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-success">
                                <i class="fas fa-hand-paper"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Pernyataan Keberatan Belum Direspon</h4>
                                <div class="info">
                                    <strong class="amount">{{ $keberatanMasuk }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-lg-6 col-xl-4">
            <section class="card card-featured-left card-featured-warning mb-4">
                <div class="card-body">
                    <div class="widget-summary widget-summary-md">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-warning">
                                <i class="fas fa-comment"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Komentar</h4>
                                <div class="info">
                                    <strong class="amount">{{ $komentarMasuk }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>

@endsection