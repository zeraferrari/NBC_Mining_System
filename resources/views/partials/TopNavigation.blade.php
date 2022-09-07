<div class="container-fluid px-0 shadow-lg">
    <nav class="navbar navbar-expand-lg main-navbar shadow-lg" style="left:0; right:0; background-color: #8A0707">
        <a href="{{ route('home') }}" class="navbar-brand sidebar-gone-hide">Yudora</a>
        <div class="nav-collapse">
            <a href="#" class="sidebar-gone-show nav-collapse-toggle nav-link">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#Statistik-Kantong-Darah" class="nav-link">Kantong Darah</a></li>
                <li class="nav-item"><a href="#Statistik-Donor-Darah" class="nav-link">Grafik Donor Darah</a></li>
                <li class="nav-item"><a href="" class="nav-link">Uji Donor Darah</a></li>
                <li class="nav-item"><a href="#Contact-us" class="nav-link">Kontak Kami</a></li>
            </ul>
        </div>
        <div class="form-inline ml-auto">
            <ul class="navbar-nav navbar-right">
                <li class="dropdown dropdown-list-toggle">
                @if(Auth::check())
                    @if(Auth::user()->roles[0]->name === 'Administrator')
                        <a href="" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Inbox
                                <div class="float-right">
                                    <a href="#">Seluruh Pesan Dibaca</a>
                                </div>
                            </div>
                            
                            <div class="dropdown-list-content dropdown-list-message">
                                @forelse ( $latest_inbox as $latest_inboxs )
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-avatar">
                                            <img src="{{ asset('assets/img/avatar/avatar-5.png') }}" alt="image" class="rounded-circle">
                                        </div>
            
                                        <div class="dropdown-item-desc">
                                            <b class="text-dark">SYSTEM</b>
                                            <p>Transaksi donor darah dengan nomor transaksi <b class="text-dark">{{ $latest_inboxs->Code_Transaction }}</b>
                                            @if(empty($latest_inboxs->Petugas_Connection->name))
                                                dalam proses pelayanan dengan status <b class="text-dark">{{ $latest_inboxs->Status_Donor }}</b> 
                                            @else
                                                dalam proses pelayanan oleh petugas medis atas nama <b class="text-dark">{{ $latest_inboxs->Petugas_Connection->name }}</b>
                                                dan dalam status <b class="text-dark">{{ $latest_inboxs->Status_Donor }}</b>
                                            @endif
                                            </p>
                                            <div class="time">{{ $latest_inboxs->updated_at }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-center">Data kamu belum ada</p>
                                @endforelse
                            </div>
                        <div class="dropdown-footer text-center">
                            <a href="{{ route('Manajement.Transaction.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </li>
                    @else
                        <a href="" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Inbox
                                <div class="float-right">
                                    <a href="#">Seluruh Pesan Dibaca</a>
                                </div>
                            </div>
                            
                            <div class="dropdown-list-content dropdown-list-message">
                                @forelse ( $latest_inbox as $latest_inboxs )
                                    <a href="{{ route('checking_transaction', $latest_inboxs->Code_Transaction) }}" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-avatar">
                                            <img src="{{ asset('assets/img/avatar/avatar-5.png') }}" alt="image" class="rounded-circle">
                                        </div>
            
                                        <div class="dropdown-item-desc">
                                            <b class="text-dark">SYSTEM</b>
                                            <p>Transaksi donor darah anda dengan nomor transaksi <b class="text-dark">{{ $latest_inboxs->Code_Transaction }}</b>
                                            dinyatakan <b class="text-dark">{{ $latest_inboxs->Status_Transaction }} Donor</b> 
                                            </p>
                                            <div class="time">{{ $latest_inboxs->updated_at }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-center">Data kamu belum ada</p>
                                @endforelse
                            </div>
                        <div class="dropdown-footer text-center">
                            <a href="{{ route('checking_history') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </li>
                    @endif
                @endif
                <li class="dropdown dropdown-list-toggle">
                @if(Auth::check())
                    @if(Auth::User()->roles[0]->name === 'Pendonor')
                        <a href="" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Notifikasi
                                <div class="float-right">
                                    <a href="#">Seluruh Notifikasi Dibaca</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                @forelse ( $latest_notification as $latest_notifications )
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-info text-white">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Informasi Donor</b>
                                            <p>Proses donor darah kamu dalam tahap <b class="text-dark">{{ $latest_notifications->Status_Donor }}</b>
                                            dan ditangani oleh petugas <b class="text-dark">{{ $latest_notifications->Petugas_Connection->name ?? '-' }}</b>
                                            </p>

                                            <div class="time">{{ $latest_notifications->updated_at }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-center">Data kamu belum ada</p>
                                @endforelse
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">Lihat Seluruh Notifikasi <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    @elseif(Auth::User()->roles[0]->name === 'Petugas Medis')
                        <a href="" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Notifikasi
                                <div class="float-right">
                                    <a href="#">Seluruh Notifikasi Dibaca</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                @forelse ( $latest_notification as $latest_notifications )
                                    <a href="{{ route('Manajement.Hasil_Transaksi_Donor.show',$latest_notifications->Code_Transaction) }}" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-info text-white">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Informasi Donor</b>
                                            <p>Anda menangani pendonor darah atas nama <b class="text-dark">{{ $latest_notifications->User_Connection->name }}</b> dengan status transaksi
                                            <b class="text-dark">{{ $latest_notifications->Status_Donor }}</b>
                                            dengan nomor transaksi <b class="text-dark">{{ $latest_notifications->Code_Transaction }}</b>
                                            </p>

                                            <div class="time">{{ $latest_notifications->updated_at }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-center">Data kamu belum ada</p>
                                @endforelse
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="{{ route('Manajement.Hasil_Transaksi_Donor.index') }}">Lihat Seluruh Notifikasi <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    @elseif(Auth::user()->roles[0]->name === 'Administrator')
                        <a href="" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Notifikasi
                                <div class="float-right">
                                    <a href="">Seluruh Notifikasi Dibaca</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                @forelse ( $latest_notification as $latest_notifications )
                                    <a href="{{ route('Manajement.Hasil_Transaksi_Donor.show', $latest_notifications->Code_Transaction) }}" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-info text-white">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Informasi Donor Darah</b>
                                            <p>
                                                Petugas Medis atas nama <b class="text-dark">{{ $latest_notifications->Petugas_Connection->name }}</b>
                                                telah menangani pendonor darah atas nama <b class="text-dark">{{ $latest_notifications->User_Connection->name }}</b>
                                                dengan status transaksi donor <b class="text-dark">{{ $latest_notifications->Status_Donor }}</b>
                                                pada nomor transaksi <b class="text-dark">{{ $latest_notifications->Code_Transaction }}</b>
                                            </p>
                                            <div class="time">{{ $latest_notifications->updated_at }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-center">Data kamu belum ada</p>
                                @endforelse
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="{{ route('Manajement.Hasil_Transaksi_Donor.index') }}">Lihat Seluruh Notifikasi <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    @endif
                @endif
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
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="image" class="rounded-circle mr-1" height="30" width="30">
                            @else
                                <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image" class="rounded-circle mr-1">
                            @endif
                            <div class="d-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        @role('Administrator|Petugas Medis')
                            <a href="{{ route('Manajement.Dashboard.index') }}" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i>Manajement Dashboard
                            </a>
                        @endrole
                        @role('Petugas Medis|Pendonor')
                            <a href="" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i>Setting Akun
                            </a>
                            <a href="{{ route('checking_history') }}" class="dropdown-item has-icon">
                                <i class="fas fa-tasks"></i>Riwayat Donorku
                            </a>
                        @endrole
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}<i class="fas fa-sign-out-alt"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                {{ csrf_field() }}
                            </form> 
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</div>