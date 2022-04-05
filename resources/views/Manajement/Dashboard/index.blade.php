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
                    <form action="{{ route('test') }}">
                        <div class="row">
                            <div class="col-sm-6 col-md-5 col-lg-5 form-group">
                                <label for="ChartFromData">Dari Tanggal</label>
                                <input type="date" class="form-control" name="ChartFromData" id="ChartFromData">
                            </div>
                            <div class="col-sm-6 col-md-5 col-lg-5 form-group">
                                <label for="ChartToData">Sampai Tanggal</label>
                                <input type="date" class="form-control" name="ChartToData" id="ChartToData">
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2 mt-4">
                                <div class="buttons">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary col-12"><i class="fas fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-4">
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
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Bar Chart Keseluruhan Rhesus</h5>
                                    <div>
                                        <canvas id="DashboardBar" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Persentase Kategori Seluruh Kategori Rhesus</h5>
                                    <div>
                                        <canvas id="DashboardPie"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statistik Transaksi Donor Darah</h5>
                    <div class="container-fluid px-0">
                        <form action="{{ route('test') }}">
                            <div class="row">
                                <div class="col-sm-6 col-md-5 col-lg-5 form-group">
                                    <label for="ChartFromData">Dari Tanggal</label>
                                    <input type="date" class="form-control" name="ChartFromData" id="ChartFromData">
                                </div>
                                <div class="col-sm-6 col-md-5 col-lg-5 form-group">
                                    <label for="ChartToData">Sampai Tanggal</label>
                                    <input type="date" class="form-control" name="ChartToData" id="ChartToData">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 mt-4">
                                    <div class="buttons">
                                        <button type="submit" class="btn btn-icon icon-left btn-primary col-12"><i class="fas fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary"><i class="fas fa-file-medical"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4>Total Transaksi</h4></div>
                                        <div class="card-body">{{ $Total_Transaction }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-success"><i class="fas fa-check"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4>Transaksi Donor Berhasil</h4></div>
                                        <div class="card-body">{{ $Transaction_Success }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-danger"><i class="fas fa-exclamation"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4>Transaksi Donor Gagal</h4></div>
                                        <div class="card-body">{{ $Transaction_Fails }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card card-statistic-1">
                                    <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4 class="text-dark">Kantong Darah <b>A+</b></h4></div>
                                        <div class="card-body">{{ $TB_Count_A_Plus }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card card-statistic-1">
                                    <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4 class="text-dark">Kantong Darah <b>B+</b></h4></div>
                                        <div class="card-body">{{ $TB_Count_B_Plus }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card card-statistic-1">
                                    <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4 class="text-dark">Kantong Darah <b>O+</b></h4></div>
                                        <div class="card-body">{{ $TB_Count_O_Plus }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card card-statistic-1">
                                    <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4 class="text-dark">Kantong Darah <b>AB+</b></h4></div>
                                        <div class="card-body">{{ $TB_Count_AB_Plus }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card card-statistic-1">
                                    <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4 class="text-dark">Kantong Darah <b>A-</b></h4></div>
                                        <div class="card-body">{{ $TB_Count_A_Negative }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card card-statistic-1">
                                    <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4 class="text-dark">Kantong Darah <b>B-</b></h4></div>
                                        <div class="card-body">{{ $TB_Count_B_Negative }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card card-statistic-1">
                                    <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4 class="text-dark">Kantong Darah <b>O-</b></h4></div>
                                        <div class="card-body">{{ $TB_Count_O_Negative }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="card card-statistic-1">
                                    <div class="card-icon" style="background-color: #8A0707"><i class="fas fa-tint"></i></div>
                                    <div class="card-wrap">
                                        <div class="card-header"><h4 class="text-dark">Kantong Darah <b>AB-</b></h4></div>
                                        <div class="card-body">{{ $TB_Count_AB_Negative }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Grafik Kantong Darah</h5>
                                    <div>
                                        <canvas id="LineTransaction"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('Bar_Chart')
    <script>
        var data_transaction = @json($Json_Line_Chart);
        var Month_Name = @json($Month_Name);
        var Data_Rhesus = @json($Name_Rhesus);
        var Data_Each_Rhesus = @json($Count_Data_Each_Rhesus);  
    </script>
@endsection