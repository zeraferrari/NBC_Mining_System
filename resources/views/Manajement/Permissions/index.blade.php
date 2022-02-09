@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Manajement Dashboard Hak Akses</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><span>Hak Akses</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Tabel Hak Akses</h4>
                        <div class="card-header-form">
                            <a href="{{ Route('Manajement.Permissions.create') }}" class="badge badge-success rounded-sm"><i class="fas fa-plus-circle"></i> Buat Hak Akses</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="DataTables">
                            <thead class="thead-light align-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Hak Akses</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $permissions)
                                    <tr>
                                        <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $permissions->name }}</td>
                                        <td>
                                            <div class="buttons text-center">
                                                <form action="{{ route('Manajement.Permissions.delete', $permissions->id) }}" method="POST">
                                                    <a href="{{ route('Manajement.Permissions.edit', $permissions->id) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
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