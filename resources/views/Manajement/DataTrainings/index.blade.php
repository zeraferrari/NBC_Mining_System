@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section section-header">
            <h1>Manajement Dashboard Data Training</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
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
                                                    <form action="{{ route('Manajement.DataTrainings.delete', $data_training->id) }}" method="POST">
                                                        <a href="{{ route('Manajement.DataTrainings.edit', $data_training->id) }}" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-edit"></i></a>
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