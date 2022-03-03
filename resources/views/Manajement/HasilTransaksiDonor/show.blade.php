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
                                        <br>Berhasil Mendonor = <strong>{{ $data_success_transactions_user }}x</strong>
                                        <br>Gagal Mendonor = <strong>{{ $data_fails_transactions_user }}x</strong>
                                        <br>Total Untuk Mendonor = <strong>{{ $total_transactions_user }}x</strong>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Tanggal Mendonor : </strong>
                                        <strong>{{ $detail_transaction->Waktu_Donor }}</strong>
                                        <br><strong>Tanggal Kembali Mendonor : </strong>
                                        <strong>{{ $detail_transaction->Kembali_Donor }}</strong>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Data Transaksi Pendonor Darah</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="Age">Umur</label>
                                <input type="text" class="form-control" id="Age" name="Age" value="{{ $detail_transaction->Age }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Weight">Berat Badan</label>
                                <div class="input-group">
                                    <input type="text" name="Weight" id="Weight" class="form-control" value="{{ $detail_transaction->Weight }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">Kg</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Hemoglobin">Hemoglobin</label>
                                <div class="input-group">
                                    <input type="text" name="Hemoglobin" id="Hemoglobin" class="form-control" value="{{ $detail_transaction->Hemoglobin }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">g/dL</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Pressure_sistole">Tekanan Sistolik</label>
                                <div class="input-group">
                                    <input type="text" name="Pressure_sistole" id="Pressure_sistole" class="form-control" value="{{ $detail_transaction->Pressure_sistole }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">mmHg</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Pressure_diastole">Tekanan Distolik</label>
                                <div class="input-group">
                                    <input type="text" name="Pressure_diastole" id="Pressure_diastole" class="form-control" value="{{ $detail_transaction->Pressure_diastole }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">mmHg</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Status_Transaction">Status Transaksi Donor</label>
                                <input type="text" class="form-control" id="Status_Transaction" Status Transaksi Donor="Status_Transaction" value="{{ $detail_transaction->Status_Transaction }}" readonly>
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
                                    <br><strong>Total Jumlah Data Training =  {{ $total_data_training }}</strong>
                                    <br>Total Data <i>Class</i> <strong>Layak = {{ $total_data_class_layak }}</strong> 
                                    <br>Total Data <i>Class</i> <strong>Tidak Layak = {{ $total_data_class_tidak_layak }}</strong> 
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <br>Hasil <i>Prior Probability Class</i> <strong>Layak = {{ $result_prior_probability_class_layak }}</strong>
                                    <br>Hasil <i>Prior Probability Class</i> <strong>Tidak Layak = {{ $result_prior_probability_class_tidak_layak }}</strong>
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
                                                <input type="text" class="form-control" id="Mean_layak_Umur" name="Mean_layak_Umur" value="{{ $mean_atr_umur_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Umur"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Umur" name="Mean_tidak_layak_Umur" value="{{ $mean_atr_umur_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Umur"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Umur" id="Standar_Deviasi_Layak_Umur" value="{{ $standar_deviasi_atr_umur_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Umur"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Umur" id="Standar_Deviasi_Tidak_Layak_Umur" value="{{ $standar_deviasi_atr_umur_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Umur_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Umur_Layak" id="Gaussian_Umur_Layak" value="{{ $gaussian_atr_umur_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Umur_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Umur_Tidak_Layak" id="Gaussian_Umur_Tidak_Layak" value="{{ $gaussian_atr_umur_tidak_layak }}" readonly>
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
                                                <input type="text" class="form-control" id="Mean_layak_Berat_Badan" name="Mean_layak_Berat_Badan" value="{{ $mean_atr_bb_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Berat_Badan"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Berat_Badan" name="Mean_tidak_layak_Berat_Badan" value="{{ $mean_atr_bb_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Berat_Badan"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Umur" id="Standar_Deviasi_Layak_Umur" value="{{ $standar_deviasi_atr_bb_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Berat_Badan"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Berat_Badan" id="Standar_Deviasi_Tidak_Layak_Berat_Badan" value="{{ $standar_deviasi_atr_bb_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Berat_Badan_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Berat_Badan_Layak" id="Gaussian_Berat_Badan_Layak" value="{{ $gaussian_atr_bb_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Berat_Badan_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Berat_Badan_Tidak_Layak" id="Gaussian_Berat_Badan_Tidak_Layak" value="{{ $gaussian_atr_bb_tidak_layak }}" readonly>
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
                                                <input type="text" class="form-control" id="Mean_layak_Hemoglobin" name="Mean_layak_Hemoglobin" value="{{ $mean_atr_hemoglobin_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Hemoglobin"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Hemoglobin" name="Mean_tidak_layak_Hemoglobin" value="{{ $mean_atr_hemoglobin_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Hemoglobin"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Hemoglobin" id="Standar_Deviasi_Layak_Hemoglobin" value="{{ $standar_deviasi_atr_hemoglobin_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Hemoglobin"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Hemoglobin" id="Standar_Deviasi_Tidak_Layak_Hemoglobin" value="{{ $standar_deviasi_atr_hemoglobin_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Hemoglobin_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Hemoglobin_Layak" id="Gaussian_Hemoglobin_Layak" value="{{ $gaussian_atr_hemoglobin_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Hemoglobin_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Hemoglobin_Tidak_Layak" id="Gaussian_Hemoglobin_Tidak_Layak" value="{{ $gaussian_atr_hemoglobin_tidak_layak }}" readonly>
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
                                                <input type="text" class="form-control" id="Mean_layak_Pressure_Sistole" name="Mean_layak_Pressure_Sistole" value="{{ $mean_atr_pressure_sistole_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Pressure_Sistole"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Pressure_Sistole" name="Mean_tidak_layak_Pressure_Sistole" value="{{ $mean_atr_pressure_sistole_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Pressure_Sistole"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Pressure_Sistole" id="Standar_Deviasi_Layak_Pressure_Sistole" value="{{ $standar_deviasi_atr_pressure_sistole_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Pressure_Sistole"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Pressure_Sistole" id="Standar_Deviasi_Tidak_Layak_Pressure_Sistole" value="{{ $standar_deviasi_atr_pressure_sistole_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Pressure_Sistole_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Pressure_Sistole_Layak" id="Gaussian_Pressure_Sistole_Layak" value="{{ $gaussian_atr_pressure_sistole_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Pressure_Sistole_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Pressure_Sistole_Tidak_Layak" id="Gaussian_Pressure_Sistole_Tidak_Layak" value="{{ $gaussian_atr_pressure_sistole_tidak_layak }}" readonly>
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
                                                <input type="text" class="form-control" id="Mean_layak_Pressure_Diastole" name="Mean_layak_Pressure_Diastole" value="{{ $mean_atr_pressure_diastole_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Mean_tidak_layak_Pressure_Diastole"><strong><i>Mean (Class Tidak Layak)</i></strong></label>
                                                <input type="text" class="form-control" id="Mean_tidak_layak_Pressure_Diastole" name="Mean_tidak_layak_Pressure_Diastole" value="{{ $mean_atr_pressure_diastole_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Layak_Pressure_Diastole"><strong><i>Standar Deviasi (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Layak_Pressure_Diastole" id="Standar_Deviasi_Layak_Pressure_Diastole" value="{{ $standar_deviasi_atr_pressure_diastole_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Standar_Deviasi_Tidak_Layak_Pressure_Diastole"><strong><i>Standar Deviasi (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Standar_Deviasi_Tidak_Layak_Pressure_Diastole" id="Standar_Deviasi_Tidak_Layak_Pressure_Diastole" value="{{ $standar_deviasi_atr_pressure_diastole_tidak_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Pressure_Diastole_Layak"><strong><i>Distribusi Gaussian (Class Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Pressure_Diastole_Layak" id="Gaussian_Pressure_Diastole_Layak" value="{{ $gaussian_atr_pressure_diastole_layak }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Gaussian_Pressure_Diastole_Tidak_Layak"><strong><i>Distribusi Gaussian (Class Tidak Layak)</i></strong></label>
                                                <input class="form-control" type="text" name="Gaussian_Pressure_Diastole_Tidak_Layak" id="Gaussian_Pressure_Diastole_Tidak_Layak" value="{{ $gaussian_atr_pressure_diastole_tidak_layak }}" readonly>
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
                                    <input class="form-control" type="text" name="Result_Probability_Each_Attribute_Class_Layak" id="Result_Probability_Each_Attribute_Class_Layak" value="{{ $result_probability_each_attribute_class_layak }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Each_Attribute_Class_Tidak_Layak">Hasil Probabilitas Setiap Attribute Berdasarkan Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Each_Attribute_Class_Tidak_Layak" id="Result_Probability_Each_Attribute_Class_Tidak_Layak" value="{{ $result_probability_each_attribute_class_tidak_layak }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Class_Layak">Hasil Akhir Probabilitas Berdasarkan Class Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Class_Layak" id="Result_Probability_Class_Layak" value="{{ $result_probability_class_layak }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Class_Tidak_Layak">Hasil Akhir Probabilitas Berdasarkan Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Class_Tidak_Layak" id="Result_Probability_Class_Tidak_Layak" value="{{ $result_probability_class_tidak_layak }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Normalization_Class_Layak">Hasil Normalisasi Class Layak</label>
                                    <input class="form-control" type="text" name="Normalization_Class_Layak" id="Normalization_Class_Layak" value="{{ $result_normalization_class_layak }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Normalization_Class_Tidak_Layak">Hasil Normalisasi Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Normalization_Class_Tidak_Layak" id="Normalization_Class_Tidak_Layak" value="{{ $result_normalization_class_tidak_layak }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection