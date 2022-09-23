@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Manajement Detail Data Testing</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.DataTestings.index') }}">Data Testing</a></div>
                <div class="breadcrumb-item"><span>Detail Data Testing</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Detail Data Testing / Data Learning</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="Name">Nama</label>
                                <input type="text" name="Name" id="Name" class="form-control" value="{{ $data->Name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Rhesus">Kategori Rhesus</label>
                                <input type="text" name="Rhesus" id="Rhesus" class="form-control" value="{{ $data->Rhesus_Connection->Name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Age">Umur</label>
                                <input type="text" class="form-control" id="Age" name="Age" value="{{ $data->Age }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Weight">Berat Badan</label>
                                <div class="input-group">
                                    <input type="text" name="Weight" id="Weight" class="form-control" value="{{ $data->Weight }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">Kg</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Hemoglobin">Hemoglobin</label>
                                <div class="input-group">
                                    <input type="text" name="Hemoglobin" id="Hemoglobin" class="form-control" value="{{ $data->Hemoglobin }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">g/dL</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Pressure_Sistole">Tekanan Sistolik</label>
                                <div class="input-group">
                                    <input type="text" name="Pressure_Sistole" id="Pressure_Sistole" class="form-control" value="{{ $data->Pressure_Sistole }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">mmHg</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Pressure_diastole">Tekanan Distolik</label>
                                <div class="input-group">
                                    <input type="text" name="Pressure_diastole" id="Pressure_diastole" class="form-control" value="{{ $data->Pressure_diastole }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">mmHg</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status Data Aktual Donor Darah</label>
                                <input type="text" class="form-control" id="Status" name="Status" value="{{ $data->Status }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Result_Classification">Status Donor Hasil Klasifikasi</label>
                                <input type="text" class="form-control" id="Result_Classification" name="Result_Classification" value="{{ $data->Result_Classification ?? 'Belum DiKlasifikasi'}}" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><h3>Kalkulasi Perhitungan Algoritma Naive Bayes</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <br><strong>Total Jumlah Data Training =  {{ $Result_Classification[0]->Total_Data_Trainings }}</strong>
                                    <br>Total Data <i>Class</i> <strong>Layak = {{ $Result_Classification[0]->TotalValue_Class_Layak }}</strong> 
                                    <br>Total Data <i>Class</i> <strong>Tidak Layak = {{ $Result_Classification[0]->TotalValue_Class_Tidak_Layak }}</strong> 
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <br>Hasil <i>Prior Probability Class</i> <strong>Layak = {{ $Result_Classification[0]->Prior_Prob_Class_Layak }}</strong>
                                    <br>Hasil <i>Prior Probability Class</i> <strong>Tidak Layak = {{ $Result_Classification[0]->Prior_Prob_Class_Tidak_Layak }}</strong>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nilai Mean</h5>
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <th><i>Class</i></th>
                                                <th>Umur</th>
                                                <th>Berat Badan</th>
                                                <th>Hemoglobin</th>
                                                <th>Tekanan Sistole</th>
                                                <th>Tekanan Diastole</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>Layak</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tidak Layak</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nilai Standar Deviasi</h5>
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <th><i>Class</i></th>
                                                <th>Umur</th>
                                                <th>Berat Badan</th>
                                                <th>Hemoglobin</th>
                                                <th>Tekanan Sistole</th>
                                                <th>Tekanan Diastole</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>Layak</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tidak Layak</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nilai Distribusi Gaussian</h5>
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <th><i>Class</i></th>
                                                <th>Umur</th>
                                                <th>Berat Badan</th>
                                                <th>Hemoglobin</th>
                                                <th>Tekanan Sistole</th>
                                                <th>Tekanan Diastole</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>Layak</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tidak Layak</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Each_Attribute_Class_Layak">Hasil Probabilitas Setiap Attribute Berdasarkan Class Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Each_Attribute_Class_Layak" id="Result_Probability_Each_Attribute_Class_Layak" value="{{ $Result_Classification[0]->Probability_All_Attribute_Each_Class['Class_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Each_Attribute_Class_Tidak_Layak">Hasil Probabilitas Setiap Attribute Berdasarkan Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Each_Attribute_Class_Tidak_Layak" id="Result_Probability_Each_Attribute_Class_Tidak_Layak" value="{{ $Result_Classification[0]->Probability_All_Attribute_Each_Class['Class_Tidak_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Class_Layak">Hasil Akhir Probabilitas Berdasarkan Class Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Class_Layak" id="Result_Probability_Class_Layak" value="{{ $Result_Classification[0]->Probability_Each_Class_Not_Normalization['Class_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Class_Tidak_Layak">Hasil Akhir Probabilitas Berdasarkan Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Class_Tidak_Layak" id="Result_Probability_Class_Tidak_Layak" value="{{ $Result_Classification[0]->Probability_Each_Class_Not_Normalization['Class_Tidak_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Normalization_Class_Layak">Hasil Normalisasi Class Layak</label>
                                    <input class="form-control" type="text" name="Normalization_Class_Layak" id="Normalization_Class_Layak" value="{{ $Result_Classification[0]->Probability_Each_Class_Normalization['Class_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Normalization_Class_Tidak_Layak">Hasil Normalisasi Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Normalization_Class_Tidak_Layak" id="Normalization_Class_Tidak_Layak" value="{{ $Result_Classification[0]->Probability_Each_Class_Normalization['Class_Tidak_Layak'] }}" readonly>
                                </div>
                            </div>
                            @if ($Result_Classification[0]->Result_Classification == 'Layak')
                                <div class="alert alert-success">
                                    <i>*** Hasil Klasifikasi ***</i>
                                    <p>Dari perhitungan naive bayes classifier, hasil menunjukan bahwa nilai class layak lebih besar dari nilai
                                    class tidak layak. Maka, data testing pendonor darah atas nama <b>{{ $data->Name }}</b> dinyatakan
                                    <b>Layak mendonorkan darah</b>    
                                    </p>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <i>*** Hasil Klasifikasi ***</i>
                                    <p>Dari perhitungan naive bayes classifier, hasil menunjukan bahwa nilai class tidak layak lebih besar dari nilai
                                    class layak. Maka, data testing pendonor darah atas nama <b>{{ $data->Name }}</b> dinyatakan
                                    <b>Tidak Layak mendonorkan darah</b>    
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection