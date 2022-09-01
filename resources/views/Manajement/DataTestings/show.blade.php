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
                            <div class="col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Attribute Umur</h6>
                                        <div class="card-header-form" style="margin-left: auto;">
                                            <button class="badge badge-primary rounded-sm" data-toggle="collapse" type="button" data-target="#atr_umur" aria-expanded="false" aria-controls="atr_umur">Tampilkan</button>
                                        </div>
                                    </div>
                                    <div class="collapse" id="atr_umur">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="Mean_layak_Umur"><strong><i>Mean (Class Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_layak_Umur" name="Mean_layak_Umur" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Age'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Umur"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Umur" name="Mean_tidak_layak_Umur" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Age'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Umur"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Umur" id="Standar_Deviasi_Layak_Umur" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Age'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Umur"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Umur" id="Standar_Deviasi_Tidak_Layak_Umur" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Age'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Umur_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Umur_Layak" id="Gaussian_Umur_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Age'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Umur_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Umur_Tidak_Layak" id="Gaussian_Umur_Tidak_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Age'] }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Attribute Berat Badan</h6>
                                        <div class="card-header-form" style="margin-left: auto;">
                                            <button class="badge badge-primary rounded-sm" data-toggle="collapse" type="button" data-target="#atr_bb" aria-expanded="false" aria-controls="atr_bb">Tampilkan</button>
                                        </div>
                                    </div>
                                    <div class="collapse" id="atr_bb">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="Mean_layak_Berat_Badan"><strong><i>Mean (Class Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_layak_Berat_Badan" name="Mean_layak_Berat_Badan" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Weight'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Berat_Badan"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Berat_Badan" name="Mean_tidak_layak_Berat_Badan" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Weight'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Berat_Badan"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Berat_Badan" id="Standar_Deviasi_Layak_Berat_Badan" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Weight'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Berat_Badan"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Berat_Badan" id="Standar_Deviasi_Tidak_Layak_Berat_Badan" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Weight'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Berat_Badan_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Berat_Badan_Layak" id="Gaussian_Berat_Badan_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Weight'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Berat_Badan_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Berat_Badan_Tidak_Layak" id="Gaussian_Berat_Badan_Tidak_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Weight'] }}" readonly>
                                            </div>      
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Attribute Hemoglobin</h6>
                                        <div class="card-header-form" style="margin-left: auto;">
                                            <button class="badge badge-primary rounded-sm" data-toggle="collapse" type="button" data-target="#atr_hemoglobin" aria-expanded="false" aria-controls="atr_hemoglobin">Tampilkan</button>
                                        </div>
                                    </div>
                                    <div class="collapse" id="atr_hemoglobin">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="Mean_layak_Hemoglobin"><strong><i>Mean (Class Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_layak_Hemoglobin" name="Mean_layak_Hemoglobin" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Hemoglobin'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Hemoglobin"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Hemoglobin" name="Mean_tidak_layak_Hemoglobin" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Hemoglobin"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Hemoglobin" id="Standar_Deviasi_Layak_Hemoglobin" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Hemoglobin'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Hemoglobin"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Hemoglobin" id="Standar_Deviasi_Tidak_Layak_Hemoglobin" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Hemoglobin_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Hemoglobin_Layak" id="Gaussian_Hemoglobin_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Hemoglobin'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Hemoglobin_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Hemoglobin_Tidak_Layak" id="Gaussian_Hemoglobin_Tidak_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}" readonly>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Attribute Tekanan Sistolik</h6>
                                        <div class="card-header-form" style="margin-left: auto;">
                                            <button class="badge badge-primary rounded-sm" data-toggle="collapse" type="button" data-target="#atr_pressure_sistole" aria-expanded="false" aria-controls="atr_pressure_sistole">Tampilkan</button>
                                        </div>
                                    </div>
                                    <div class="collapse" id="atr_pressure_sistole">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="Mean_layak_Pressure_Sistole"><strong><i>Mean (Class Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_layak_Pressure_Sistole" name="Mean_layak_Pressure_Sistole" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Pressure_Sistole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Pressure_Sistole"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Pressure_Sistole" name="Mean_tidak_layak_Pressure_Sistole" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Pressure_Sistole"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Pressure_Sistole" id="Standar_Deviasi_Layak_Pressure_Sistole" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Pressure_Sistole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Pressure_Sistole"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Pressure_Sistole" id="Standar_Deviasi_Tidak_Layak_Pressure_Sistole" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Pressure_Sistole_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Pressure_Sistole_Layak" id="Gaussian_Pressure_Sistole_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Pressure_Sistole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Pressure_Sistole_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Pressure_Sistole_Tidak_Layak" id="Gaussian_Pressure_Sistole_Tidak_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}" readonly>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 offset-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Attribute Tekanan Distolik</h6>
                                        <div class="card-header-form" style="margin-left: auto;">
                                            <button class="badge badge-primary rounded-sm" data-toggle="collapse" type="button" data-target="#atr_pressure_diastole" aria-expanded="false" aria-controls="atr_pressure_diastole">Tampilkan</button>
                                        </div>
                                    </div>
                                    <div class="collapse" id="atr_pressure_diastole">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="Mean_layak_Pressure_Diastole"><strong><i>Mean (Class Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_layak_Pressure_Diastole" name="Mean_layak_Pressure_Diastole" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Layak']['Pressure_Diastole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Pressure_Diastole"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Pressure_Diastole" name="Mean_tidak_layak_Pressure_Diastole" value="{{ $Result_Classification[0]->Mean_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Pressure_Diastole"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Pressure_Diastole" id="Standar_Deviasi_Layak_Pressure_Diastole" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Layak']['Pressure_Diastole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Pressure_Diastole"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Pressure_Diastole" id="Standar_Deviasi_Tidak_Layak_Pressure_Diastole" value="{{ $Result_Classification[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Pressure_Diastole_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Pressure_Diastole_Layak" id="Gaussian_Pressure_Diastole_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Layak']['Pressure_Diastole'] }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Pressure_Diastole_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Pressure_Diastole_Tidak_Layak" id="Gaussian_Pressure_Diastole_Tidak_Layak" value="{{ $Result_Classification[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}" readonly>
                                            </div>   
                                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection