@extends('layouts.Main_Dashboard')
@section('Main_Content')
    <main id="main">
        <section id="section-opening" class="bg-img row justify-content-center align-items-center">
            <div style="width: 100%">
                <div class="card text-center">
                    <div class="card-body">
                        <div style="width: 50%; margin: 0 auto;">
                            <h1 class="card-title">Yudora</h1>
                            <img src="{{ asset('assets/img/unmul.png') }}" class=" img-fluid rounded" alt="..." width="125px" height="125px">
                              <img src="{{ asset('assets/img/Red-Cross-PMI.png') }}" class=" img-fluid rounded" alt="..." width="125px" height="125px" style="margin-left: 25px;">
                            <p class="card-text">"Yudora (Yuk Donor Darah) Merupakan sebuah sistem yang dibuat untuk membantu petugas medis
                              dalam mengklasifikasikan pendonor darah dalam mendonorkan darahnya apakah layak atau tidak untuk melakukan pendonoran darah"
                            </p>
                            @if (Auth::guest() OR Auth::user()->roles[0]->name === 'Petugas Medis' OR Auth::user()->roles[0]->name === "Pendonor")
                                <form action="{{ route('Antrian.Mendonor') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary" type="submit">Donorkan Darah Anda</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid row background-1 align-items-center justify-content-center" style="min-height: 100vh;" id="TermCondition">
            <div class="col-sm-12 col-md-10 col-lg-8 offset-lg-4">
                <div class="card text-dark">
                    <div class="card-body">
                        <h1 class="card-title">Syarat/Ketentuan Dalam Mendonorkan Darah</h1>
                        <div class="card-text">
                            <ol>
                                <li>Pendonor darah berusia 17 - 65 tahun</li>
                                <li>Memiliki berat badan minimal 45 Kg</li>
                                <li>Memiliki kadar hemoglobin dengan nilai 12,5 - 17 g/dL</li>
                                <li>Nilai tekanan darah sistole sebesar 100 mmHg (Minimal) dan 170 mmHg (Maksimal)</li>
                                <li>Nilai tekanan darah diastole sebesar 70 mmHg (Minimal) dan 100 mmHg (Maksimal)</li>
                                <li>Temperatur tubuh bernilai sebesar 36,6 - 37,5 derajat celcius</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid row background-2 align-items-center justify-content-start" style="min-height: 100vh;">
            <div class="col-sm-12 col-md-12 col-lg-8 px-0">
                <div class="card text-dark" style="margin-left: 20px; margin-right: 20px;">
                    <div class="card-body">
                        <h1>Manfaat Dalam Mendonorkan Darah Bagi Tubuh</h1>
                        <ol>
                            <li>Dapat Mendeteksi Penyakit Serius
                                <p>
                                    Pada pelaksanaannya, sebelum donor darah. pendonor darah diwajibkan melakukan pemeriksaan kondisi
                                    darah yang sekaligus mampu mendeteksi adanya penyakit serius seperti HIV, sifilis, hepatitis B, hepatitis C, hingga
                                    malaria. Untuk itu, dengan melakukan pemeriksaan darah rutin, maka berbagai penyakit tersebut dapat dideteksi sedini mungkin
                                </p>
                            </li>
                            <li>Menurunkan resiko terkena penyakit jantung dan pembuluh darah
                                <p>
                                    Donor darah secara teratur diketahui dapat menurunkan kekentalan darah,
                                    yang menjadi salah satu faktor penyebab dari penyakit jantung.
                                </p>
                            </li>
                            <li>Membantu menurunkan berat badan
                                <p>Donor darah secara rutin dapat menjadi salah satu upaya untuk dapat menurunkan berat badan
                                    karena rata-rata orang dewasa dapat membakar 650 kalori saat mendonorkan darah sebanyak 450 ml
                                </p>
                            </li>
                        </ol>
                        <blockquote class="blackquote">
                            <footer class="blockquote-footer"><i>Sumber data : https://promkes.kemkes.go.id/3-manfaat-donor-darah-bagi-kesehatan-tubuh </i></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="Statistik-Kantong-Darah">
            <div class="row my-5 text-center">
                <div class="col-lg-10 offset-lg-1">
                    <h2>Statistik Kantong Darah Hari Ini {{ \Carbon\Carbon::now()->timezone('Asia/Makassar')->isoFormat('dddd, DD-MMMM-YYYY') }}</h2>
                    <p>
                        Berikut merupakan jumlah kantong darah dari setiap rhesus
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($datasets_today_blood as $datasets_bloods_today)
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="card card-statistic-2 shadow">
                            <div class="card-stats">
                                <div class="card stats-title text-center text-dark">Rhesus {{ $datasets_bloods_today->Name_Rhesus }}</div>
                                <div class="card-stats-items justify-content-center">
                                    <div class="card-stats-item px-0">
                                        <div class="card-stats-item-count">{{ $datasets_bloods_today->Data_Success_Donor }}</div>
                                        <div class="card-stats-item-label">Berhasil</div>
                                    </div>
                                    <div class="card-stats-item px-0">
                                        <div class="card-stats-item-count">{{ $datasets_bloods_today->Data_Failed_Donor }}</div>
                                        <div class="card-stats-item-label">Gagal</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-icon shadow-primary" style="background-color: #8A0707">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Jumlah Kantong Darah</h4>
                                </div>
                                <div class="card-body">{{ $datasets_bloods_today->Data_Success_Donor }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row my-5 text-center" id="Statistik-Donor-Darah">
                <div class="col-md-10 offset-md-1">
                    <h2 style="margin-bottom: 0;">Grafik Kantong Darah Palang Merah Indonesia</h2>
                    <p>Berikut merupakan grafik jumlah kantong darah berdasarkan range tanggal</p>
                </div>
            </div>
            <form action="">
                <div class="row justify-content-between">
                    <div class="col-sm-6 col-md-5 col-lg-5 form-group">
                        <label for="ChartFromData">Dari Tanggal</label>
                        <input type="date" class="form-control" id="ChartFromData" name="ChartFromData" value="{{ old('ChartFromData') }}">
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-5 form-group">
                        <label for="ChartToData">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="ChartToData" name="ChartToData" value="{{ old('ChartToData') }}">
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2" style="margin-top: 30px;">
                        <div class="buttons">
                            <button class="btn btn-icon icon-left col-12" type="submit" style="background-color: #8A0707; color: rgb(242, 242, 242);"><i class="fas fa-filter"> Filter</i></button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row" id="Contact-us">
                <div class="col-sm-12 col-md-8 col-lg-7">
                    <h3>Yudora (Yuk Donor Darah)</h3>
                    <p>
                        Merupakan sebuah sistem atau website yang dibuat untuk membantu petugas medis
                        dalam mengklasifikasikan pendonor darah dalam mendonorkan darahnya apakah layak atau tidak dan
                        juga untuk membantu menghindarin kesalahan penginputan data
                    </p>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5">
                    <h5>Palang Merah Indonesia Kota Samarinda</h5>
                    <ul style="list-style: none;" class="px-0">
                        <li>
                            <i class="fas fa-phone"><span> (0541) 732261</span></i>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/pmi.kota.samarinda/?hl=en" style="color: rgb(108, 117, 125)"><i class="fab fa-instagram mx-0" style="font-size: 14px;"><span>  UDD PMI Kota Samarinda</span></i></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/pmiprovkaltim" style="color: rgb(108, 117, 125)"><i class="fab fa-facebook mx-0" style="font-size: 14px;"><span> PMI Provinsi Kalimantan Timur</span></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('SweetAlert')
    @if(Session::has('response_login'))
        <script>
            let message_response = '{!! Session::get('response_login') !!}';
            Swal.fire({
                icon: 'error',
                title: 'Oops....',
                html: message_response,
                timer: 3000,
            });
        </script>
    @endif
    @if(Session::has('response_check_status_donor'))
        <script>
            let message_response = '{!! Session::get('response_check_status_donor') !!}';
            Swal.fire({
                icon: 'info',
                title: 'Information',
                html: message_response,
                timer: 3000
            });
        </script>
    @endif
    @if(Session::has('response_success_request_transaction'))
        <script>
            let message_response = '{!! Session::get('response_success_request_transaction') !!}';
            Swal.fire({
                icon: 'success',
                title: 'Information',
                html: message_response,
                timer: 3000
            });
        </script>
    @endif
    @if(Session::has('response_check_queue_transaction'))
        <script>
            let message_response = '{!! Session::get('response_check_queue_transaction') !!}';
            Swal.fire({
                icon: 'warning',
                iconColor: 'red',
                title: 'Information',
                html: message_response,
                timer: 5000
            });
        </script>
    @endif
    @if(Session::has('response_failed_donor_transaction'))
        <script>
            let message_response = '{!! Session::get('response_failed_donor_transaction') !!}';
            Swal.fire({
                icon: 'warning',
                iconColor: 'red',
                title: 'Information',
                html: message_response,
                timer: 5000
            });
        </script>
    @endif
@endsection