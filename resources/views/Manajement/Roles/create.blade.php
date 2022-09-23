@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Buat Role User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Roles.index') }}">Roles</a></div>
                <div class="breadcrumb-item"><span>Create</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="accordion mb-0">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#guideline_permissions" aria-expanded="true">
                                <h4 class="text-center">Panduan Hak akses untuk role akun</h4>
                            </div>
                            <div class="accordian-body collapse show" id="guideline_permissions" data-parent=".accordion">
                                <div class="list-group">
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-center">
                                            <h5 class="mb-1">Hak Akses</h5>
                                        </div>
                                        <p>Setiap role untuk akun user tertentu yang akan dibuat harus memiliki hak akses tertentu sesuai dengan
                                            keperluan yang dibutuhkan, untuk hak akses dapat digunakan seluruhnya minimal menggunakan 1 hak akses
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Buat Data Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Manajement.Roles.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="has-float-label">
                                <label for="name">Nama Role</label>
                                <input type="text" id="name" class="form-control @error('name')is-invalid @enderror" name="name" placeholder="" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mt-4 row">
                                <div class="col-sm-3">Hak Akses</div>
                                <div class="col-sm-9">
                                    @foreach ($data_permission as $permissions)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permission[]" id="customControlValidation_{{ $permissions->id }}" class="custom-control-input @error('permission') is-invalid @enderror" value="{{ $permissions->id }}">
                                            <label for="customControlValidation_{{ $permissions->id }}" class="custom-control-label">{{ $permissions->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('permission')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col text-center">
                                <button class="btn btn-primary btn-md col-md-12" type="submit">Create Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection