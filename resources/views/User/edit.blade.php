<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Manajement Dashboard Edit User</title>
</head>
<body>
    <form action="{{ route('users.update', $user_data->id) }}" method="post">
        @method('PATCH')
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        Edit Akun User
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ $user_data->name }}">
                                    <label for="name">Nama Lengkap</label>
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="NIK" id="NIK" class="form-control @error('NIK') is-invalid @enderror" placeholder="Nomor Induk Kependudukan" value="{{ $user_data->NIK }}" >
                                    <label for="NIK">Nomor Induk Kependudukan</label>
                                    @error('NIK')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-check form-check-inline">
                                    <label for="Laki-laki" class="form-check-label">Laki-laki</label>
                                    <input type="radio" name="Gender" id="Laki-laki" class="form-check-input  @error('Gender') is-invalid @enderror" value="Laki-laki" {{ ($user_data->Gender == "Laki-laki") ? "checked" : "" }}>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label for="Perempuan" class="form-check-label">Perempuan</label>
                                    <input type="radio" name="Gender" id="Perempuan" class="form-check-input  @error('Gender') is-invalid @enderror" value="Perempuan" {{ ($user_data->Gender == "Perempuan" ? "checked" : "") }}>
                                </div>
                                @error('Gender')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
    
                            <div class="col-md-5">
                                <div class="form-floating">
                                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="1" placeholder="Alamat Tinggal (Sesuai KTP)">{{ $user_data->alamat }}</textarea>
                                    <label for="alamat">Alamat Tinggal (Sesuai KTP)</label>
                                    @error('alamat')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-md-5">
                                <div class="form-floating">
                                    <input type="text" name="phone_number" id="phone_number" placeholder="Nomor Handphone/Whatsapp" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $user_data->phone_number }}">
                                    <label for="phone_number">Nomor Handphone/Whatsapp</label>
                                    @error('phone_number')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-md-12">
                                <div class="input-group">
                                    <label for="profile_picture" class="input-group-text">Upload Profile</label>
                                    <input type="file" name="profile_picture" id="profile_picture" class="form-control" value="{{ $user_data->profile_picture }}">
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" value="{{ $user_data->email }}">
                                    <label for="email">Alamat Email</label>
                                    @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                    <label for="password">Password</label>
                                    @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select name="roles" id="roles" class="form-select @error('roles') is-invalid @enderror">
                                        @foreach ($role_name as $roles)
                                            <option value="{{ $roles->id }}" {{ $user_role == $roles->name ? 'selected' : '' }}>{{ $roles->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="roles">Pilih Role User</label>
                                    @error('roles')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
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