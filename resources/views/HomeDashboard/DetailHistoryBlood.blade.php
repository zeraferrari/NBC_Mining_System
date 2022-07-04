@extends('layouts.Main_Dashboard')

@section('Main_Content')
    <style>
        td{
            padding-left: 10px;
        }
    </style>
    <main id="main">
        <section id="section-opening" class="bg-img row align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="w-75" style="background-color: #eee">
                        <p class="offset-sm-8 offset-md-9 offset-lg-9">Samarinda, {{ $date_today }}</p>
                        <h3 class="text-center text-dark mb-0">Unit Donor Darah (UDD) PMI Kota Samarinda</h3> 
                        <address class="text-center">Jl. Palang Merah Indonesia No.1, Sidodadi, Kec.Samarinda Ulu, Kota Samarinda, Kalimantan Timur 75123</address>
                        <hr>
                        <p class="mx-2">Dengan ini menyatakan bahwa, transaksi donor dengan Nomor Transaksi <b class="text-dark">{{ $Transactions->Code_Transaction ?? ''}}</b>
                        yang dilakukan pada tanggal <b class="text-dark">{{ $Transactions->Waktu_Donor ??'' }}</b> di Unit Donor Darah PMI Kota Samarinda
                        yang dilakukan oleh Bapak/Ibu atas nama <b class="text-dark">{{ $Transactions->User_Connection->name ?? '' }}</b> dengan detail sebagai berikut:
                        </p>
                        <table class="mx-auto w-50" style="margin-bottom: 16px;">
                            <tr>
                                <td>Nama</td>
                                <td>{{ $Transactions->User_Connection->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>{{ $Transactions->User_Connection->NIK ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ $Transactions->User_Connection->Gender ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>{{ $Transactions->Age ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Hemoglobin</td>
                                <td>{{ $Transactions->Hemoglobin ?? ''}} g/dL</td>
                            </tr>
                            <tr>
                                <td>Berat Badan</td>
                                <td>{{ $Transactions->Weight ?? ''}} Kg</td>
                            </tr>
                            <tr>
                                <td>Tekanan Sistole</td>
                                <td>{{ $Transactions->Pressure_sistole ?? ''}} mmHg</td>
                            </tr>
                            <tr>
                                <td>Tekanan Diastole</td>
                                <td>{{ $Transactions->Pressure_diastole ?? ''}} mmHg</td>
                            </tr>
                            <tr>
                                <td>Hasil Klasifikasi</td>
                                <td><b>{{ $Transactions->Status_Transaction ?? ''}}</b></td>
                            </tr>
                        </table>
                        <p class="mx-2">Transaksi pendonor darah dinyatakan <b class="text-dark">{{ $Transactions->Status_Donor ?? ''}}</b> yang ditangani oleh petugas medis atas nama <b class="text-dark">{{ $Transactions->Petugas_Connection->name ?? ''}}</b> dan diperbolehkan mendonor kembali
                        pada tanggal <b class="text-dark">{{ $Transactions->Kembali_Donor ?? ''}}</b> sesuai ketentuan yang berlaku
                        </p>
                        <div class="col text-center">
                            <a href="" class="btn btn-primary mb-2"><i class="fas fa-print"></i> Print Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection