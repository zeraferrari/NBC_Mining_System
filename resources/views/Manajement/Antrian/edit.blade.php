@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Update Data Transaksi Mendonor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Transaction.index') }}">Antrian Transaksi</a></div>
                <div class="breadcrumb-item"><span>Edit</span></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Kode Transaksi : {{ $TransactionDonor->Code_Transaction }}</h2>
            <div class="card">
                <div class="card-header">
                    <h4 class="text-reset">History Transaksi Pendonor</h4>
                    <div class="card-header-form">
                        <button class="badge badge-primary rounded-sm" data-toggle="collapse" type="button" data-target="#HistoryTabel" aria-expanded="false" aria-controls="HistoryTabel">Tampilkan</button>
                    </div>
                </div>
                <div class="collapse" id="HistoryTabel">
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="DataTables">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Transaksi</th>
                                        <th scope="col">Waktu Donor</th>
                                        <th scope="col">Kembali Donor</th>
                                        <th scope="col">Status Donor</th>
                                        <th scope="col">Petugas yang menangani</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($history_transaction_user as $history_transactions)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $history_transactions->Code_Transaction }}</td>
                                            <td>{{ $history_transactions->Waktu_Donor }}</td>
                                            <td>{{ $history_transactions->Kembali_Donor }}</td>
                                            <td>{{ $history_transactions->Status_Donor }}</td>
                                            <td>{{ $history_transactions->Petugas_Connection->name ?? 'Error'}}</td>
                                            <td class="text-center">
                                                <a href="{{ route('Manajement.Hasil_Transaksi_Donor.show', $history_transactions->Code_Transaction ?? '') }}"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-sm-5">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            @if($TransactionDonor->User_Connection->profile_picture)
                                <img src="{{ asset('storage/'.$TransactionDonor->User_Connection->profile_picture) }}" alt="Gambar Profile" class="rounded-circle profile-widget-picture" style="height: 100px;">
                            @else
                                <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="Gambar Profile" class="rounded-circle profile-widget-picture">
                            @endif
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Berhasil Mendonor</div>
                                    <div class="profile-widget-item-value">{{ $data_success_transaction_user }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Gagal Mendonor</div>
                                    <div class="profile-widget-item-value">{{ $data_fails_transaction_user }}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Total Transaksi Donor</div>
                                    <div class="profile-widget-item-value">{{ $total_data_transaction_user }}</div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>{{ $TransactionDonor->User_Connection->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>NIK</td>
                                                <td>:</td>
                                                <td>{{ $TransactionDonor->User_Connection->NIK }}</td>
                                            </tr>
                                            <tr>
                                                <td>Golongan Darah</td>
                                                <td>:</td>
                                                <td>{{ $TransactionDonor->User_Connection->Rhesus_Connection->Name ?? 'Belum Diketahui' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>:</td>
                                                <td>{{ $TransactionDonor->User_Connection->Gender }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Whatsapp/Handphone</td>
                                                <td>:</td>
                                                <td>{{ $TransactionDonor->User_Connection->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td>{{ $TransactionDonor->User_Connection->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status Donor</td>
                                                <td>:</td>
                                                <td>{{ $TransactionDonor->User_Connection->Status_Donor }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-reset">Form Update Data Transaksi Donor Darah</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('Manajement.Transaction.update',$TransactionDonor->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="Rhesus_Categories">Kategori Rhesus</label>
                                    <select name="Rhesus_Categories" id="Rhesus_Categories" class="form-control @error('Rhesus_Categories') is-invalid @enderror">
                                        <option value="" selected disabled>-- Jenis Rhesus --</option>
                                        @foreach ($rhesus_data as $data_rhesus)
                                            <option value="{{ $data_rhesus->id }}" @if(($TransactionDonor->User_Connection->Rhesus_Connection->Name ?? '') === $data_rhesus->Name) selected @endif>{{ $data_rhesus->Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Rhesus_Categories')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Age">Umur</label>
                                    <input type="text" class="form-control @error('Age') is-invalid @enderror" id="Age" name="Age" value="{{ old('Age') }}">
                                    @error('Age')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Weight">Berat Badan</label>
                                    <div class="input-group">
                                        <input type="text" name="Weight" id="Weight" class="form-control @error('Weight') is-invalid @enderror" value="{{ old('Weight') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                        @error('Weight')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Hemoglobin">Hemoglobin</label>
                                    <div class="input-group">
                                        <input type="text" name="Hemoglobin" id="Hemoglobin" class="form-control @error('Hemoglobin') is-invalid @enderror" value="{{ old('Hemoglobin') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">g/dL</div>
                                        </div>
                                        @error('Hemoglobin')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Pressure_sistole">Tekanan Sistole</label>
                                    <div class="input-group">
                                        <input type="text" name="Pressure_sistole" id="Pressure_sistole" class="form-control @error('Pressure_sistole') is-invalid @enderror" value="{{ old('Pressure_sistole') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">mmHg</div>
                                        </div>
                                        @error('Pressure_sistole')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Pressure_diastole">Tekanan Diastole</label>
                                    <div class="input-group">
                                        <input type="text" name="Pressure_diastole" id="Pressure_diastole" class="form-control @error('Pressure_diastole') is-invalid @enderror" value="{{ old('Pressure_diastole') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">mmHg</div>
                                        </div>
                                        @error('Pressure_diastole')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Update Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 