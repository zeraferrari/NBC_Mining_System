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
                                        <br>Nama : {{ $detail_transaction->Petugas_Connection->name ?? 'Tidak Diketahui' }}
                                        <br>{{ $detail_transaction->Petugas_Connection->roles[0]->name ?? 'Tidak Diketahui' }}
                                        <br>Gender : {{ $detail_transaction->Petugas_Connection->Gender ?? 'Tidak Diketahui' }}
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
                                    <br><strong>Total Jumlah Data Training =  {{ $Result_Classifier[0]->Total_Data_Trainings }}</strong>
                                    <br>Total Data <i>Class</i> <strong>Layak = {{ $Result_Classifier[0]->TotalValue_Class_Layak }}</strong> 
                                    <br>Total Data <i>Class</i> <strong>Tidak Layak = {{ $Result_Classifier[0]->TotalValue_Class_Tidak_Layak }}</strong> 
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <br>Hasil <i>Prior Probability Class</i> <strong>Layak = {{ $Result_Classifier[0]->Prior_Prob_Class_Layak }}</strong>
                                    <br>Hasil <i>Prior Probability Class</i> <strong>Tidak Layak = {{ $Result_Classifier[0]->Prior_Prob_Class_Tidak_Layak }}</strong>
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
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tidak Layak</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Mean_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
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
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tidak Layak</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Standar_Deviasi_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
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
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Layak']['Pressure_Diastole'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tidak Layak</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Age'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Weight'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Hemoglobin'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Pressure_Sistole'] }}</td>
                                                    <td>{{ $Result_Classifier[0]->Gaussian_Each_Class['Class_Tidak_Layak']['Pressure_Diastole'] }}</td>
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
                                    <input class="form-control" type="text" name="Result_Probability_Each_Attribute_Class_Layak" id="Result_Probability_Each_Attribute_Class_Layak" value="{{ $Result_Classifier[0]->Probability_All_Attribute_Each_Class['Class_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Each_Attribute_Class_Tidak_Layak">Hasil Probabilitas Setiap Attribute Berdasarkan Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Each_Attribute_Class_Tidak_Layak" id="Result_Probability_Each_Attribute_Class_Tidak_Layak" value="{{ $Result_Classifier[0]->Probability_All_Attribute_Each_Class['Class_Tidak_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Class_Layak">Hasil Akhir Probabilitas Berdasarkan Class Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Class_Layak" id="Result_Probability_Class_Layak" value="{{ $Result_Classifier[0]->Probability_Each_Class_Not_Normalization['Class_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Result_Probability_Class_Tidak_Layak">Hasil Akhir Probabilitas Berdasarkan Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Result_Probability_Class_Tidak_Layak" id="Result_Probability_Class_Tidak_Layak" value="{{ $Result_Classifier[0]->Probability_Each_Class_Not_Normalization['Class_Tidak_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Normalization_Class_Layak">Hasil Normalisasi Class Layak</label>
                                    <input class="form-control" type="text" name="Normalization_Class_Layak" id="Normalization_Class_Layak" value="{{ $Result_Classifier[0]->Probability_Each_Class_Normalization['Class_Layak'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="Normalization_Class_Tidak_Layak">Hasil Normalisasi Class Tidak Layak</label>
                                    <input class="form-control" type="text" name="Normalization_Class_Tidak_Layak" id="Normalization_Class_Tidak_Layak" value="{{ $Result_Classifier[0]->Probability_Each_Class_Normalization['Class_Tidak_Layak'] }}" readonly>
                                </div>
                            </div>
                            @if ($Result_Classifier[0]->Result_Classification == 'Layak')
                                <div class="alert alert-success">
                                    <i>*** Hasil Klasifikasi ***</i>
                                    <p>Dari perhitungan naive bayes classifier, hasil menunjukan bahwa nilai class layak lebih besar dari nilai
                                    class tidak layak. Maka, pendonor darah atas nama <b>{{ $detail_transaction->User_Connection->name }}</b> dinyatakan
                                    <b>Layak mendonorkan darah</b>    
                                    </p>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <i>*** Hasil Klasifikasi ***</i>
                                    <p>Dari perhitungan naive bayes classifier, hasil menunjukan bahwa nilai class tidak layak lebih besar dari nilai
                                    class layak. Maka, pendonor darah atas nama <b>{{ $detail_transaction->User_Connection->name }}</b> dinyatakan
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