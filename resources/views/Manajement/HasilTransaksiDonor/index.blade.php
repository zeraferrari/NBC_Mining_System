@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Manajement Hasil Transaksi Donor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><span>Hasil Transaksi Donor</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Tabel Hasil Transaksi</h4>
                        <div class="card-header-form">
                            <button class="badge badge-primary rounded-sm" data-toggle="collapse" type="button" data-target="#HasilTransaksi" aria-expanded="false" aria-controls="HasilTransaksi">Tampilkan</button>
                        </div>
                    </div>
                    <div class="collapse" id="HasilTransaksi">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="TabelTransaksiDonor">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6 col-md-5 col-lg-5 form-group">
                                            <label for="FromDate">Dari Tanggal</label>
                                            <input type="text" class="form-control" name="FromDate" id="FromDate">
                                        </div>
                                        <div class="col-sm-6 col-md-5 col-lg-5 form-group">
                                            <label for="ToDate">Sampai Tanggal</label>
                                            <input type="text" class="form-control" name="ToDate" id="ToDate">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-5">
                                        <a href="{{ route('Generated-PDF') }}" class="btn btn-md btn-danger col-sm-12 col-md-3 col-lg-3" id="PDF_Download">Download PDF</a>
                                        <a href="" class="btn btn-md btn-success col-sm-12 col-md-3 col-lg-3 offset-lg-1 offset-md-1">Download Excel</a>
                                        <a href="" class="btn btn-md btn-warning col-sm-12 col-md-3 col-lg-3 offset-lg-1 offset-md-1">Print</a>
                                    </div>
                                    <thead class="thead-light align-center">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Nama Pendonor Darah</th>
                                            <th scope="col">NIK</th>
                                            <th scope="col">Petugas yang menangani</th>
                                            <th scope="col">Waktu Mendonor</th>
                                            <th scope="col">Kembali Mendonor</th>
                                            <th scope="col">Status Donor</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result_transaction as $result_transactions)
                                            <tr>
                                                <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $result_transactions->Code_Transaction }}</td>
                                                <td>{{ $result_transactions->User_Connection->name ?? ''}}</td>
                                                <td>{{ $result_transactions->User_Connection->NIK }}</td>
                                                <td>{{ $result_transactions->Petugas_Connection->name ?? ''}}</td>
                                                <td>{{ $result_transactions->Waktu_Donor}}</td>
                                                <td>{{ $result_transactions->Kembali_Donor}}</td>
                                                <td>
                                                    @if($result_transactions['Status_Donor'] === 'Berhasil Mendonor')
                                                        <span class="badge badge-success rounded">{{ $result_transactions->Status_Donor }}</span>
                                                    @elseif($result_transactions['Status_Donor'] === 'Gagal Donor')
                                                        <span class="badge badge-danger rounded">{{ $result_transactions->Status_Donor }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="buttons text-center">
                                                        <a href="{{ route('Manajement.Hasil_Transaksi_Donor.show', $result_transactions->Code_Transaction ?? 'Unknown') }}" class="btn btn-icon btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('Manajement.Hasil_Transaksi_Donor.Printout', $result_transactions->Code_Transaction ?? 'Unknown') }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-print"></i></a>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Tabel Hasil Klasifikasi</h4>
                        <div class="card-header-form">
                            <button class="badge badge-primary rounded-sm" data-toggle="collapse" type="button" data-target="#HasilKlasifikasi" aria-expanded="false" aria-controls="HasilKlasifikasi">Tampilkan</button>
                        </div>
                    </div>
                    <div class="collapse" id="HasilKlasifikasi">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="DataTables_2">
                                    <thead class="thead-light align-center">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Nama Pendonor Darah</th>
                                            <th scope="col">NIK</th>
                                            <th scope="col">Hasil Klasifikasi</th>
                                            <th scope="col">Status Donor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result_transaction as $result_transactions)
                                            <tr>
                                                <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $result_transactions->Code_Transaction }}</td>
                                                <td>{{ $result_transactions->User_Connection->name }}</td>
                                                <td>{{ $result_transactions->User_Connection->NIK }}</td>
                                                <td>
                                                    @if($result_transactions['Status_Transaction'] === 'Layak')
                                                        <span class="badge badge-success rounded">{{ $result_transactions->Status_Transaction }}</span>
                                                    @else
                                                        <span class="badge badge-danger rounded">{{ $result_transactions->Status_Transaction }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($result_transactions['Status_Donor'] === 'Berhasil Mendonor')
                                                        <span class="badge badge-success rounded">{{ $result_transactions->Status_Donor }}</span>
                                                    @elseif($result_transactions['Status_Donor'] === 'Gagal Donor')
                                                        <span class="badge badge-danger rounded">{{ $result_transactions->Status_Donor }}</span>
                                                    @endif
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
@endsection
@section('Filter')
    <script>
        // var minDate, maxDate;
        var minDate = document.getElementById("FromDate");
        var maxDate = document.getElementById("ToDate");

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[5] );
                if (
                    (min === null && max === null) ||
                    (min <= date && max >= date) ||
                    (min >= date && max === null) ||
                    (min === null && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            moment().locale('id-ID');
            // Create date inputs
            minDate = new DateTime($('#FromDate'), {
                format: 'DD/MM/YYYY'
            });
            
            maxDate = new DateTime($('#ToDate'), {
                format: 'DD/MM/YYYY'
            });
            var printCounter = 0;
            
            // console.log(FromDate);
            // DataTables initialisation
            var table = $('#TabelTransaksiDonor').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excelHtml5',
                        messageTop: 'Informasi Data Transaksi Pada Tanggal',
                        title: 'Data Hasil Transaksi Donor Darah'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: null,
                        title: 'Data Hasil Transaksi Donor Darah'
                    },
                    {
                        extend: 'print',
                        title: 'Data Hasil Transaksi Donor Darah',
                        messageTop: function () {
                            printCounter++;
        
                            if ( printCounter === 1 ) {
                                return 'Cetakan Dokumen Pertama';
                            }
                            else {
                                return 'Cetakan Dokumen Ke '+printCounter;
                            }
                        },
                        messageBottom: null
                    }
                ]
            });

        
            // Refilter the table
            $('#FromDate, #ToDate').on('change', function () {
                table.draw();
            });
        });

        
    </script>
@endsection