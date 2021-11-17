<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Manajement Dashboard Buat User</title>
</head>
<body>
    <form action="{{ route('users.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        Buat Akun User
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}">
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
                                    <input type="text" name="NIK" id="NIK" class="form-control @error('NIK') is-invalid @enderror" placeholder="Nomor Induk Kependudukan" value="{{ old('NIK') }}">
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
                                    <input type="radio" name="Gender" id="Laki-laki" class="form-check-input  @error('Gender') is-invalid @enderror" value="Laki-laki">
                                </div>
                                <div class="form-check form-check-inline">
                                    <label for="Perempuan" class="form-check-label">Perempuan</label>
                                    <input type="radio" name="Gender" id="Perempuan" class="form-check-input  @error('Gender') is-invalid @enderror" value="Perempuan">
                                </div>
                                @error('Gender')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
    
                            <div class="col-md-5">
                                <div class="form-floating">
                                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="1" placeholder="Alamat Tinggal (Sesuai KTP)">{{ old('alamat') }}</textarea>
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
                                    <input type="text" name="phone_number" id="phone_number" placeholder="Nomor Handphone/Whatsapp" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                                    <label for="phone_number">Nomor Handphone/Whatsapp</label>
                                    @error('phone_number')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label for="profile_picture" class="input-group-text">Upload Profile</label>
                                    <input type="file" name="profile_picture" id="profile_picture" class="form-control" value="{{ old('profile_picture') }}">
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" value="{{ old('email') }}">
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

    
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select name="roles" id="roles" class="form-select @error('roles') is-invalid @enderror">
                                        <option value="" selected disabled>-</option>
                                        @foreach ($role_name as $roles)
                                            <option value="{{ $roles->id }}">{{ $roles->name }}</option>
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

                            <button type="submit" class="btn btn-primary col-md-6 mx-auto">Buat Akun</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>