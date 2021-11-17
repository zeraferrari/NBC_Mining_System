@extends('layouts.app')
@section('content')
    <div class="container">   
        <div class="d-grip gap-2 d-md-flex justify-content-md-end mb-2">
            <a href="{{ route('users.create') }}" class="btn btn-primary me-md-2">Buat User</a>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        
        <table class="table table-hover" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_user as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->NIK }}</td>
                        <td>
                            @if (!empty($data->getRoleNames()))
                                @foreach ($data->getRoleNames() as $role)
                                    <label for="role" class="badge bg-success">{{ $role }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $data->id) }}" method="POST">
                                <a href="" class="badge bg-primary"><i class="far fa-eye"></i></a>
                                <a href="{{ route('users.edit', $data->id) }}" class="badge bg-warning"><i class="far fa-edit"></i></a>
                                @method('DELETE')
                                {{ csrf_field() }}
                                <button type="submit" class="badge bg-danger"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection  
