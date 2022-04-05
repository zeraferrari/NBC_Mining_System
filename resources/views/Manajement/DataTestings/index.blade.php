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
                                                    <form action="{{ route('Manajement.DataTestings.delete', $data_testings->id) }}" method="POST">
                                                        <a href="{{ route('Manajement.DataTestings.show', $data_testings->id) }}" class="btn btn-icon btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('Manajement.DataTestings.edit', $data_testings->id) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
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
        </div>
    </section>
@endsection