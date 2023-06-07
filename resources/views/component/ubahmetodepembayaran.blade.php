<div class="col-12 p-3 bg-white shadow rounded">
    {{-- TODO: Controller not ready yet --}}
    <form class="mt-3" action="/prosesubahmetodepembayaran/{{$metpem->id_metpem}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="nama_layanan">Nama Layanan</label>
                    <input type="text" name="layanan" id="layanan" class="form-control" value="{{$metpem->layanan}}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="no_layanan">Nomor Pembayaran</label>
                    <input type="text" name="no_layanan" id="no_layanan" class="form-control" value="{{$metpem->no_layanan}}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="nama_pemilik">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" value="{{$metpem->nama_pemilik}}">
                </div>
                <div class="form-group col-12 col-md-6 mt-3">
                    <label for="kategori_layanan">Kategori Pembayaran</label>
                    <select name="kategori_layanan" id="kategori_layanan" class="form-control">
                        <option selected disabled>{{$metpem->kapem}}</option>
                        @foreach ($kapem as $data)
                            <option value="{{ $data->kategori_pembayaran }}">{{ $data->kategori_pembayaran }}</option>
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
            <button type="submit" class="btn btn-warning">
                Ubah Motode Pembayaran
            </button>
            <button type="reset" class="btn btn-primary">Reset</button>
        </div>
    </form>
</div>
