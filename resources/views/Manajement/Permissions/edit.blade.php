@extends('layouts.Main_Manajement')

@section('Main_Content')
<section class="section">
    <div class="section section-header">
        <h1>Edit/Update Data Hak Akses</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Master Data</a></div>
            <div class="breadcrumb-item"><a href="{{ route('Manajement.Permissions.index') }}">Hak Akses</a></div>
            <div class="breadcrumb-item"><span>Edit</span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-reset">Form Edit/Update Hak Akses</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('Manajement.Permissions.update', $data->id) }}" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                        <div class="form-group row mb-6">
                            <label for="name" class="col-form-label text-md-right col-md-3">Nama Hak Akses</label>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary btn-md col-sm-12 col-md-6 col-lg-6">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection