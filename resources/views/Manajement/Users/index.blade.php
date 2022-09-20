@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Manajement Dashboard User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><span>User</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Tabel User</h4>
                        <div class="card-header-form">
                            <a href="{{ Route('Manajement.Users.create') }}" class="badge badge-success rounded-sm"><i class="fas fa-plus-circle"></i> Buat Akun User</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="DataTables">
                                <thead class="thead-light align-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Gender</th>
                                        <th scope="Col">Gambar Profile</th>
                                        <th scope="col">Golongan Darah</th>
                                        <th scope="col">Status Mendonor</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data_users)
                                        <tr>
                                            <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $data_users->name }}</td>
                                            <td>{{ $data_users->roles[0]->name }}</td>
                                            <td>{{ $data_users->NIK }}</td>
                                            <td>{{ $data_users->Gender }}</td>
                                            <td class="text-center">
                                                @if($data_users->profile_picture)
                                                    <img src="{{ asset('storage/'.$data_users->profile_picture) }}" alt="image" class="rounded" width="100" height="150">
                                                @else
                                                    <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image" class="rounded" width="35" height="35">
                                                @endif
                                            </td>
                                            <td>{{ $data_users->Rhesus_Connection->Name ?? 'Belum Diketahui' }}</td>
                                            <td>
                                                @if ($data_users['Status_Donor'] == 'Belum Mendonor')
                                                    <span class="badge badge-warning rounded">{{ $data_users->Status_Donor }}</span>
                                                @elseif ($data_users['Status_Donor'] == 'Sudah Mendonor')
                                                    <span class="badge badge-success rounded">{{ $data_users->Status_Donor }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="buttons">
                                                    <form action="{{ route('Manajement.Users.delete', $data_users->NIK) }}" id="{{ $data_users->NIK }}" method="POST">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                    </form>
                                                    <a href="{{ route('Manajement.Users.show', $data_users->NIK) }}" class="btn btn-icon btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('Manajement.Users.edit', $data_users->NIK) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-icon btn-sm btn-danger confirmation-delete" data-NIK="{{ $data_users->NIK }}" data-Name="{{ $data_users->name }}"><i class="fas fa-trash-alt"></i></button>
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
            let GetDataNIK = $(this).attr('data-NIK');
            let GetDataName = $(this).attr('data-Name');
            Swal.fire({
                title: 'Yakin Data Akan Di Hapus ?',
                html: "Data user dengan nama <b>"+GetDataName+"</b> akan dihapus",
                icon: 'warning',
                iconColor: 'red',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Iya, Hapus Data',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#${GetDataNIK}`).submit();
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