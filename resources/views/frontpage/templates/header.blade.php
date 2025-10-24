<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 120, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-color-primary header-body-bottom-border">
        <div class="header-top header-top-default border-bottom-0">
            <div class="container">
                <div class="header-row py-2">
                    <div class="header-column justify-content-start">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills text-uppercase text-2">
                                    <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                        <a class="nav-link pl-0" href="about-us.html"><i class="fas fa-angle-right"></i> Hubungi Kami</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a href="mailto:mail@domain.com"><i class="far fa-envelope text-4 text-color-primary" style="top: 1px;"></i> mail@domain.com</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="tel:123-456-7890"><i class="fab fa-whatsapp text-4 text-color-primary" style="top: 0;"></i> 123-456-7890</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="{{ url('/') }}">
                                <img alt="Porto" width="130" height="50" src="{{ url('frontpage/img/logo.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav header-nav-links order-2 order-lg-1">
                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle active" href="{{ url('/') }}">
                                                BERANDA
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#">
                                                TENTANG KAMI
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ url('sambutan-direktur') }}">SAMBUTAN DIREKTUR</a></li>
                                                <li><a class="dropdown-item" href="{{ url('profil-polije') }}">PROFIL POLIJE</a></li>
                                                <li><a class="dropdown-item" href="https://polije.ac.id/" target="_blank">LAMAN POLIJE</a></li>
                                                <li><a class="dropdown-item" href="{{ url('profil-ppid-polije') }}">PROFIL PPID</a></li>
                                                <li><a class="dropdown-item" href="{{ url('tugas-dan-fungsi-ppid-polije') }}">TUGAS & FUNGSI PPID</a></li>
                                                <li><a class="dropdown-item" href="#footer">KONTAK KAMI</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#">
                                                E-BLANGKO
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="page-custom-header.html">PERMOHONAN INFOMARSI</a></li>
                                                <li><a class="dropdown-item" href="page-careers.html">PERNYATAAN KEBERATAN</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#">
                                                INFORMASI PUBLIK
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ url('regulasi') }}">REGULASI</a></li>
                                                <li><a class="dropdown-item" href="{{ url('daftar-informasi-publik') }}">DAFTAR INFORMASI PUBLIK</a></li>
                                                <li><a class="dropdown-item" href="{{ url('informasi-yang-dikecualikan') }}">INFORMASI YANG DIKECUALIKAN</a></li>
                                                <li><a class="dropdown-item" href="{{ url('informasi-setiap-saat') }}">INFORMASI SETIAP SAAT</a></li>
                                                <li><a class="dropdown-item" href="{{ url('informasi-berkala') }}">INFORMASI BERKALA</a></li>
                                                <li><a class="dropdown-item" href="{{ url('informasi-serta-merta') }}">INFORMASI SERTA MERTA</a></li>
                                                <li><a class="dropdown-item" href="{{ url('rekapitulasi-permohonan-informasi-publik') }}">REKAPITULASI PERMOHONAN INFORMASI PUBLIK</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#">
                                                LAYANAN INFORMASI
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ url('maklumat-pelayanan') }}">MAKLUMAT PELAYANAN</a></li>
                                                <li><a class="dropdown-item" href="{{ url('standar-pelayanan') }}">STANDAR PELAYANAN</a></li>
                                                <li><a class="dropdown-item" href="{{ url('biaya-layanan') }}">BIAYA LAYANAN</a></li>
                                                <li><a class="dropdown-item" href="{{ url('prosedur-permohonan') }}">PROSEDUR PERMOHONAN</a></li>
                                                <li><a class="dropdown-item" href="{{ url('prosedur-pengajuan-keberatan') }}">PROSEDUR PENGAJUAN KEBERATAN</a></li>
                                                <li><a class="dropdown-item" href="{{ url('prosedur-penyelesaian-sengketa') }}">PROSEDUR PENYELESAIAN SENGKETA</a></li>
                                                <li><a class="dropdown-item" href="https://aduanitjen.kemdiktisaintek.go.id/" target="_blank">PERMOHONAN INFORMASI</a></li>
                                                <li><a class="dropdown-item" href="https://persuratan.kemdikbud.go.id/login/jejaksurat" target="_blank">JEJAK SURAT</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="#">
                                                PUBLIKASI
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ url('berita') }}">BERITA</a></li>
                                                <li><a class="dropdown-item" href="{{ url('pengumuman') }}">PENGUMUMAN</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="{{ url('faq') }}">
                                                FAQ
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>