<div class="col-5 p-3 bg-white shadow rounded">
    <form action="{{ route('tambahpengguna.import') }}" method="POST" enctype="multipart/form-data" class="p-3">
        @csrf
        <div class="row"></div>
        <div class="col">
            <h5 class="mb-8">Silahkan Tambahkan File Excel!</h5>
        </div>
        <div class="col">
            <input type="file" name="file" required class="col-md-8 mb-3">
        </div>
        <div class="col ml-3">
            <button type="submit" class="col-md-4">Import</button>
        </div>
    </form>

</div>
