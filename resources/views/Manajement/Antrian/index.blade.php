@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Manajement Antrian Transaksi Donor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><span>Antrian Transaksi</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Tabel Antrian Donor</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="DataTables">
                                <thead class="thead-light align-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Transaksi</th>
                                        <th scope="col">Nama Pendonor Darah</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Status Donor</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_transaction_user as $data_transaction)
                                        <tr>
                                            <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $data_transaction->Code_Transaction }}</td>
                                            <td>{{ $data_transaction->User_Connection->name }}</td>
                                            <td>{{ $data_transaction->User_Connection->NIK }}</td>
                                            <td>{{ $data_transaction->Status_Donor }}</td>
                                            <td>
                                            @can('Mengupdate Transaksi Donor')
                                                <div class="buttons text-center">
                                                    <a href="{{ route('Manajement.Transaction.edit', $data_transaction->Code_Transaction ?? '') }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                </div>
                                            @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>  
@endsection
@section('SweetAlert')
    <script>
        @if(Session::has('success_transaction'))
        let success_message_transaction = '{!! Session::get('success_transaction') !!}';
            Swal.fire({
                icon: 'success',
                title: 'Successfully Transaction !',
                html: success_message_transaction,
                showCloseButton: true,
                showConfirmButton: false,
                timer: 4000
            })
        @endif
    </script>
@endsection