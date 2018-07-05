@extends('layouts.app')

@section('title')
  Daftar Penjualan
@endsection

@section('breadcrumb')
  @parent
  <li>penjualan</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <a onclick="addForm()" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Transaksi Baru</a>
          @if(!empty(session('idpenjualan')))
            <a href="{{ route('penjualan_detail.index') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i>Transaksi
            Aktif</a>
          @endif
        </div>
        <div class="box-body">

            <table class="table table-striped tabel-penjualan">
              <thead>
                <tr>
                  <th width="30">No</th>
                  <th>Tanggal</th>
                  <th>Kode Member</th>
                  <th>Total Item</th>
                  <th>Total Harga</th>
                  <th>Diskon</th>
                  <th>Total</th>
                  <th>Kasir</th>
                  <th width="100">Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>

        </div>
      </div>
    </div>
  </div>

@include('penjualan.detail')
@endsection

@section('script')
<script type="text/javascript">
  var table, save_method, table1;
  $(function(){
    //Menampilkan data dengan plugin DataTable
    table = $('.table-penjualan').DataTable({
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "{{ route('penjualan.data') }}",
        "type" : "GET"
      }
    });

    table = $('.table-detail').DataTable({
      "dom" : 'Brt',
      "bSort" : false,
      "processing" : true,
    });
    $('.table-supplier').DataTable();
  });

//Menampilkan form tambah
function addForm(){
	$('#modal-supplier').modal('show');
}

function showDetail(id){
  $('#modal-detail').modal('show');

  table1.ajax.url("penjualan/"+id+"/lihat");
  table1.ajax.reload();
}

//Menghapus data
function deleteData(id){
	if(confirm("Apakah yakin data akan dihapus?")){
		$.ajax({
			url : "penjualan/"+id,
			type : "POST",
      data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
			success : function(data){
        table.ajax.reload();
			},
			error : function(){
				alert("Tidak dapat menghapus data!");
			}
		});
	}
}
</script>
@endsection
