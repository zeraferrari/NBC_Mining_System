@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Edit/Update Data Testing</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.DataTestings.create') }}">Data Testing</a></div>
                <div class="breadcrumb-item"><span>Edit</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Form Edit/Update Data Testing</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Manajement.DataTestings.update', $data->id) }}" id="{{ $data->id }}" method="POST">
                            {{ csrf_field() }}
                            @method('PATCH')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Name">Nama Pendonor</label>
                                    <input type="text" name="Name" id="Name" class="form-control @error('Name') is-invalid @enderror" value="{{ $data->Name }}">
                                    @error('Name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="Rhesus">Kategori Rhesus</label>
                                    <select name="Rhesus_id" id="Rhesus" class="form-control @error('Rhesus_id') is-invalid @enderror">
                                        <option value="" selected disabled>-- Kategori Rhesus --</option>
                                            @foreach ($data_rhesus as $rhesus)
                                                <option value="{{ $rhesus->id }}" @if($data->Rhesus_Connection->Name == NULL) '' @elseif($data->Rhesus_Connection->Name === $rhesus->Name) selected @endif>{{ $rhesus->Name }}</option>
                                            @endforeach
                                    </select>
                                    @error('Rhesus_id')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="col-form-label text-dark pt-0 pb-0 mb-3">Jenis Gender</div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input @error('Gender') is-invalid @enderror" name="Gender" id="Laki-laki" value="Laki-laki" @if($data->Gender === 'Laki-laki') checked @else @endif>
                                        <label for="Laki-laki" class="form-check-label">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input @error('Gender') is-invalid @enderror" name="Gender" id="Perempuan" value="Perempuan" @if($data->Gender === 'Perempuan') checked @else @endif>
                                        <label for="Perempuan" class="form-check-label">Perempuan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        @error('Gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="Hemoglobin">Hemoglobin</label>
                                    <div class="input-group">
                                        <input type="text" name="Hemoglobin" id="Hemoglobin" class="form-control @error('Hemoglobin') is-invalid @enderror" value="{{ $data->Hemoglobin }}">
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
                                <div class="form-group col-md-4">
                                    <label for="Age">Umur</label>
                                    <input type="text" name="Age" id="Age" class="form-control @error('Age') is-invalid @enderror" value="{{ $data->Age }}">
                                    @error('Age')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Weight">Berat Badan</label>
                                    <div class="input-group">
                                        <input type="text" name="Weight" id="Weight" class="form-control @error('Weight') is-invalid @enderror" value="{{ $data->Weight }}">
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
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="Pressure_Sistole">Tekanan Sistole</label>
                                    <div class="input-group">
                                        <input type="text" name="Pressure_Sistole" id="Pressure_Sistole" class="form-control @error('Pressure_Sistole') is-invalid @enderror" value="{{ $data->Pressure_Sistole }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">mmHg</div>
                                        </div>
                                    </div>
                                    @error('Pressure_Sistole')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Pressure_Diastole">Tekanan Diastole</label>
                                    <div class="input-group">
                                        <input type="text" name="Pressure_diastole" id="Pressure_Diastole" class="form-control @error('Pressure_diastole') is-invalid @enderror" value="{{ $data->Pressure_diastole }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">mmHg</div>
                                        </div>
                                    </div>
                                    @error('Pressure_diastole')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Status">Status Donor</label>
                                    <select name="Status" id="Status" class="form-control @error('Status') is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih Status--</option>
                                        <option value="Layak" @if($data->Status === 'Layak') selected @else  @endif>Layak</option>
                                        <option value="Tidak Layak" @if($data->Status === 'Tidak Layak') selected @else  @endif>Tidak Layak</option>
                                    </select>
                                    @error('Status')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                        <div class="col text-center">
                            <button class="btn btn-primary btn-md col-sm-12 col-md-6 col-6 confirmation-update" data-id="{{ $data->id }}" data-Name="{{ $data->Name }}">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('SweetAlert')
    <script>
        $(".confirmation-update").click(function(e) {
        let DataNameTarget = $(this).attr('data-Name');
        id = e.target.dataset.id;
        Swal.fire({
            title: 'Data akan diubah ?',
            html: 'Data testing atas nama <b>'+DataNameTarget+'</b> akan diupdate !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#04cf1f',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update Data'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#${id}`).submit();
            }
        })
    });
    </script>
@endsection