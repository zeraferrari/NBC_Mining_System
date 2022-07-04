@extends('layouts.Main_Manajement')

@section('Main_Content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Role User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('Manajement.Roles.index') }}">Roles</a></div>
                <div class="breadcrumb-item"><span>Edit</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="accordion mb-0">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#guideline_permissions" aria-expanded="true">
                                <h4 class="text-center">Panduan Hak Akses</h4>
                            </div>
                            <div class="accordian-body collapse show" id="guideline_permissions" data-parent=".accordion">
                                <div class="list-group">
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Roles Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data role baru</p>
                                        <p class="mb-0"><b>Read : </b> Memberikan hak akses untuk melihat detail data role</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data role</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data role</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Permission Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data hak akses baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data hak akses</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data hak akses</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Rhesus Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data kategori rhesus baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate rhesus</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data kategori rhesus</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">User Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data user atau pengguna baru</p>
                                        <p class="mb-0"><b>Read : </b> Memberikan hak akses untuk melihat detail data user atau pengguna baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data user atau pengguna sistem</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data user atau pengguna sistem</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Data Training Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data training baru</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data training</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data training</p>
                                    </div>
                                    <div class="list-group-item flex-column aligns-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Antrian Donor Section</h5>
                                        </div>
                                        <p class="mb-0"><b>Create : </b> Memberikan hak akses untuk membuat data pengajuan donor darah</p>
                                        <p class="mb-0"><b>Read : </b> Memberikan hak akses untuk melihat detail data pengajuan donor darah</p>
                                        <p class="mb-0"><b>Update : </b> Memberikan hak akses untuk memperbaharui atau mengupdate data pengajuan donor darah</p>
                                        <p class="mb-0"><b>Delete : </b> Memberikan hak akses untuk menghapus data pengajuan donor darah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-reset">Edit/Perbaharui Data Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Manajement.Roles.update', $data_roles->id) }}" id="{{ $data_roles->id }}" method="POST" class="test">
                            {{ csrf_field() }}
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Nama Role</label>
                                <input class="form-control @error ('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ $data_roles->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-4 row">
                                <div class="col-sm-3">Hak Akses</div>
                                <div class="col-sm-9">
                                    @foreach ($data_permissions as $permissions)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permission[]" id="customControlValidation_{{ $permissions->id }}" class="custom-control-input" value="{{ $permissions->id }}"
                                            @foreach ($permissions_each_role as $permission)
                                                @if ($permission === $permissions->id)
                                                    checked
                                                @endif
                                            @endforeach>
                                            <label for="customControlValidation_{{ $permissions->id }}" class="custom-control-label">{{ $permissions->name }}</label>
                                        </div>
                                    @endforeach
                                    <small class="text-danger">{{ $errors->first('permission') }}</small>
                                </div>
                            </div>
                        </form>
                        <div class="col text-center">
                            <button class="btn btn-primary btn-md col-md-12 confirmation-update" data-Name="{{ $data_roles->name }}" data-id="{{ $data_roles->id }}">Update Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('SweetAlert')
    <script>
        $(".confirmation-update").click(function(e) {
        let DataNameTarget = $(this).attr('data-Name');
        id = e.target.dataset.id;
        Swal.fire({
            title: 'Data akan diubah ?',
            html: 'Data role <b>'+DataNameTarget+'</b> akan diupdate !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#04cf1f',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update Data'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#${id}`).submit();
            }
        })
    });
    </script>
@endsection