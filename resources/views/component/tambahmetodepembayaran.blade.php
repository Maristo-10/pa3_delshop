<a href="/kelola-metode-pembayaran" class="btn btn-warning mb-4">Kembali</a>
<div class="col-12 p-3 bg-white shadow rounded">
    {{-- TODO: Controller not ready yet --}}
    <form class="mt-3" action="/prosestambahmetodepembayaran" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" name="nama_layanan" id="nama_layanan" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="no_layanan">Nomor Pembayaran</label>
                <input type="text" name="no_layanan" id="no_layanan" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="nama_pemilik">Nama Pemilik</label>
                <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control">
            </div>
            <div class="form-group col-12 col-md-6 mt-3">
                <label for="kategori_layanan">Kategori Pembayaran</label>
                <select name="kategori_layanan" id="kategori_layanan" class="form-control">
                    <option selected>Silahkan Pilih Kategori Pembayaran</option>
                    @foreach ($kapem as $data)
                        <option value="{{ $data->id_kapem }}">{{ $data->kategori_pembayaran }}</option>
                    @endforeach
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#kategori_layanan').select2();
                    });
                </script>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-5 mb-5">
            <button type="submit" class="btn btn-success">
                Tambahkan Motode Pembayaran
            </button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </div>
    </form>
</div>
