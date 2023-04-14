@extends('admin.layout.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Hak Akses</h1>
    </div>
    <div class="section-body" style="overflow-y: hidden!important; position: relative;">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Users</h4>
                    </div>

                    <div class="row mx-2">
                        <div class="col-12">
                            <div class="card" style="box-shadow: unset;">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-md" id="tb">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('modal')
<div class="modal fade" role="dialog" id="modal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header br">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_upload" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control required-field">
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control required-field">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" style="background-color: #84848a!important" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#tb').DataTable({
            processing: true,
            serverSide: true,
            ajax : {
                url: '/admin/hak-akses/datatables',
                type: 'GET'
            },
            columnDefs: [{
                orderable: false,
                targets: [3],
            }],
            columns: [
            { data: 'DT_RowIndex',searchable: false, orderable: false},
            { data: 'nama'},
            { data: 'email'},
            { data: 'email'},
            ],
            rowCallback : function(row, data){
            var url_edit   = "/admin/hak-akses/detail/" + data.id;
            var url_delete = "/admin/hak-akses/delete/" + data.id;
            $('td:eq(3)', row).html(`
                <button class="btn btn-info btn-sm mr-1" onclick="edit('${url_edit}')"><i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" onclick="delete_action('${url_delete}','${data.nama}')"><i class="fa fa-trash"> </i></button>
            `);
           
            },
            order: [
                [0, 'asc']
            ]
        });

        $('#form_upload').submit(function(e){
            e.preventDefault();
            $("#modal_loading").modal('show');

            $.ajax({
                url: "hak-akses/store",
                type: "POST",
                data: $('#form_upload').serialize(),
                datatype: 'JSON',
                success: function(response){
                    setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                    swal("succcess", {  icon: 'success' });
                    if(response.status === 200){
                        swal(response.message, {  icon: 'success', });
                        $('#modal').modal('hide');
                        $('#tb').DataTable().ajax.reload();
                    } else {
                        swal(response.message, { icon: 'error', });
                    }
                },error: function (jqXHR, textStatus, errorThrown){
                    setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                    swal("Oops! Terjadi kesalahan (" + errorThrown + ")", {  icon: 'error', });
                }
            })
        });

    })
    
    function edit(url){
        edit_action(url, 'Edit Hak Akses');
        $("#type").val('update');
    }

    function delete_action(url, nama){
        swal({
            title: 'Apakah anda yakin?',
            text: 'Apakah anda yakin akan menghapus data ' + nama + "?",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $("#modal_loading").modal('show');
            $.ajax({
                url : url,
                type: "DELETE",
                dataType: "JSON",
                success: function(response){
                    setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                    if(response.status === 200){
                    swal(response.message, {  icon: 'success', });
                    $("#modal").modal('hide');
                    $('#tb').DataTable().ajax.reload();
                    }else{
                    swal(response.message, {  icon: 'error', });
                    }

                },error: function (jqXHR, textStatus, errorThrown){
                    setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                    swal("Oops! Terjadi kesalahan segera hubungi tim IT (" + errorThrown + ")", {  icon: 'error', });
                }
            });
        }
      });
    }
</script>
@endsection
