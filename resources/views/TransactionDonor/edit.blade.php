<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Manajement Dashboard Update Transaksi Donor</title>
</head>
<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('transactions.update', $transaction_data->id)}}" method="post">
        @method('PATCH')
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        Update Transaksi Donor
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ $transaction_data->User_Connection->name }}">
                                    <label for="name">Nama Pendonor</label>
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="NIK" id="NIK" class="form-control @error('NIK') is-invalid @enderror" placeholder="Nomor Induk Kependudukan" value="{{ $transaction_data->User_Connection->NIK }}" >
                                    <label for="NIK">Nomor Induk Kependudukan</label>
                                    @error('NIK')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="Rhesus_category" id="Rhesus_category" class="form-select">
                                        <option value="" selected disabled>-</option>
                                        @foreach ($rhesus_data as $row_data)
                                            <option value="{{ $row_data->id }}" {{ ($transaction_data->User_Connection->Rhesus_Connection->Name ?? '') === $row_data->Name ? 'Selected' : '' }}>{{ $row_data->Name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="Rhesus_category">Pilih Kategori Rhesus</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="Age" id="Age" class="form-control" placeholder="Umur">
                                    <label for="Age">Umur</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="Weight" id="Weight" class="form-control" placeholder="Berat Badan" class="form-control">
                                    <label for="Weight">Berat Badan</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="Hemoglobin" id="Hemoglobin" class="form-control" placeholder="Hemoglobin">
                                    <label for="Hemoglobin">Kadar Hemoglobin</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="Pressure_sistole" id="Pressure_sistole" class="form-control" placeholder="Tekanan Sistole">
                                    <label for="Pressure_sistole">Tekanan Sistole</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="Pressure_diastole" id="Pressure_diastole" class="form-control" placeholder="Tekanan Sistole">
                                    <label for="Pressure_diastole">Tekanan Diastole</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary col-md-6 mx-auto">Update Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>