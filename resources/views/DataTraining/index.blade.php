@extends('layouts.app')
@section('content')
    <div class="container">   
        <div class="d-grip gap-2 d-md-flex justify-content-md-end mb-2">
            <a href="" class="btn btn-primary me-md-2">Buat Data Training</a>
        </div>
        
        <table class="table table-hover" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Rhesus Darah</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data_training as $data)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td scope="row">{{ $data->Name }}</td>
                        <td scope="row">{{ $data->Gender }}</td>
                        <td scope="row">{{ $data->Rhesus_Connection->Name }}</td>
                        <td scope="row">{{ $data->Status }}</td>
                        <td>
                            <form action="" method="POST">
                                <a href="" class="badge bg-primary"><i class="far fa-eye"></i></a>
                                <a href="" class="badge bg-warning"><i class="far fa-edit"></i></a>
                                <button type="submit" class="badge bg-danger"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection  
