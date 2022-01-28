@extends('layouts.app')
@section('content')
    <div class="container">   
        <div class="d-grip gap-2 d-md-flex justify-content-md-end mb-2">
            <a href="{{ route('permission.create') }}" class="btn btn-primary me-md-2">Buat Permission</a>
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
                    <th scope="col">Deskripsi Akses</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $permission_data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $permission_data->name }}</td>
                    <td>
                        <form action="{{ route('permission.destroy', $permission_data->id) }}" method="POST">
                            <a href="" class="badge bg-primary"><i class="far fa-eye"></i></a>
                            <a href="{{ route('permission.edit', $permission_data->id) }}" class="badge bg-warning"><i class="far fa-edit"></i></a>
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button type="submit" class="badge bg-danger"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection  
