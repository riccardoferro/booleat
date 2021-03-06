@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xxl-4 col-xl-7 col-md-6 order-md-1 order-sm-2 order-2 col-12 t4-jumbo-login">


                {{-- Form --}}

                <form class="row justify-content-center" method="POST" action="{{ route('login') }}">
                    @csrf
                    {{-- left side --}}
                    <div
                        class="col-xxl-12 col-xl-4 col-md-9 col-sm-10 order-xxl-1 order-xl-1 order-md-1 order-sm-1 order-1 t4-register-text">
                        <div class="row justify-content-sm-start">
                            <div class="d-md-flex flex-md-column align-items-md-center text-md-start t4-register-title mb-5">

                                <div class="col-xxl-5">
                                    <p>Login</p>
                                    <h2 class="fs-xl-1 fs-md-2 fs-sm-4">Accedi alla tua attività</h2>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div
                        class="col-xxl-10 col-xl-6 col-md-10 order-xxl-2 order-xl-2 order-md-2 order-sm-2 order-2 me-xxl-5">
                        <div class="form-group row flex-md-column align-items-md-center justify-content-center ">
                            <div class="col-xl-3 col-md-3 col-sm-3 col-4 mb-4">
                                <img src="/images/login.png" alt="logo-login">
                            </div>

                            <div class="col-xl-10 col-md-9 col-sm-10">
                                <label for="email" class="t4-text-orange mb-2">E-mail</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder='Inserisci E-mail'
                                    required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">


                            <div class="col-xl-10 col-md-9 col-sm-10">
                                <label for="password" class="t4-text-orange mb-2">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password" placeholder="Inserisci Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-xl-10 col-md-9 col-sm-10 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label t4-checkbox-text" for="remember">
                                        {{ __('Ricordami') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row flex-column mb-0 justify-content-center align-items-center t4-btn-group">
                            <div class="col-xl-4 col-md-4 col-5 d-flex flex-column">
                                <button type="submit" class="">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-xl-12 text-center">
                                @if (Route::has('password.request'))
                                    <a class="t4-forgot" href="{{ route('password.request') }}">
                                        {{ __('Hai dimenticato la password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>


            </div>
            <div class="col-xxl-4 col-xl-5 col-md-6 order-md-1 order-sm-2 order-2 col-12 t4-jumbo-register">
                <img src="/images/JumboLogin.webp" alt="Jumbotron-login">
            </div>
        </div>


    </div>
@endsection
