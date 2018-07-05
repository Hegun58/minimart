@extends('layouts.app')

@section('title')
  Transaksi Penjualan
@endsection

@section('breadcrumb')
  @parent
  <li>penjualan</li>
  <li>tambah</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">

            <form class="form form-horizontal form-produk" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="idpembelian" value="{{ $idpenjualan }}">
              <div class="form-group">
                <label for="kode" class="col-md-2 control-label">Kode Produk</label>
                <div class="col-md-5">
                  <div class="input-group">
                    <input id="kode" type="text" class="form-control" name="kode" autofocus required>
                    <span class="input-group-btn">
                      <button onclick="showProduct()" type="button" class="btn btn-info">...</button>
                    </span>
                  </div>
                </div>
              </div>
            </form>

            <form class="form-keranjang">
              {{ csrf_field() }} {{ method_field('PATCH') }}
              <table class="table table-striped tabel-pembelian">
                <thead>
                  <tr>
                    <th width="30">No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Diskon</th>
                    <th align="right">Sub Total</th>
                    <th width="100">Aksi</th>
                  </tr>
                </thead>
              </table>
            </form>

            <div class="col-md-8">
              <div id="tampil-bayar" style="background: #dd4b39; color:#fff; font-size: 80px; text-align: center; height: 100px;"></div>
              <div id="tampil-terbilang" style="background: #3c8dbc; color: #fff; font-weight: bold; padding: 10px"></div>
            </div>
            <div class="col-md-4">
              <form class="form form-horizontal form-penjualan" method="post" action="{{ route('penjualan.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="idpenjualan" value="{{ $idpenjualan }}">
                <input type="hidden" name="totalitem" id="totalitem">
                <input type="hidden" name="bayar" id="bayar">

                <div class="form-group">
                  <label for="totalrp" class="col-md-4 control-label">Total</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="totalrp" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="diskon" class="col-md-4 control-label">Diskon</label>
                  <div class="col-md-8">
                    <input type="number" class="form-control" id="diskon" name="diskon" value="0" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="bayarrp" class="col-md-4 control-label">Bayar</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="bayarrp" readonly>
                  </div>
                </div>

                <div class="form-group">
                    <label for="diterima" class="col-md-4 control-label">Diterima</label>
                    <div class="col-md-8">
                      <input type="number" class="form-control" value="0" name="diterima" id="diterima">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kembali" class="col-md-4 control-label">Kembali</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="kembali" value="0" readonly>
                    </div>
                  </div>
              </form>
            </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right simpan"> <i class="fa fa-floppy"></i> Simpan Transaksi </button>
        </div>
      </div>
    </div>
  </div>

@include('penjualan_detail.produk')
@include('penjualan_detail.member')
@endsection

@section('script')
<script type="text/javascript">
  var table;
  $(function(){
    //Menampilkan data dengan plugin DataTable
    table = $('.table-produk').DataTable({
      "dom" : 'Brt',
      "bSort" : false,
      "processing" : true,
      "ajax" : {
        "url" : "{{ route('transaksi.data', $idpenjualan) }}",
        "type" : "GET"
      }
    }).on('draw.dt', function(){
      //1. Menjalankan fungsi loadForm() setiap tabel di-reload
      loadForm($('#diskon').val());
    });

    //Menghindari submit form saat dienter pada kode produk dan jumlah
    $('.form-produk').on('submit', function(){
      return false;
    });

    //2. Tambahkan class sidebar-collapse pada body
    $('body').addClass('sidebar-collapse');
    
    //Proses ketika kode produk atau diskon diubah
    $('#kode').change(function(){
      addItem();
    });

    $('.form-keranjang').submit(function(){
      return false;
    });

    //3. Jalankan fungsi selectMember() ketika member diubah
    $('#member').change(function(){
      selectMember($(this).val());
    });

    //4. Jalankan fungsi loadForm() ketika diterima diubah
    $('#diterima').change(function(){
      if($(this).val() == "") $(this).val(0).select();
      loadForm($('#diskon').val(), $(this).val());
    }).focus(function(){
      $(this).select();
    });

    $('.simpan').click(function(){
      $('.form-penjualan').submit();
    });

  });

  function addItem(){
    $.ajax({
      url : "{{ route('transaksi.store') }}",
      type : "POST",
      data : $('.form-produk').serialize(),
      success : function(data){
        $('#kode').val('').focus();
        table.ajax.reload(function(){
          loadForm($('#diskon').val());
        });
      },
      error : function(){
        alert('Tidak dapat menyimpan data');
      }
    })
  }

  function showProduct(){
    $('#modal-produk').modal('show');
  }

  function showMember(){
    $('#modal-member').modal('show');
  }

  function selectItem(kode){
    $('#kode').val(kode);
    $('#modal-produk').modal('hide');
    addItem();
  }

  function changeCount(id){
    $.ajax({
      url : "transaksi/"+id,
      type: "POST",
      data : $('.form-keranjang').serialize(),
      success : function(data){
        $('#kode').val('').focus();
        table.ajax.reload(function(){
          loadForm($('#diskon').val());
        });
      },
      error : function(){
        alert("Tidak dapat menyimpan data");
      }
    });
  }

  function selectMember(kode){
    $('#modal-member').modal('hide');
    $('#diskon').val('{{ $setting->diskon_member }}');
    $('#member').val(kode);
    loadForm($('#diskon').val());
    $('#diterima').val(0).focus().select();
  }

  function deleteItem(id){
    if(confirm("Apakah yakin data akan dihapus?")){
      $.ajax({
        url : "pembelian_detail/"+id,
        type : "POST",
        data : {' method' : 'DELETE', ' token' :
        $('meta[name=csrf-token]').attr('content')},
      success : function($data){
        table.ajax.reload(function(){
          loadForm($('#diskon').val());
        });
      },
      error : function(){
        alert("Tidak dapat menghapus data!");
      }
      });
    }
  }

  function loadForm(diskon=0){
    $('#total').val($('.total').text());
    $('#totalitem').val($('.totalitem').text());

    $.ajax({
      url :
      "transaksi/loadform/"+diskon+"/"+$('#total').val()+"/"+diterima,
      type : "GET",
      dataType : 'JSON',
      success : function(data){
        $('#totalrp').val("Rp. "+data.totalrp);
        $('#bayarrp').val("Rp. "+data.bayarrp);
        $('#bayar').val(data.bayar);
        $('#tampil-bayar').html("<small>Kembali:</small> Rp."+data.kembalirp);
        $('#tampil-terbilang').text(data.terbilang);
        
        $('#kembali').val("Rp. "+data.kembalirp);
        if($('#diterima').val() != 0){
          $('#tampil-bayar').html("<small>Kembali:</small> Rp. "+data.kembalirp);
          $('#tampil-terbilang').text(data.kembaliterbilang);
        }
      },
      error : function(){
        alert("Tidak dapat menampilkan data!");
      }
    });
  }

</script>
@endsection
