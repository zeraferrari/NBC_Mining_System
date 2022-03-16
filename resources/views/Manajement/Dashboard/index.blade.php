@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="container px-0">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-users"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Total User</h4></div>
                            <div class="card-body">{{ $total_users }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-users"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>User Sudah Mendonor</h4></div>
                            <div class="card-body">{{ $already_donated_users }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger"><i class="fas fa-users"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>User Belum Mendonor</h4></div>
                            <div class="card-body">{{ $havent_donated_users }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statistik Data Rhesus User</h5>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                <div class="card-wrap">
                                    <div class="card-header"><h4 class="text-dark">Rhesus <b>A+</b></h4></div>
                                    <div class="card-body">{{ $Rhesus_A_Plus }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                <div class="card-wrap">
                                    <div class="card-header"><h4 class="text-dark">Rhesus <b>B+</b></h4></div>
                                    <div class="card-body">{{ $Rhesus_B_Plus }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                <div class="card-wrap">
                                    <div class="card-header"><h4 class="text-dark">Rhesus <b>O+</b></h4></div>
                                    <div class="card-body">{{ $Rhesus_O_Plus }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                <div class="card-wrap">
                                    <div class="card-header"><h4 class="text-dark">Rhesus <b>AB+</b></h4></div>
                                    <div class="card-body">{{ $Rhesus_AB_Plus }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                <div class="card-wrap">
                                    <div class="card-header"><h4 class="text-dark">Rhesus <b>A-</b></h4></div>
                                    <div class="card-body">{{ $Rhesus_A_Negative }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                <div class="card-wrap">
                                    <div class="card-header"><h4 class="text-dark">Rhesus <b>B-</b></h4></div>
                                    <div class="card-body">{{ $Rhesus_B_Negative }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                <div class="card-wrap">
                                    <div class="card-header"><h4 class="text-dark">Rhesus <b>O-</b></h4></div>
                                    <div class="card-body">{{ $Rhesus_O_Negative }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                <div class="card-wrap">
                                    <div class="card-header"><h4 class="text-dark">Rhesus <b>AB-</b></h4></div>
                                    <div class="card-body">{{ $Rhesus_AB_Negative }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('Bar_Chart')
    <script>
        var Data_Rhesus = @json($Name_Rhesus);
        var Data_Each_Rhesus = @json($Count_Data_Each_Rhesus);
    </script>
@endsection