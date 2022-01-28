<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Manajement Dashboard Buat Hak Akses</title>
</head>
<body>
    <form action="{{ route('permission.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        Buat Hak Akses
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}">
                                    <label for="name">Nama Hak Akses</label>
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary col-md-12 mx-auto">Buat Hak Akses</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>