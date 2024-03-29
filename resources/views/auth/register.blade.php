@extends('layouts.frontend-login')

@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 d-flex flex-column align-items-center justify-content-center">

                    <div class="card mb-3 mt-3">
                        {{-- <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div> --}}
                        <div class="card-body">
                            <div class="row mb-3 text-center">
                                <div class="col">
                                    <a href="/"><img src={{ asset('imageStatis/del-shop.png') }} alt=""
                                            style="width: 150px; "></a>
                                </div>
                                {{-- <div class="col-md-7 mt-3">
                                            <span class="d-none d-lg-block">
                                                <p style="text-align:center">DELSHOP</p>
                                            </span>
                                        </div> --}}
                                    </div>
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                                        <p class="text-center small">Mohon Input Data Anda!</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ route('register') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                            <label for="nama_pengguna" class="form-label">Nama Lengkap</label>
                                            <div class="input-group has-validation">
                                                <span class="bi bi-person input-group-text"
                                                    id="inputGroupPrepend"></span>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="bi bi-envelope input-group-text"
                                                    id="inputGroupPrepend"></span>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <span class=" bi bi-lock input-group-text"
                                                    id="inputGroupPrepend"></span>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password_konfirm" class="form-label">Konfirmasi
                                                Password</label>
                                            <div class="input-group has-validation">
                                                <span class=" bi bi-lock input-group-text"
                                                    id="inputGroupPrepend"></span>
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                <div class="invalid-feedback">Please enter a password.</div>
                                            </div>
                                        </div>
                                        <div class=" col-12 mt-4">
                                            <button type="submit" class="btn btn-primary w-100">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                        <div class=" row col-12 justify-content-center mt-3">
                                            <p >Sudah Punya Akun? <a href="{{ route('login') }}" class="btn text-secondary">Masuk</a></p>
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
