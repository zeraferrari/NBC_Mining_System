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
                                            <h5 class="mb-1">Role Administrator</h5>
                                        </div>
                                        <p>Hak akses yang diberikan antara lain : </p>
                                        <ol style="padding-left: 15px;">
                                            <li>Mengakses Dashboard Master</li>
                                            <li>Membuat Role Baru</li>
                                            <li>Mengupdate Detail Role</li>
                                            <li>Menghapus Role</li>
                                            <li>Membuat Hak Akses Role</li>
                                            <li>Mengupdate Hak Akses Role</li>
                                            <li>Menghapus Hak Akses Role</li>
                                            <li>Membuat Kategori Rhesus Baru</li>
                                            <li>Mengupdate Kategori Rhesus</li>
                                            <li>Menghapus Kategori Rhesus</li>
                                            <li>Membuat Akun User Baru</li>
                                            <li>Melihat Detail Akun User</li>
                                            <li>Mengupdate Akun User</li>
                                            <li>Menghapus Akun User</li>
                                            <li>Membuat Data Training</li>
                                            <li>Mengupdate Data Training</li>
                                            <li>Menghapus Data Training</li>
                                            <li>Membuat Data Testing</li>
                                            <li>Mengupdate Data Testing</li>
                                            <li>Melihat Detail Data Testing</li>
                                            <li>Menghapus Data Testing</li>
                                            <li>Melihat Detail Hasil Klasifikasi Donor</li>
                                            <li>Ngeprint hasil klasifikasi detail donor darah</li>
                                        </ol>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Role Petugas Medis</h5>
                                        </div>
                                        <p>Hak akses yang diberikan antara lain : </p>
                                        <ol style="padding-left: 15px;">
                                            <li>Melakukan Transaksi Donor</li>
                                            <li>Mengupdate Transaksi Donor</li>
                                            <li>Melihat Detail Hasil Klasifikasi Donor</li>
                                            <li>Mendownload Data PDF Hasil Klasifikasi</li>
                                        </ol>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Role Pendonor</h5>
                                        </div>
                                        <p>Hak akses yang diberikan antara lain : </p>
                                        <ol style="padding-left: 15px;">
                                            <li>Melakukan Transaksi Donor</li>
                                        </ol>
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
                                        @if(old('Rhesus_id') == $data_rhesus->id)
                                           <option value="{{ $data_rhesus->id }}" selected>{{ $data_rhesus->Name }}</option>                                    
                                        @else
                                            <option value="{{ $data_rhesus->id }}">{{ $data_rhesus->Name }}</option>
                                        @endif
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
                                        @if(old('roles') == $roles->id)
                                            <option value="{{ $roles->id }}" selected>{{ $roles->name }}</option>
                                        @else
                                            <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                        @endif
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