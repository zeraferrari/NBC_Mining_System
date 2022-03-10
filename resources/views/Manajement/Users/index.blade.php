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
                                            <td>{{ $data_users->Status_Donor }}</td>
                                            <td>
                                                <div class="buttons text-center">
                                                    <form action="{{ route('Manajement.Users.delete', $data_users->id) }}" method="POST">
                                                        <a href="{{ route('Manajement.Users.show', $data_users->NIK) }}" class="btn btn-icon btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('Manajement.Users.edit', $data_users->NIK) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
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
        </div>
    </section>
@endsection