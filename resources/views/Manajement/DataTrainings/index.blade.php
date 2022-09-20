@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Manajement Dashboard Data Training</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><span>Data Training</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Tabel Data Trainings</h4>
                        <div class="card-header-form">
                            <a href="{{ route('Manajement.DataTrainings.create') }}" class="badge badge-success rounded-sm"><i class="fas fa-plus-circle"></i> Buat Data Training</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="DataTables">
                                <thead class="thead-light align-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pendonor</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Golongan Darah</th>
                                        <th scope="col">Hemoglobin</th>
                                        <th scope="col">Tekanan Sistole</th>
                                        <th scope="col">Tekanan Diastole</th>
                                        <th scope="col">Berat Badan</th>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data_training)
                                        <tr>
                                            <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $data_training->Name }}</td>
                                            <td>{{ $data_training->Gender }}</td>
                                            <td>{{ $data_training->Rhesus_Connection->Name }}</td>
                                            <td>{{ $data_training->Hemoglobin }}</td>
                                            <td>{{ $data_training->Pressure_Sistole }}</td>
                                            <td>{{ $data_training->Pressure_diastole }}</td>
                                            <td>{{ $data_training->Weight }}</td>
                                            <td>{{ $data_training->Age }}</td>
                                            <td>{{ $data_training->Status }}</td>
                                            <td>
                                                <div class="buttons">
                                                    <button class="btn btn-sm btn-icon btn-danger confirmation-delete" data-id="{{ $data_training->id }}" data-name="{{ $data_training->Name }}"><i class="fas fa-trash-alt"></i></button>
                                                    <a href="{{ route('Manajement.DataTrainings.edit', $data_training->id) }}" class="btn btn-sm btn-icon btn-warning"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('Manajement.DataTrainings.delete', $data_training->id) }}" id="{{ $data_training->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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
            let GetDataName = $(this).attr('data-name');
            let GetDataId = $(this).attr('data-id');
            Swal.fire({
                title: 'Yakin Data Akan Di Hapus ?',
                html: "Data training atas nama <b>"+GetDataName+"</b> akan dihapus",
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