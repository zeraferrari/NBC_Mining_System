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