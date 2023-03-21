<<<<<<< HEAD
@extends('layouts.frontend-auth')
=======
@extends('layouts.frontend-login')
>>>>>>> 4ce68c756b3583c79abb7178a98490991f606519

@section('content')
    <section class="section register d-flex flex-column align-items-center justify-content-center py-4 mt-3">
        <div class="container mt-5">
            <div class="row col-md-12 justify-content-center mt-5">
                <div class="col-lg-5 col-md-8 d-flex flex-column align-items-center ">
                    <div class="card mb-2">
                            <div class="card mb-3 mt-3">

                                <div class="card-body">

                                    <div class="row mb-3 text-center">
                                        <div class="col">
<<<<<<< HEAD
                                            <a href="{{asset('/')}}"><img src={{ asset('imageStatis/del-shop.png') }} alt=""
=======
                                            <a href="{{asset('/home')}}"><img src={{ asset('imageStatis/del-shop.png') }} alt=""
>>>>>>> 4ce68c756b3583c79abb7178a98490991f606519
                                                style="width: 150px; "></a>
                                        </div>
                                        {{-- <div class="col-md-7 mt-3">
                                            <span class="d-none d-lg-block">
                                                <p style="text-align:center">DELSHOP</p>
                                            </span>
                                        </div> --}}
                                    </div>
                                    <div class="pt-4 pb-2">
                                        <h1 class="card-title text-center pb-0 fs-4">Masuk</h1>
                                        <p class="text-center small">Mohon Input email dan password anda!</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <span class="bi bi-lock input-group-text" id="inputGroupPrepend"></span>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="pt-4 pb-3 px-5 jus">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-secondary w-100">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                        <div class=" row col-12 justify-content-center mt-3">
                                            <p >Belum Punya Akun? <a href="{{ route('register') }}" class="btn text-secondary">Buat Akun</a></p>
                                        </div>
                                        {{-- <div class="row col-12 justify-content-center text-secondary">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
