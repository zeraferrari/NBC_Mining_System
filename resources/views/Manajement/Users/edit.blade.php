@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Buat Akun User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Users.index') }}">User</a></div>
                <div class="breadcrumb-item"><span>Edit</span></div>
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
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data role baru</p>
                                        <p class="mb-0"><b>Read : </b> Memberikan hak akses untuk melihat detail data role</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data role</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data role</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Role Petugas Medis</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data hak akses baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data hak akses</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data hak akses</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Role Pendonor</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data kategori rhesus baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate rhesus</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data kategori rhesus</p>
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
                        <h4 class="text-reset">Edit/Update Akun User</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Manajement.Users.update', $user_data->NIK) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('PATCH')
                            <div class="media">
                                @if($user_data->profile_picture)
                                    <img src="{{ asset('storage/'.$user_data->profile_picture) }}" alt="image" class="align-self-center mr-5 mb-5 rounded-circle img-preview" width="100" height="100">
                                @else
                                    <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image" class="align-self-center mr-5 mb-5 rounded-circle img-preview" width="100" height="100">
                                @endif
                                <div class="media-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <td>Nama </td>
                                            <td>:</td>
                                            <td>{{ $user_data->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td>{{ $user_data->NIK }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{ $user_data->email }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user_data->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="NIK">NIK</label>
                                <input type="text" name="NIK" id="NIK" class="form-control @error('NIK') is-invalid @enderror" value="{{ $user_data->NIK }}" readonly>
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
                                        <input type="radio" class="form-check-input @error('Gender') is-invalid @enderror" name="Gender" id="Laki-laki" value="Laki-laki"  @if($user_data->Gender === 'Laki-laki') checked @endif>
                                        <label for="Laki-laki" class="form-check-label">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input @error('Gender') is-invalid @enderror" name="Gender" id="Perempuan" value="Perempuan" @if($user_data->Gender === 'Perempuan') checked @endif>
                                        <label for="Perempuan" class="form-check-label">Perempuan</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 pl-0 pr-0">
                                    <label for="profile_picture" class="form-label">Gambar Profile</label>
                                    <input type="hidden" name="oldImage" value="{{ $user_data->profile_picture }}">
                                    <input class="form-control @error('profile_picture') is-invalid @enderror" type="file" name="profile_picture" id="profile_picture" onchange="PreviewImage()">
                                    @error('profile_picture')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Nomor Telepon/Whatsapp</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" value="{{ $user_data->phone_number }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ $user_data->alamat }}</textarea>
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
                                    @foreach ($rhesus_data as $data_rhesus)
                                        <option value="{{ $data_rhesus->id }}" @if(($user_data->Rhesus_Connection->Name ?? '') === $data_rhesus->Name) selected @endif>{{ $data_rhesus->Name }}</option>
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
                                    @foreach ($roles_data as $data_roles)
                                        <option value="{{ $data_roles->id }}" @if(($user_data->roles[0]->name ?? '') === $data_roles->name) selected @endif>{{ $data_roles->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="col text-center">
                                <button class="btn btn-info btn-md col-sm-12 col-md-6 col-lg-6" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection