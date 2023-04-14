@extends('admin.layout.app')

@section('content') 
<section class="section">
    <div class="section-header">
        <h1>Data Siswa</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Siswa</h4>
                        <div class="card-header-action">
                            <button type="button" style="margin-right: 10px" class="btn btn-warning"
                                onclick="add('Tambah Data');"><i class="fa fa-plus mr-1"></i>
                                Tambah Data</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-md" id="tb" width="100%">
                                <thead>
                                    <tr class="bg-primary">
                                        <th scope="col" class="text-center px-5">NIK</th>
                                        <th scope="col" class="text-center">Nama</th>
                                        <th scope="col" class="text-center">Foto</th>
                                        <th scope="col" class="text-center">Jurusan</th>
                                        <th scope="col" class="text-center">No Telepon</th>
                                        <th scope="col" class="text-center">Tempat Magang</th>
                                        <th scope="col" class="text-center">Alamat</th>
                                        <th scope="col" class="text-center" style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
    <div class="modal fade" role="dialog" id="modal" data-keyboard="false" data-backdrop="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header br">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_siswa" action="/admin/siswa/store-update" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="id" name="id" hidden>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-5 col-lg-5">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-nama-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-nik-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" name="no_telp" id="no_telp" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-no_telp-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-tempat_lahir-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-tanggal_lahir-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-asal_sekolah-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input type="text" name="jurusan" id="jurusan" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-jurusan-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="d-block">Foto</label>
                                    <div class="my-3" style="display: flex">
                                        <img width="25%" id="preview_gambar" src="" alt="preview_image">
                                        <p style="margin-left: 15px; color: #6c757d; font-weight: bold">*Preview Foto</p>
                                    </div>
                                    <span style="font-style: italic; color: rgb(131, 131, 131); display: block" id="image-warning">*Jika Foto tidak diubah tidak perlu upload gambar</span>
                                    <input type="file" onchange="previewFile(this);"  name="gambar" class="form-control" id="gambar" accept="image/png, image/jpeg, image/jpg, image/webp">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-gambar-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" type="text" style="height:100px" id="alamat" name="alamat" ></textarea>
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-alamat-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Tempat Magang</label>
                                    <select id="tempat_magang_id" name="tempat_magang_id" class="form-control select2">
                                        <span class="d-flex text-danger invalid-feedback" id="invalid-tempat_magang_id-feedback"></span>
                                        <option selected disabled>- Pilih -</option>
                                        @foreach ($data as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_perusahaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Masuk Magang</label>
                                    <input type="date" name="masuk_magang" id="masuk_magang" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-masuk_magang-feedback"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Keluar Magang</label>
                                    <input type="date" name="keluar_magang" id="keluar_magang" class="form-control">
                                    <span class="d-flex text-danger invalid-feedback" id="invalid-keluar_magang-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $('#preview_gambar').parent().addClass("my-3");
                $('#preview_gambar').parent().css("display", "flex");
                $("#preview_gambar").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

    var tb = $('#tb').DataTable({
        processing: true,
        serverSide: true,
        ajax : {
            url: '/admin/siswa/datatables',
            type: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0, 2, 4, 5, 6],
        },
        {
            className: 'text-center', targets: [4, 7]
        },
        ],
        columns: [
        { data: 'nik'},
        { data: 'nama'},
        { data: 'foto', render: function(data){return `<img src="{{ asset('${data}') }}" width="200px" height="120px" style="object-fit: contain">`}},
        { data: 'jurusan'},
        { data: 'no_telp'},
        { data: 'tempat_magang.nama_perusahaan'},
        { data: 'alamat'},
        { data: 'alamat'},
        ],
        rowCallback : function(row, data){
        var url_edit   = "/admin/siswa/detail/" + data.id;
        var url_delete = "/admin/siswa/delete/" + data.id;
        $('td:eq(7)', row).html(`
            <button class="btn btn-info btn-sm mr-1" onclick="edit('${url_edit}')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-warning btn-sm mr-1" onclick="cetak_data_diri(${data.id})"><i class="fas fa-file-pdf"></i></i></button>
            <button class="btn btn-danger btn-sm" onclick="delete_action('${url_delete}','${data.nama}')"><i class="fa fa-trash"> </i></button>
        `);
        },
        order: [
            [0, 'asc']
        ]
    });

    function cetak_data_diri(id){
        $("#modal_loading").modal('show');
        $.ajax({
            url : "/admin/siswa/cetak-data-diri/" + id,
            type: "GET",
            success: function(response){
                setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                if(response.status == 200){
                    var data = b64toBlob(response.data.base64);
                    //UNTUK OPEN NEW TAB
                    var file = new Blob([data], {type: 'application/pdf'});
                    var fileURL = URL.createObjectURL(file);
                    window.open(fileURL);
                }else if(response.status == 300){
                    swal(response.message, { icon: 'error', });
                }
            },
            error: function(blob){
                setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                swal("Oops! Terjadi kesalahan segera hubungi tim IT", {  icon: 'error', });
            }
        });
    }

    function add(){
        $("#modal").modal('show');
        $(".modal-title").text('Tambah Siswa');
        $("#form_siswa")[0].reset();
        reset_all_select();
        $("#image-warning").css("display", "none");
        $("#preview_gambar").attr("src", "");
        $('#preview_gambar').parent().removeClass("my-3");
        $('#preview_gambar').parent().css("display", "none");
        
    }
        
    $('#form_siswa').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);

        swal({
             title: 'Yakin?',
             text: 'Apakah anda yakin akan menyimpan data ini?',
             icon: 'warning',
             buttons: true,
             dangerMode: true,
       })
       .then((willDelete) => {
            if (willDelete) {
                $("#modal_loading").modal('show');
                $('input,textarea.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                $.ajax({
                    url: '/admin/siswa/store-update',
                    type: "POST",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    datatype: 'JSON',
                    success: function(response){
                        setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                        if(response.status === 200){
                            swal(response.message, {  icon: 'success', });
                            $('#modal').modal('hide');
                            $('#tb').DataTable().ajax.reload();
                        } else {
                            swal(response.message, { icon: 'error', });
                        }
                    },error: function (jqXHR, textStatus, errorThrown){
                        setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                        Object.keys(jqXHR.responseJSON.errors).forEach(function (key) {
                            // console.log(jqXHR.responseJSON.errors[key]);
                            var responseError = jqXHR.responseJSON.errors[key];
                            var elem_name = $('[name=' + responseError['field'] + ']');
                            var elem_feedback = $('[id=invalid-' + responseError['field'] + '-feedback'+']');
                            elem_name.addClass('is-invalid');
                            elem_feedback.text(responseError['message']);
                        });
                    }
                })
             }
        });


    });

    function edit(url){
        save_method = 'edit';
        $("#modal").modal('show');
        $(".modal-title").text("siswa Edit");
        $("#modal_loading").modal('show');
        $.ajax({
            url : url,
            type: "GET",
            dataType: "JSON",
            success: function(response){
                setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                $("#form_siswa")[0].reset();
                $("#image-warning").css("display", "block");
                Object.keys(response).forEach(function (key) {
                    if(key !== 'gambar'){
                        var elem_name = $('[name=' + key + ']');
                        elem_name.val(response[key]);
                    }
                    var img = "{!! asset('"+ response[`foto`] +"') !!}";
                    $("#preview_gambar").attr("src", img);
                });
            },error: function (jqXHR, textStatus, errorThrown){
                setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                swal("Oops! Terjadi kesalahan segera hubungi tim IT (" + errorThrown + ")", {  icon: 'error', });
            }
        });
    }
</script>
@endsection