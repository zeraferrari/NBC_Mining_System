@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Buat Akun User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Users.index') }}">User</a></div>
                <div class="breadcrumb-item"><span>Create</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="accordion mb-0">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#guideline_permissions" aria-expanded="true">
                                <h4 class="text-center">Panduan Role Akun</h4>
                            </div>
                            <div class="accordian-body collapse show" id="guideline_permissions" data-parent=".accordion">
                                <div class="list-group">
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Roles Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data role baru</p>
                                        <p class="mb-0"><b>Read : </b> Memberikan hak akses untuk melihat detail data role</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data role</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data role</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Permission Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data hak akses baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data hak akses</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data hak akses</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Rhesus Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data kategori rhesus baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate rhesus</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data kategori rhesus</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">User Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data user atau pengguna baru</p>
                                        <p class="mb-0"><b>Read : </b> Memberikan hak akses untuk melihat detail data user atau pengguna baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data user atau pengguna sistem</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data user atau pengguna sistem</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Data Training Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data training baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data training</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data training</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Antrian Donor Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data pengajuan donor darah</p>
                                        <p class="mb-0"><b>Read : </b> Memberikan hak akses untuk melihat detail data pengajuan donor darah</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data pengajuan donor darah</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data pengajuan donor darah</p>
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
                        <h4 class="text-reset">Buat Akun User</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Manajement.Users.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="NIK">NIK</label>
                                <input type="text" name="NIK" id="NIK" class="form-control @error('NIK') is-invalid @enderror" value="{{ old('NIK') }}">
                                @error('NIK')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 pl-0 pr-0">
                                    <div class="col-form-label text-dark pt-0 pb-0 mb-3">Jenis Gender</div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input @error('Gender') is-invalid @enderror" name="Gender" id="Laki-laki" value="Laki-laki"  @if(old('Gender') === 'Laki-laki') checked @endif>
                                        <label for="Laki-laki" class="form-check-label">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input @error('Gender') is-invalid @enderror" name="Gender" id="Perempuan" value="Perempuan" @if(old('Gender') === 'Perempuan') checked @endif>
                                        <label for="Perempuan" class="form-check-label">Perempuan</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 pl-0 pr-0">
                                    <label for="profile_picture" class="form-label">Gambar Profile</label>
                                    <input class="form-control @error('profile_picture') is-invalid @enderror" type="file" name="profile_picture" id="profile_picture">
                                    @error('profile_picture')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Nomor Telepon/Whatsapp</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Rhesus">Kategori Rhesus</label>
                                <select name="Rhesus_id" id="Rhesus" class="form-control @error('Rhesus_id') is-invalid @enderror">
                                        <option value="" selected disabled>-- Jenis Rhesus --</option>
                                    @foreach ($rhesus as $data_rhesus)
                                        <option value="{{ $data_rhesus->id }}">{{ $data_rhesus->Name }}</option>
                                    @endforeach
                                </select>
                                @error('Rhesus_id')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="roles">Kategori Role Akun</label>
                                <select name="roles" id="roles" class="form-control @error('roles') is-invalid @enderror">
                                        <option value="" selected disabled>-- Akun Role --</option>
                                    @foreach ($data_role as $roles)
                                        <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Konfirmasi Password</label>
                                <input class="form-control @error('password-confirm') is-invalid @enderror" type="password" name="password_confirmation">
                            </div>
                            <div class="col text-center">
                                <button class="btn btn-info btn-md col-sm-12 col-md-6 col-lg-6" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection