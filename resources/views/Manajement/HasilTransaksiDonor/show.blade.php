@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Manajement Detail Hasil Transaksi Donor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Hasil_Transaksi_Donor.index') }}">Hasil Transaksi Donor</a></div>
                <div class="breadcrumb-item"><span>Detail Transaksi</span></div>
            </div>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Surat</h2>
                                <div class="invoice-number">{{ $detail_transaction->Code_Transaction }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Data Pendonor</strong>
                                        <br>Nama : {{ $detail_transaction->User_Connection->name }}
                                        <br>Gender : {{ $detail_transaction->User_Connection->Gender }}
                                        <br>NIK : {{ $detail_transaction->User_Connection->NIK }}
                                        <br>Kategori Rhesus : {{ $detail_transaction->User_Connection->Rhesus_Connection->Name }}
                                        <br>Nomor Handphone/Whatsapp : {{ $detail_transaction->User_Connection->phone_number }}
                                        <br>Email : {{ $detail_transaction->User_Connection->email }}
                                        <br>Alamat : {{ $detail_transaction->User_Connection->alamat }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Yang Menangani Pendonor</strong>
                                        <br>Nama : {{ $detail_transaction->Petugas_Connection->name }}
                                        <br>{{ $detail_transaction->Petugas_Connection->roles[0]->name }}
                                        <br>Gender : {{ $detail_transaction->Petugas_Connection->Gender }}
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Riwayat Donor Darah Pendonor</strong>
                                        <br>Berhasil Mendonor = <strong>{{ $data_success_transactions_user }}</strong>
                                        <br>Gagal Mendonor = <strong>{{ $data_fails_transactions_user }}</strong>
                                        <br>Total Untuk Mendonor = <strong>{{ $total_transactions_user }}</strong>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Tanggal Mendonor</strong>
                                        <br><strong>{{ $detail_transaction->Waktu_Donor }}</strong>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection