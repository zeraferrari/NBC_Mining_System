@extends('layouts.Main_Dashboard')

@section('Main_Content')
    <main id="main">
        <section id="section-opening" class="bg-img row justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Setting Akun</h5>
                                <form action="{{ route('UpdateSettingsAccount', $data_user->NIK) }}" method="POST" enctype="multipart/form-data" id="{{ $data_user->NIK }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="col-sm-6 offset-sm-4 col-md-6 offset-md-5 col-lg-6 offset-lg-5">
                                        @if($data_user->profile_picture)
                                            <img src="{{ asset('storage/'.$data_user->profile_picture) }}" alt="image" class="align-self-center mr-5 mb-5 rounded-circle img-preview" width="100" height="100">
                                         @else
                                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="image" class="align-self-center mr-5 mb-5 rounded-circle img-preview" width="100" height="100">
                                        @endif
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label for="Name">Nama</label>
                                            <input class="form-control" type="text" name="Name" id="Name" value="{{ $data_user->name }}" disabled>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label for="NIK">Nomor Induk Kewarganegaraan (NIK)</label>
                                            <input class="form-control" type="text" name="NIK" id="NIK" value="{{ $data_user->NIK }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <div class="col-form-label text-dark pt-0 pb-0 mb-3">Jenis Gender</div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input @error('Gender') is-invalid @enderror" name="Gender" id="Laki-laki" value="Laki-laki"  @if($data_user->Gender === 'Laki-laki') checked @endif>
                                                <label for="Laki-laki" class="form-check-label">Laki-Laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input @error('Gender') is-invalid @enderror" name="Gender" id="Perempuan" value="Perempuan" @if($data_user->Gender === 'Perempuan') checked @endif>
                                                <label for="Perempuan" class="form-check-label">Perempuan</label>
                                            </div>
                                            @error('Gender')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label for="PhoneNumber">Nomor Telepon/Whatsapp</label>
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="PhoneNumber" value="{{ $data_user->phone_number }}">
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                            <label for="profile_picture" class="form-label">Gambar Profil</label>
                                            <input type="hidden" name="oldImage" value="{{ $data_user->profile_picture }}">
                                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture" id="profile_picture" onchange="PreviewImage()">
                                            @error('profile_picture')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="email" name="email" value="{{ $data_user->email }}" disabled>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ $data_user->alamat }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>  
                                    </div>
                                </form>
                                <div class="buttons">
                                    <button class="btn btn-primary col-12 confirmation-update" type="submit" data-NIK="{{ $data_user->NIK }}">Perbaharui Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('SweetAlert')
    <script>
        $(".confirmation-update").click(function(e) {
        let DataNikTarget = $(this).attr('data-NIK');
        Swal.fire({
            title: 'Data yakin akan diperbaharui ?',
            // html: 'Data user atas nama <b>'+DataNameTarget+'</b> akan diupdate !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#04cf1f',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update Data'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#${DataNikTarget}`).submit();
            }
        })
    });
    </script>
    @if(Session::has('Status_Success'))
        <script>
            let success_message_update = '{!! Session::get('Status_Success') !!}';
            Swal.fire({
                icon: 'success',
                title: 'Data berhasil diperbaharui !',
                html: success_message_update,
                showCloseButton: true,
                showConfirmButton: false,
                timer: 4000
            })
        </script>
    @endif
@endsection