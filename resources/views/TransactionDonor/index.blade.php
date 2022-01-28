@extends('layouts.app')


@section('content')
<div class="container">   
    <div class="d-grip gap-2 d-md-flex justify-content-md-end mb-2">
       <form action="{{ route('transaction.store') }}" method="post">
            @csrf
            <button type="submit">Buat Transaction</button>
       </form>
    </div>
    
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pendonor</th>
                <th scope="col">Kode Transaksi</th>
                <th scope="col">NIK</th>
                <th scope="col">Rhesus Darah</th>
                <th scope="col">Status Donor</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_transaction_user as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->User_Connection->name }}</td>
                    <td>{{ $data->Code_Transaction }}</td>
                    <td>{{ $data->User_Connection->NIK }}</td>
                    <td>{{ $data->User_Connection->Rhesus_Connection->Name ?? '-'}}</td>
                    <td>{{ $data->Status_Donor }}</td>
                    <td>
                        <a href="" class="badge bg-primary"><i class="far fa-eye"></i></a>
                        <a href="{{ route('transaction.edit', $data->id ) }}" class="badge bg-warning"><i class="far fa-edit"></i></a>
                        <a href="" class="badge bg-danger"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection