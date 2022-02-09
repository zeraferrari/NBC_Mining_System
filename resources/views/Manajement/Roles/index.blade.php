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
                                                    <form action="{{ route('Manajement.Roles.delete', $roles->id) }}" method="POST">
                                                        <a href="" class="btn btn-icon btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('Manajement.Roles.edit', $roles->id) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                        @method('DELETE')
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
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