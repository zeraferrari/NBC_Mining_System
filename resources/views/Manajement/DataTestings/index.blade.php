@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Manajement Dashboard Data Testing</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><span>Data Testing</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Tabel Data Testing</h4>
                        <div class="card-header-form">
                            <a href="{{ route('Manajement.DataTestings.create') }}" class="badge badge-success rounded-sm"><i class="fas fa-plus-circle"> Buat Data Testing</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="DataTables">
                                <thead class="thead-light align-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Golongan Darah</th>
                                        <th scope="col">Hasil Aktual</th>
                                        <th scope="col">Hasil Klasifikasi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data_testings)
                                        <tr>
                                            <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $data_testings->Name }}</td>
                                            <td>{{ $data_testings->Gender }}</td>
                                            <td>{{ $data_testings->Rhesus_Connection->Name }}</td>
                                            <td>{{ $data_testings->Status }}</td>
                                            <td>{{ $data_testings->Result_Classification ?? 'Tidak Diketahui'}}</td>
                                            <td>
                                                <div class="buttons">
                                                    <form action="{{ route('Manajement.DataTestings.delete', $data_testings->id) }}" id="{{ $data_testings->id }}" method="POST">
                                                        @method('DELETE')
                                                        {{ csrf_field() }}
                                                    </form>
                                                    <a href="{{ route('Manajement.DataTestings.show', $data_testings->id) }}" class="btn btn-icon btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('Manajement.DataTestings.edit', $data_testings->id) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger confirmation-delete" data-id="{{ $data_testings->id }}" data-Name="{{ $data_testings->Name }}"><i class="fas fa-trash-alt"></i></button>
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
    </section>
@endsection
@section('SweetAlert')
    @if(Session::has('success_created'))
        <script>
            let success_message_created = '{!! Session::get('success_created') !!}';
            Swal.fire({
                icon: 'success',
                titleText: 'Data Has Been Created',
                html: success_message_created,
                showCloseButton: true,
                showConfirmButton: false,
                timer: 4000
            })
        </script>
    @endif
    @if(Session::has('success_updated'))
        <script>
            let success_message_update = '{!! Session::get('success_updated') !!}';
            Swal.fire({
                icon: 'success',
                title: 'Data Successfully Update !',
                html: success_message_update,
                showCloseButton: true,
                showConfirmButton: false,
                timer: 4000
            })
        </script>
    @endif
    <script>
        $(".confirmation-delete").click(function(e) {
            let GetDataId = $(this).attr('data-id');
            let GetDataName = $(this).attr('data-Name');
            Swal.fire({
                title: 'Yakin Data Akan Di Hapus ?',
            html: "Data testing dengan nama <b>"+GetDataName+"</b> akan dihapus",
                icon: 'warning',
                iconColor: 'red',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Iya, Hapus Data',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#${GetDataId}`).submit();
                }
            })
        });
    </script>
    @if(Session::has('success_deleted'))
        <script>
            let success_message_deleted = '{!! Session::get('success_deleted') !!}';
            Swal.fire({
                icon: 'success',
                title: 'Data Successfully Deleted',
                html: success_message_deleted,
                showCloseButton: true,
                showConfirmButton: false,
                timer: 4000
            })
        </script>
    @endif
@endsection