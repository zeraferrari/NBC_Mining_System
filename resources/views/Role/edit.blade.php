<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Manajement Dashboard Edit Role</title>
</head>
<body>
    <form action="{{ route('role.update', $data_roles->id) }}" method="post">
        @method('PATCH')
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        Edit Roles
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ $data_roles->name }}">
                                    <label for="name">Nama Roles</label>
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                       @foreach ($data_permissions as $permission)
                            <div class="form-check">
                                <input type="checkbox" name="permission[]" id="permission_{{ $permission->id }}" class="form-check-input" value="{{ $permission->id }}"
                                @foreach ($permissions_each_role as $permission_id)
                                    @if ($permission->id == $permission_id)
                                        checked
                                    @endif
                                @endforeach> 
                                <label for="permission_{{ $permission->id }}" class="form-check-label">
                                    {{ $permission->name }}
                                </label>
                            </div>
                       @endforeach
                            <button type="submit" class="btn btn-primary col-md-12 mx-auto">Edit Hak Akses</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>