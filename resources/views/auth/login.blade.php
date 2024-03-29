@extends('layouts.Main_Dashboard')


@section('Main_Content')
<main id="main" style="min-height: 90vh; background-size: cover; background-repeat: no-repeat; background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/img/blood-donate.jpg') }}');">
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-6">
               <div class="card rounded shadow-lg" style="top: 80px;">
                   <div class="card text-center">
                       <div class="card-body text-white rounded-top shadow-lg " style="background: linear-gradient(to right, #e20606ce, rgba(173, 64, 64, 0.5));">
                           <h5 class="card-title">Yudora</h5>
                           <img src="{{ asset('assets/img/unmul.png') }}" class=" img-fluid rounded float-left" alt="..." width="50px" height="50px">
                           <img src="{{ asset('assets/img/Red-Cross-PMI.png') }}" class=" img-fluid rounded float-right" alt="..." width="50px" height="50px">
                           <i class="card-text">"Yuk donor darah, karena satu kantung darah dapat menyelamatkan nyawa lainnya"</i>
                       </div>
                   </div>
                   <div class="card-body opacity-2">
                       <hr>
                       <h3 class="card-title text-center">{{ __('Login') }}</h3>
                       <hr>
                       <form method="POST" action="{{ route('login') }}">
                           {{ csrf_field() }} 
                        <div class="form-group row">
                          <label for="email" class="col-sm-3 col-form-label text-md-right">{{ __('Email atau NIK') }}</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control @error('email') is-invalid @enderror @error('message_fails') is-invalid @enderror" id="email" name="email">
                            @error('email')
                              <div class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </div>
                            @enderror
                            @error('message_fails')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first() }}</strong>
                                </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="password" class="col-sm-3 col-form-label text-md-right">{{ __('Password') }}</label>
                          <div class="col-sm-7">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                              <div class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="col text-center">
                            <button class="btn btn-primary btn-md col-sm-12 col-md-8 col-lg-8" type="submit">Login</button>
                        </div>
                      </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</main>
@endsection
@section('SweetAlert')
    @if(Session::has('response_login'))
        <script>
            let message_response = '{!! Session::get('response_login') !!}';
            Swal.fire({
                icon: 'success',
                title: 'Success Register',
                html: message_response,
                timer: 5000
            });
        </script>
    @endif
    @if(Session::has('response_failed'))
        <script>
            let message_response = '{!! Session::get('response_failed') !!}';
            Swal.fire({
                icon: 'success',
                title: 'Success Register',
                html: message_response,
                timer: 5000
            });
        </script>
    @endif
@endsection
