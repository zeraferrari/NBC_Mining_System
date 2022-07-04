@extends('layouts.Main_Manajement')

    @section('Main_Content')
        <section class="section">
            <div class="section-header">
                <h1>Manajement Dashboard Role</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                    <div class="breadcrumb-item"><span>Roles</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-reset">Tabel Role</h4>
                            <div class="card-header-form">
                                <a href="{{ Route('Manajement.Roles.create') }}" class="badge badge-success rounded-sm"><i class="fas fa-plus-circle"></i> Buat Role</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="DataTables">
                                <thead class="thead-light align-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Role</th>
                                        <th scope="col">Hak Akses</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $roles)
                                        <tr>
                                            <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $roles->name }}</td>
                                            <td>
                                                @foreach ($roles->permissions as $permissions)
                                                    <label for="permissions" class="badge badge-info rounded-sm">{{ $permissions->name }}</label>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="buttons">
                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger confirmation-delete" data-Name="{{ $roles->name }}" data-id="{{ $roles->id }}"><i class="fas fa-trash-alt"></i></button>
                                                    <a href="{{ route('Manajement.Roles.edit', $roles->id) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('Manajement.Roles.delete', $roles->id) }}" id="{{ $roles->id }}" method="POST">
                                                        @method('DELETE')
                                                        {{ csrf_field() }}
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
                id = e.target.dataset.id;
                let GetDataName = $(this).attr('data-Name');
                Swal.fire({
                    title: 'Yakin Data Akan Di Hapus ?',
                    html: "Role dengan nama <b>"+GetDataName+"</b> akan dihapus",
                    icon: 'warning',
                    iconColor: 'red',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Iya, Hapus Data',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#${id}`).submit();
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