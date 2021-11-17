@extends('layouts.app')
    @section('content')
        <div class="container">   
            <div class="d-grip gap-2 d-md-flex justify-content-md-end mb-2">
                <button class="btn btn-primary me-md-2" type="button">Buat User</button>
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
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->Name }}</td>
                            <td>{{ $data->Gender }}</td>
                            <td>{{ $data->Rhesus_Connection->Name }}</td>
                            <td>{{ $data->Status }}</td>
                            <td>
                                <a href="" class="badge bg-primary"><i class="far fa-eye"></i></a>
                                <a href="" class="badge bg-warning"><i class="far fa-edit"></i></a>
                                <a href="" class="badge bg-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection  