@if (Auth::user()->role_pengguna == 'Publik' ||
        Auth::user()->role_pengguna == 'Dosen/Staff' ||
        Auth::user()->role_pengguna == 'Mahasiswa')
    <div class="container-fluid ">
        <div class="row px-xl-5 mt-3">
            <div class="col-lg">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center ">
                @foreach ($pengguna as $data)
                    <img src="/profile-images/{{ $data->gambar_pengguna }}" alt="Profile" class="rounded-circle"
                        style="width: 250px">
                    <h2>{{ $data->name }}</h2>
                    <h3>{{ $data->pekerjaan }}</h3>
                    <div class="social-links mt-2">
                        <a href="{{ $data->twitter }}" class="text-dark twitter"><i class="bi bi-twitter"></i></a>
                        <a href="{{ $data->facebook }}" class="text-dark facebook"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $data->instagram }}" class="text-dark instagram"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $data->linkedin }}" class="text-dark linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
            </div>
        </div>

    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active text-dark" data-bs-toggle="tab"
                            data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link text-dark" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                            Profile</button>
                    </li>
                    @if(Auth::user()->role_pengguna != "Admin")
                    <li class="nav-item">
                        <button class="nav-link text-dark" data-bs-toggle="tab"
                            data-bs-target="#profile-change-password">Request Role</button>
                    </li>
                    @endif
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                        <h5 class="card-title mt-3">Profil Pengguna</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 "><b>Nama Pengguna</b></div>
                            <div class="col-lg-9 col-md-8">{{ $data->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4"><b>Email</b></div>
                            <div class="col-lg-9 col-md-8">{{ $data->email }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4"><b>Role Akun</b></div>
                            <div class="col-lg-9 col-md-8">{{ $data->role_pengguna }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4"><b>Jenis Kelamin</b></div>
                            <div class="col-lg-9 col-md-8">{{ $data->jenis_kelamin }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4">Pekerjaan</div>
                            <div class="col-lg-9 col-md-8">{{ $data->pekerjaan }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4">Alamat</div>
                            <div class="col-lg-9 col-md-8">{{ $data->alamat }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">No. Telp</div>
                            <div class="col-lg-9 col-md-8">{{ $data->no_telp }}</div>
                        </div>

                        <h5 class="card-title mt-3">Tentang</h5>
                        <p class="small fst-italic">{{ $data->tentang }}</p>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                        <!-- Profile Edit Form -->
                        @if (Auth::user()->role_pengguna == 'Admin')
                            <form action="/aprofile/update" method="POST" enctype="multipart/form-data">
                            @else
                                <form action="/profile/update" method="POST" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                Image</label>
                            <div class="col-md-8 col-lg-9">
                                <img class="rounded-circle" id="uploadPreview"
                                    src="/profile-images/{{ $data->gambar_pengguna }}" alt="Profile"
                                    style="width: 200px">
                                <div class="row pt-2 col-2">
                                    <div class="col-6">
                                        <input class="form-control @error('image') is invalid @enderror" type="file"
                                            id="gambar_pengguna" name="gambar_pengguna" onchange="PreviewImage();"
                                            style="display:none">
                                        <label for="gambar_pengguna" class="btn btn-primary btn-sm"
                                            title="Upload new profile image"><i class="bi bi-upload"></i></label>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-danger btn-sm"
                                            title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                    </div>
                                    <script type="text/javascript">
                                        var PreviewImage = function(event) {
                                            var oFReader = new FileReader();
                                            oFReader.readAsDataURL(document.getElementById("gambar_pengguna").files[0]);
                                            oFReader.onload = function(oFREvent) {
                                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                                            };
                                        };
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama
                                Pengguna</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="name" type="text" class="form-control" id="name"
                                    value="{{ $data->name }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="Email"
                                    value="{{ $data->email }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jenis_kelamin" class="col-md-4 col-lg-3 col-form-label">Jenis
                                Kelamin</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="jenis_kelamin" type="text" class="form-control" id="jenis_kelamin"
                                    value="{{ $data->jenis_kelamin }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pekerjaan" class="col-md-4 col-lg-3 col-form-label">Pekerjaan</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="pekerjaan" type="text" class="form-control" id="pekerjaan"
                                    value="{{ $data->pekerjaan }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="alamat" type="text" class="form-control" id="alamat"
                                    value="{{ $data->alamat }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_telp" class="col-md-4 col-lg-3 col-form-label">No. Telp</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="no_telp" type="text" class="form-control" id="no_telp"
                                    value="{{ $data->no_telp }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tentang" class="col-md-4 col-lg-3 col-form-label">Tentang</label>
                            <div class="col-md-8 col-lg-9">
                                <textarea name="tentang" class="form-control" id="tentang" style="height: 100px">{{ $data->tentang }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                Profile</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="twitter" type="text" class="form-control" id="Twitter"
                                    value="{{ $data->twitter }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                Profile</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="facebook" type="text" class="form-control" id="Facebook"
                                    value="{{ $data->facebook }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                Profile</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="instagram" type="text" class="form-control" id="instagram"
                                    value="{{ $data->instagram }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                Profile</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="linkedin" type="text" class="form-control" id="Linkedin"
                                    value="{{ $data->linkedin }}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                        </form><!-- End Profile Edit Form -->
                    </div>

                    <div class="tab-pane fade pt-3" id="profile-settings">
                    </div>
                    @if (Auth::user()->role_pengguna != 'Admin')
                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form action="ganti-roles" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="email"
                                            value="{{ Auth::user()->email }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama
                                        Pengguna</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="name"
                                            value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="role" class="col-md-4 col-lg-3 col-form-label">Pilih Role</label>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="role" id="role" class="form-control">
                                            <option selected disabled>Silahkan Pilih Role</option>
                                            <option value="Mahasiswa">Mahasiswa</option>
                                            <option value="Dosen/Staff">Dosen/Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="bukti" class="col-md-4 col-lg-3 col-form-label">Bukti CIS</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input class="form-control @error('image') is invalid @enderror"
                                            type="file" id="bukti" name="bukti">
                                    </div>
                                </div>
                       <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>
                    @endif
                    {{-- <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form>
                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control"
                                        id="currentPassword">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newpassword" type="password" class="form-control"
                                        id="newPassword">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewpassword" type="password" class="form-control"
                                        id="renewPassword">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form><!-- End Change Password Form -->

                    </div> --}}

                </div><!-- End Bordered Tabs -->

            </div>
        </div>
    </div>
    @endforeach
</div>
