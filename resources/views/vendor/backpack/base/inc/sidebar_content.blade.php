<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

@can('lihat dashboard')
    <li><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fas fa-home" area-hidden="true"></i>
            {{ trans('backpack::base.dashboard') }}</a></li>
@endcan
@can('kelola pengguna')
    <li><a class="nav-link" href="{{ backpack_url('user') }}"><i class="fas fa-users" area-hidden="true"></i> Pengguna</a>
    </li>
@endcan
@can('kelola akses')
    <li><a class="nav-link" href="{{ backpack_url('role') }}"><i class="fas fa-code" area-hidden="true"></i> Wewenang</a>
    </li>
    <li><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="fas fa-key" area-hidden="true"></i> Izin
            Akses</a></li>
@endcan
@can('ubah halaman')
    <li><a class="nav-link" href="{{ backpack_url('page') }}"><i class="fas fa-pager" area-hidden="true"></i>
            <span>Halaman</span></a></li>
@endcan

@can('kelola konten')
    <li><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="fas fa-cube" area-hidden="true"></i>
            <span>Menu</span></a></li>
    <li><a class="nav-link" href="{{ backpack_url('elfinder') }}" target="_blank"><i class="fas fa-file"
                area-hidden="true"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>

    <li><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="fas fa-tags" area-hidden="true"></i> Tag</a></li>
    <li><a class="nav-link" href="{{ backpack_url('category') }}"><i class="fas fa-list" area-hidden="true"></i>
            Kategori</a></li>
    <li><a class="nav-link" href="{{ backpack_url('article') }}"><i class="fas fa-newspaper" area-hidden="true"></i>
            Artikel</a></li>
    <li><a class="nav-link" href="{{ backpack_url('faq') }}"><i class="fas fa-question" area-hidden="true"></i> Faqs</a>
    </li>
    <li><a class="nav-link" href="{{ backpack_url('stakeholder') }}"><i class="fas fa-link" area-hidden="true"></i> Tautan
            Terkait</a></li>
    <li><a class="nav-link" href="{{ backpack_url('slideshow') }}"><i class="fas fa-images" area-hidden="true"></i>
            Tayangan Slide</a></li>
    <li><a class="nav-link" href="{{ backpack_url('setting') }}"><i class="fas fa-cog" area-hidden="true"></i>
            Pengaturan</a>
    </li>
    <li><a class="nav-link" href="{{ backpack_url('comment') }}"><i class="nav-icon la la-comment"></i> Komentar</a></li>
@endcan
@can('lihat permohonan')
    <li><a class="nav-link" href="{{ backpack_url('permohonan-informasi') }}"><i class="nav-icon la la-info-circle"></i>
            Permohonan Informasi</a></li>
@endcan
@can('lihat keberatan')
    <li><a class="nav-link" href="{{ backpack_url('pernyataan-keberatan') }}"><i class="fas fa-hand-paper"></i>
            Pernyataan Keberatan</a></li>
@endcan