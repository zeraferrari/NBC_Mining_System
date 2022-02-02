<div class="navbar-bg"></div>

            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle">
                        <a href="" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Inbox
                                <div class="float-right">
                                    <a href="#">Seluruh Pesan Dibaca</a>
                                </div>
                            </div>

                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img src="" alt="image" class="rounded-circle">
                                    </div>

                                    <div class="dropdown-item-desc">
                                        <b>Nama User</b>
                                        <p>Isi Pesan</p>
                                        <div class="time">Waktu terbuatnya pesan</div>
                                    </div>
                                </a>

                                <a href="" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img src="" alt="image" class="rounded-circle">
                                    </div>

                                    <div class="dropdown-item-desc">
                                        <b>Nama User</b>
                                        <p>Isi Pesan</p>
                                        <div class="time">Waktu terbuatnya pesan</div>
                                    </div>
                                </a>

                                <a href="" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img src="" alt="image" class="rounded-circle">
                                    </div>

                                    <div class="dropdown-item-desc">
                                        <b>Nama User</b>
                                        <p>Isi Pesan</p>
                                        <div class="time">Waktu terbuatnya pesan</div>
                                    </div>
                                </a>

                                <a href="" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img src="" alt="image" class="rounded-circle">
                                    </div>

                                    <div class="dropdown-item-desc">
                                        <b>Nama User</b>
                                        <p>Isi Pesan</p>
                                        <div class="time">Waktu terbuatnya pesan</div>
                                    </div>
                                </a>
                            </div>

                            <div class="dropdown-footer text-center">
                                <a href="">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle">
                        <a href="" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Notifikasi
                                <div class="float-right">
                                    <a href="">Seluruh Notifikasi Dibaca</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Info Transaksi</b> deskripsi
                                        <div class="time">Waktu Notifikasi Didapat</div>
                                    </div>
                                </a>

                                <a href="" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Info Transaksi</b> deskripsi
                                        <div class="time">Waktu Notifikasi Didapat</div>
                                    </div>
                                </a>

                                <a href="" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Info Transaksi</b> deskripsi
                                        <div class="time">Waktu Notifikasi Didapat</div>
                                    </div>
                                </a>

                                <a href="" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Info Transaksi</b> deskripsi
                                        <div class="time">Waktu Notifikasi Didapat</div>
                                    </div>
                                </a>

                                <a href="" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Info Transaksi</b> deskripsi
                                        <div class="time">Waktu Notifikasi Didapat</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="">Lihat Seluruh Notifikasi <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img src="/img/avatar/avatar-1.png" alt="image" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-title">Nama Role User</div>

                                <a href="" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i>Manajement Dashboard
                                </a>
                                <a href="" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i>Setting Akun
                                </a>
                                <a href="" class="dropdown-item has-icon">
                                    <i class="fas fa-tasks"></i>Riwayat Donorku
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}<i class="fas fa-sign-out-alt"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form> 
                            </div>
                        </li>
                    @endguest
                </ul>
            </nav>