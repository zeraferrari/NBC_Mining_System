@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Naive Bayes Dashboard</h1>
        </div>
        <div class="container px-0">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Datasets</h4>
                            </div>
                            <div class="card-body">
                                {{ $amount_datasets }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Data Training</h4>
                            </div>
                            <div class="card-body">
                                {{ $amount_trainings }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Data Testing</h4>
                            </div>
                            <div class="card-body">
                                {{ $amount_testings }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0">
            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <h3>Statistik Datasets</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-reset">Bar Chart Datasets</h5>
                                    <div>
                                        <canvas id="Bar_Chart_Datasets" width="400" height="400"></canvas>
                                    </div>        
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-reset">Pie Chart Datasets</h5>
                                    <div>
                                        <canvas id="Pie_Chart_Datasets"></canvas>
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
                <div class="card-header d-flex justify-content-center">
                    <h3>Statistik Data Training</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-reset">Bar Chart Data Training</h5>
                                    <div>
                                        <canvas id="Bar_Chart_Data_Trainings" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-reset">Pie Chart Data Training</h5>
                                    <div>
                                        <canvas id="Pie_Chart_Data_Trainings"></canvas>
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
                <div class="card-header d-flex justify-content-center">
                    <h3>Statistik Data Testing</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-reset">Bar Chart Data Testing</h5>
                                    <div>
                                        <canvas id="Bar_Chart_Data_Testings" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-reset">Pie Chart Data Testing</h5>
                                    <div>
                                        <canvas id="Pie_Chart_Data_Testings"></canvas>
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
                <div class="card-header d-flex justify-content-center">
                    <h3>Tabel Confusion Matrix</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col md-12 col-lg-8">
                            <table class="table table-bordered text-center responsive">
                                <tbody>
                                    <tr>
                                        <th rowspan="2" colspan="2">Confusion Matrix</th>
                                        <th colspan="2">Hasil Klasifikasi</th>
                                        <th rowspan="2">Class Precision</th>
                                    </tr>
                                    <tr>
                                        <td>Layak</td>
                                        <td>Tidak Layak</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">Hasil Aktual</td>
                                        <td>Layak</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td colspan="2">0</td>
                                    </tr>
                                    <tr>
                                        <td>Tidak Layak</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td colspan="2">0</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Class Recall</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 align-self-center">
                            <div class="card">
                                <div class="card-header d-flex justify-content-center">
                                    <p>Ukur Efektifitas Klasifikasi</p>
                                </div>
                                <div class="card-body">
                                    <p><i>True Positive (TP)</i> : Hasil Aktual dan Hasil Klasifikasi Bernilai True (Layak)</p>
                                    <p><i>False Positive (FP)</i> : Hasil Aktual Bernilai False (Tidak Layak) dan Hasil Klasifikasi 
                                    Bernilai True (Layak)</p>
                                    <p><i>False Negative (FN)</i> : Hasil Aktual Bernilai True (Layak) dan Hasil Klasifikasi
                                    Bernilai False (Tidak Layak)</p>
                                    <p><i>True Negative (TN)</i> : Hasil Aktual dan Hasil Klasifikasi Bernilai False (Tidak Layak)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8 offset-md-2 col-lg-8 offset-lg-2">
                            <table class="table table-bordered text-center">
                                <tr>
                                    @foreach ($confusion_matrix as $matrixs)
                                        <td><i>{{ $matrixs->Result }}</i></td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($confusion_matrix as $matrixs)
                                        <td>{{ $matrixs->Count }}</td>
                                    @endforeach
                                </tr>
                                {{-- <tr>
                                    <td><i>True Positive (TP)</i></td>
                                    <td><i>False Positive (FP)</i></td>
                                    <td><i>False Negative (FN)</i></td>
                                    <td><i>True Negative (TN)</i></td>
                                </tr>
                                <tr>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('Bar_Chart')
    <script>
        var datasets = @json($datasets);
        var structure_data_trainings = @json($structure_data_trainings);
        var structure_data_testings = @json($structure_data_testings);
        var amount_trainings = @json($amount_trainings);
        var amount_testings = @json($amount_testings);
    </script>
@endsection