<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <title>Manajement Dashboard Create Role User</title>
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
    <form action="{{ route('Manajement.Roles.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        Create Role
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Role">
                                    <label for="name">Nama Role</label>
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            @foreach ($data_permission as $data)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permission{{ $data->id }}" class="form-check-input big-checkbox" value="{{ $data->id }}">
                                    <label for="permission{{ $data->id }}" class="form-check-label">
                                        {{ $data->name }}
                                    </label>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary col-md-12 mx-auto">Create Role</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<script src="{{ asset('assets/js/bootstrap_431.min.js') }}"></script>
</body>
</html>