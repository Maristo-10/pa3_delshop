<a href="/kelolapengguna" class="btn btn-secondary mb-4">Kembali</a>
<div class="col-12 p-3 bg-white shadow rounded">
    {{-- TODO: Controller not ready yet --}}
    <form class="" action="/prosestambahuser" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row m-3">
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="name">Nama Pengguna</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
        </div>
        <div class="row m-3">
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="role_pengguna">Role Pengguna</label>
                <select name="role_pengguna" id="role_pengguna" class="form-control">
                    <option selected>Silahkan Pilih Role</option>
                    <option value="Publik">Publik</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Dosen/Staff">Dosen/Staff</option>
                    <option value="Pegawai">Pegawai</option>
                    <option value="Admin">Admin</option>
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#role_pengguna').select2();
                    });
                </script>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-5">
            <button type="submit" class="btn btn-success">
                Tambahkan Data Pengguna
            </button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </div>
    </form>
</div>
