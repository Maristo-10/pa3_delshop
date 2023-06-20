@extends('layouts.frontend-login')

@section('content')
    <section class="section register d-flex flex-column align-items-center justify-content-center py-4 mt-3">
        <div class="container mt-5">
            <div class="row col-md-12 justify-content-center mt-5">
                <div class="col-lg-5 col-md-8 d-flex flex-column align-items-center ">
                    <div class="card m-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{session()->get('status')}}
                            </div>
                        @endif
                        <div class="card mb-3 mt-3">
                            <div class="card-body">
                                <div class="row mb-3 text-center">
                                    <div class="col">
                                        <a href="{{ asset('/') }}"><img src={{ asset('imageStatis/del-shop.png') }}
                                                alt="" style="width: 150px; "></a>
                                    </div>
                                </div>
                                <div class="pt-4 pb-2">
                                    <h1 class="card-title text-center pb-0 fs-4">Reset Password</h1>
                                    <p class="text-center small">Masukkan email anda untuk melakukan reset password!</p>
                                </div>

                                <form class="row g-3 needs-validation" action="{{ route('password-update')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="token" id="token" value={{ $token}}>

                                    <div class="col-12">
                                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                                        <div class="input-group has-validation">
                                            <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <div class="input-group has-validation">
                                            <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                            <input id="password" type="password"
                                                class="form-control" name="password" required >
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPasswordConfirmation" class="form-label">Password Confirmation</label>
                                        <div class="input-group has-validation">
                                            <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                            <input id="password_confirmation" type="password"
                                                class="form-control" name="password_confirmation" required >
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('Update Password') }}
                                        </button>
                                    </div>
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
