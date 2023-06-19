<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<div class="card-body d-sm-flex justify-content-between">
    <h6 class="mb-0">
        <a href="/tambahpengguna" class="btn btn-success text-white py-2 ">
            <i class="fa fa-plus"></i>
            <span>Tambah Data Pengguna</span>
        </a>
        <a href="/hapusall" class="btn btn-danger text-white py-2 delete_all" id="deleteAllSelectedRecord">
            <i class="fa fa-plus"></i>
            <span>Hapus Data Pengguna</span>
        </a>
    </h6>
    <h6 class="col-md-4 mb-0">
        <a href="" class="btn btn-info text-white" data-bs-target="#components-laporan-bulanan"
            data-bs-toggle="collapse">
            <i class="fa fa-plus"></i>
            <span>Import data excel</span>
        </a>
    </h6>
</div>

<div class="row justify-content-center">
    <div class="col-8 ">
        <div class="card">
                <form action="{{ route('tambahpengguna.import') }}" method="POST" enctype="multipart/form-data" class="p-3">
                    @csrf
                    <div class="row nav-content collapse justify-content-center align-items-center mt-4" id="components-laporan-bulanan" data-bs-parent="#form-laporan">
                        <div class="col-6 mb-5">
                            <div class="">
                                <label for="formFile" class="form-label">Masukkan Data Pengguna </label>
                                <input class="form-control mt-3" name="file" type="file" id="formFile">
                            </div>
                        </div>
                        <div class="col-2 ">
                            <button type="submit" class="btn btn-primary" name="cari-penjualan" id="cari-penjualan">Import</button>
                        </div>
                    </div>
                </form>
            {{-- </div> --}}
        </div>
    </div>
</div>

<div class="row shadow-sm rounded bg-white p-3">
    <div class="col-md">
        <div class="table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered" id="list">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll master"> Select All</th>
                                <th scope="col" class="col-md-1">No</th>
                                <th scope="col" class="col-md-3">Nama Pengguna</th>
                                <th scope="col" class="col-md-3">Email</th>
                                <th scope="col" class="col-md-2">Role Pengguna</th>
                                <th scope="col" class="col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="POST" action="{{route('admin.hapusallpengguna')}}">
                                @if($pengguna->count())
                                @foreach ($pengguna as $index => $data)
                                    <tr id="sid{{$data->id}}">
                                        <td><input type="checkbox" name='ids[]' id="checkBoxClass" 
                                            value="{{$data->id}}"></td>
                                        <td>{{ $index + $pengguna->firstItem() }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->role_pengguna }}</td>
                                        <td style="text-align: center">
                                            <a href="/ubahpengguna/{{ $data->id }}" title="Ubah Data"
                                                class="bi bi-pencil-square btn btn-warning " style="font-size: 15px"></a>
                                            <a type="button" title="Hapus Data"
                                                class="bi bi-trash-fill btn btn-danger ml-2" style="font-size: 15px"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $data->id }}"></a>
                                        </td>
    
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakun untuk menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="/hapus/pengguna/{{ $data->id }}"
                                                            class="btn btn-danger">Ya</a>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                                @endif
                            </form>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            {{ $pengguna->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
{{-- <script type="text/javascript">
    $(document).ready(function () {

        $('#master').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
            $(".sub_chk").prop('checked', true);  
        } else {  
            $(".sub_chk").prop('checked',false);  
        }  
        });

        $('.delete_all').on('click', function(e) {

            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  

                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  

                    var join_selected_values = allVals.join(","); 

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                $.each(allVals, function( index, value ) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
                }  
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });

            return false;
        });
    });
</script> --}}
    <script language="javascript">
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $("#deleteAllSelectedRecord").click(function(e){
            e.preventDefault();
            var allids = [];

            $("input:checkbox[name=ids]:checked").each(function(){
                allids.push($(this).val());
            });

            $.ajax({
                url:"{{route('admin.hapusallpengguna')}}",
                type:"DELETE",
                data:{
                    _token:$("input[name=_token]").val(),
                    ids:allids
                },
                success:function(response){
                    $.each(allids, function(key,val){
                        $("#sid"+val).remove();
                    })
                }
            })
        })
    </script>