<div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="" class="nav-link nav-link-lg" data-toggle="sidebar"><i class="fas fa-bars"></i></a></li>
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
                    @if(Auth::user()->roles[0]->name === 'Administrator')
                    <div class="dropdown-list-content dropdown-list-message">
                        @forelse ($latest_inbox as $latest_inboxs)
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
                    @elseif(Auth::user()->roles[0]->name === 'Petugas Medis')
                        <div class="dropdown-list-content dropdown-list-message">
                            @forelse ($latest_inbox as $latest_inboxs)
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
                            <a href="{{ route('Manajement.Transaction.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                        </div>
                    @endif
                </div>
            </li>
            <li class="dropdown dropdown-list-toggle">
                @if(Auth::user()->roles[0]->name === 'Administrator')
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
                                <p class="text-dark text-center">Data kamu belum ada</p>
                            @endforelse
                        </div>
                    <div class="dropdown-footer text-center">
                        <a href="{{ route('Manajement.Hasil_Transaksi_Donor.index') }}">Lihat Seluruh Notifikasi <i class="fas fa-chevron-right"></i></a>
                    </div>
                @elseif(Auth::user()->roles[0]->name === 'Petugas Medis')
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
                                        <p class="text-dark text-center">Data kamu belum ada</p>
                                @endforelse
                            </div>
                        <div class="dropdown-footer text-center">
                            <a href="{{ route('Manajement.Hasil_Transaksi_Donor.index') }}">Lihat Seluruh Notifikasi <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                @endif
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
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="image" class="rounded-circle mr-1" height="30" width="30">
                        @else
                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image" class="rounded-circle mr-1">
                        @endif
                        <div class="d-inline-block">{{ Auth::user()->name }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">{{ Auth::user()->getRoleNames()[0] }}</div>
                    @role('Administrator|Petugas Medis')
                        <a href="{{ route('Manajement.Dashboard.index') }}" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i>Manajement Dashboard
                        </a>
                    @endrole
                    @role('Petugas Medis|Pendonor')
                        <a href="{{ route('RedirectSettingsAccount') }}" class="dropdown-item has-icon">
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
                            @csrf
                        </form> 
                    </div>
                </li>
            @endguest
        </ul>
    </nav>