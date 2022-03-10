@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Data Akun User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Users.index') }}">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Users.index') }}">User</a></div>
                <div class="breadcrumb-item"><span>Detail User</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @if ($User->profile_picture)
                            <img src="{{ asset('storage/'.$User->profile_picture) }}" class="rounded-circle profile-widget-picture" style="height: 100px;" alt="Profile_Image">
                        @else
                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture" style="height: 100px;" alt="Profile_Image">
                        @endif
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Berhasil Mendonor</div>
                                <div class="profile-widget-item-value">{{ $success_donor }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Gagal Mendonor</div>
                                <div class="profile-widget-item-value">{{ $fails_donor }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Total Transaksi Donor</div>
                                <div class="profile-widget-item-value">{{ $total_donor }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $User->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td>{{ $User->NIK }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $User->email }}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>:</td>
                                    <td>{{ $User->Gender }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $User->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Hp/Whatsapp</td>
                                    <td>:</td>
                                    <td>{{ $User->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Kategori Rhesus</td>
                                    <td>:</td>
                                    <td>{{ $User->Rhesus_Connection->Name ?? 'Belum Diketahui' }}</td>
                                </tr>
                                <tr>
                                    <td>Status Donor Pendonor</td>
                                    <td>:</td>
                                    <td>{{ $User->Status_Donor }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">History Mendonor Pendonor</h5>
                        <table class="table table-striped" id="DataTables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Waktu Donor</th>
                                    <th>Kembali Donor</th>
                                    <th>Status Transaksi</th>
                                    <th>Petugas yang menangani</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_transaction_user as $data_transactions)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data_transactions->Code_Transaction }}</td>
                                        <td>{{ $data_transactions->Waktu_Donor }}</td>
                                        <td>{{ $data_transactions->Kembali_Donor }}</td>
                                        <td>{{ $data_transactions->Status_Donor }}</td>
                                        <td>{{ $data_transactions->Petugas_Connection->name ?? 'Tidak Diketahui' }}</td>
                                        <td>
                                            <a href="{{ route('Manajement.Hasil_Transaksi_Donor.show', $data_transactions->Code_Transaction) }}"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection