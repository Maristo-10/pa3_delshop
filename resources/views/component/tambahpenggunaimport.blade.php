<div class="col-12 p-3 bg-white shadow rounded">
    <form action="{{ route('tambahpengguna.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Import</button>
    </form>

</div>
