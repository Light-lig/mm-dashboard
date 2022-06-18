@extends('layouts.app')

@section('content')
<style>
.bg-login-image {
  background: url("../img/mimotel.png") no-repeat center center;
  background-position: center;
  background-size: cover;
}

form.user .custom-checkbox.small label {
  line-height: 1.5rem;
}
form.user .form-control-user {
  font-size: 0.8rem;
  border-radius: 10rem;
  padding: 1rem 0.6rem;
}
form.user .btn-user {
  font-size: 0.8rem;
  border-radius: 10rem;
  padding: 0.75rem 1rem;
}

form.user .btn-user {
  font-size: 0.8rem;
  border-radius: 10rem;
  padding: 0.75rem 1rem;
}
</style>


    <div class="container">

        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">                    
                    <div class="card-body p-0">     
                                           
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="display-6">Bienvenido a </h1>
                                        <h1 class="display-5 mb-5 fw-bold">{{ config('app.name', 'Laravel') }}</h1>
                                    </div>
                                    <form method="POST" action="{{ route('admin.login') }}" class="user">
                                        @csrf
                                        <div class="form-group mb-4">                                                                                               
                                                <input id="usr_correo" type="email" class="form-control form-control-user @error('usr_correo') is-invalid @enderror"
                                                name="usr_correo" value="{{ old('usr_correo') }}" placeholder="Correo" required autocomplete="usr_correo" autofocus>
        
                                            @error('usr_correo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
            
                                        <div class="form-group mb-4">                                            
                                                <input id="password" type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password" placeholder="Contraseña">
        
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
            
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
        
                                                <label class="custom-control-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
            
                                        <div class="row my-4">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Login') }}
                                        </button>
                                        </div>
    
                                       <div class="text-center">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                       </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection