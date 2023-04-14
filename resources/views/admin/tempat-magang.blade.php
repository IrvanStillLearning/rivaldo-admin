@extends('admin.layout.app')

@section('content') 
<section class="section">
    <div class="section-header">
        <h1>Data Tempat Magang</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Tempat Magang</h4>
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
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center" style="width: 30%">Nama Perusahaan</th>
                                        <th scope="col" class="text-center">Alamat</th>
                                        <th scope="col" class="text-center" style="width: 25%">Action</th>
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
<div class="modal fade" role="dialog" id="modal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header br">
             <h5 class="modal-title"></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form id="form_submit_request" action="/admin/tempat-magang/store-update" method="POST" autocomplete="off">
             <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                              <input type="text" hidden class="form-control" name="type" id="type">
                              <input type="text" hidden class="form-control" name="id" id="id">
                              <input class="form-control" type="text" id="nama_perusahaan" name="nama_perusahaan" >
                              <span class="d-flex text-danger invalid-feedback" id="invalid-nama_perusahaan-feedback"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" type="text" style="height:100px" id="alamat" name="alamat" ></textarea>
                            <span class="d-flex text-danger invalid-feedback" id="invalid-alamat-feedback"></span>
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
    var tb = $('#tb').DataTable({
        processing: true,
        serverSide: true,
        ajax : {
            url: '/admin/tempat-magang/datatables',
            type: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [3],
        },
        {
            className: 'text-center',
            targets: [0,3] 
        }],
        columns: [
        { data: 'DT_RowIndex',searchable: false, orderable: false},
        { data: 'nama_perusahaan'},
        { data: 'alamat'},
        { data: 'alamat'},
        ],
        rowCallback : function(row, data){
        var url_edit   = "/admin/tempat-magang/detail/" + data.id;
        var url_delete = "/admin/tempat-magang/delete/" + data.id;
        $('td:eq(3)', row).html(`
            <button class="btn btn-info btn-sm mr-1" onclick="edit('${url_edit}')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" onclick="delete_action('${url_delete}','${data.nama_perusahaan}')"><i class="fa fa-trash"> </i></button>
        `);
        
        },
        order: [
            [0, 'asc']
        ]
    });

    function add(){
        $("#modal").modal('show');
        $(".modal-title").text('Tambah Tempat Magang');
        $("#form_submit_request")[0].reset();
        reset_all_select();
    }

    function edit(url){
        edit_action(url, 'Edit Tempat Magang');
        $("#type").val('update');
    }
</script>
@endsection