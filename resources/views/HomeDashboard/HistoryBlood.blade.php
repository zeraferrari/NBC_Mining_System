@extends('layouts.Main_Dashboard')

@section('Main_Content')
<main id="main">
    <section id="section-opening" class="bg-img row justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Riwayat Transaksi Donor Darah</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center" id="HistoryTransaction">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Tanggal Mendonor</th>
                                            <th>Kembali Donor</th>
                                            <th>Status Mendonor</th>
                                            <th>Petugas Yang Melayani</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($history_transaction_donor as $data_transactions)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data_transactions->Code_Transaction }}</td>
                                                <td>{{ $data_transactions->Waktu_Donor }}</td>
                                                <td>{{ $data_transactions->Kembali_Donor }}</td>
                                                <td>
                                                    @if ($data_transactions->Status_Donor == 'Berhasil Mendonor')
                                                        <span class="badge badge-success rounded">{{ $data_transactions->Status_Donor }}</span>
                                                    @elseif($data_transactions->Status_Donor == 'Medical Check')
                                                        <span class="badge badge-warning rounded">{{ $data_transactions->Status_Donor }}</span>
                                                    @else
                                                        <span class="badge badge-danger rounded">{{ $data_transactions->Status_Donor }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $data_transactions->Petugas_Connection->name ?? ''}}</td>
                                                <td>
                                                    <div class="buttons">
                                                        <a href="{{ route('checking_transaction', $data_transactions->Code_Transaction) }}" class="btn btn-icon btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                    </div>
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
        </div>
    </section>
</main>
@endsection
