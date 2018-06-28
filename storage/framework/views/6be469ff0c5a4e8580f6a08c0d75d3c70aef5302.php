<?php $__env->startSection('title'); ?>
  Daftar Produk
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
  <li>produk</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <a onclick="addForm()" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Tambah</a>
          <a onclick="deleteAll()" class="btn btn-danger"> <i class="fa fa-trash"></i> Hapus</a>
          <a onclick="printBarcode()" class="btn btn-info"> <i class="fa fa-barcode"></i> Cetak Barcode</a>
        </div>

        <div class="box-body">

          <form method="post"  id="form-produk">
            <?php echo e(csrf_field()); ?>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th width="20"><input type="checkbox" value="1" id="select-all"></th>
                  <th width="20">No</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Kategori</th>
                  <th>Merk</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Diskon</th>
                  <th>Stok</th>
                  <th width="100">Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </form>

        </div>

      </div>
    </div>
  </div>
<?php echo $__env->make('Produk.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  var table, save_method;
  $(function(){
    //Menampilkan data dengan plugin DataTable
    table = $('.table').DataTable({
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?php echo e(route('produk.data')); ?>",
        "type" : "GET"
      },
      'columnDefs' : [{
        'targets': 0,
        'searchable': false,
        'orderable': false
      }],
      'order': [1, 'asc']
    });

    // Centak semua checkbox ketika checkbox dengan id #select-all dicentang
    $('#select-all').click(function(){
      $('input[type="checkbox"]').prop('checked', this.checked);
    });

    //Menyimpan data dari form tambah/edit beserta validasinya
    $('#modal-form form').validator().on('submit', function(e){
      if(!e.isDefaultPrevented()){
        var id = $('#id').val();
        if(save_method == "add") url = "<?php echo e(route('produk.store')); ?>";
        else url = "produk/"+id;

        $.ajax({
          url : url,
          type : "POST",
          data : $('#modal-form form').serialize(),
          dataType : 'JSON',
          success : function(data){
            if(data.msg=="error"){
              alert('Kode produk sudah digunakan!');
              $('#kode').focus().select();
            }else {
              $('#modal-form').modal('hide');
              table.ajax.reload();
            }
          },
          error : function(){
            alert("Tidak dapat menyimpan data!");
          }
        });
        return false;
      }
    });
  });

//Menampilkan form tambah
function addForm(){
	save_method = "add";
	$('input[name=_method]').val('POST');
	$('#modal-form').modal('show');
	$('#modal-form form')[0].reset();
	$('.modal-title').text('Tambah Produk');
  $('#kode').attr('readonly', false);
}

//Menampilkan form edit dan menampilkan data pada form tersebut
function editForm(id){
	save_method = "edit";
	$('input[name=_method').val('PATCH');
	$('#modal-form form')[0].reset();
	$.ajax({
		url : "kategori/"+id+"/edit",
		type : "GET",
		dataType : "JSON",
		success : function(data){
			$('#modal-form').modal('show');
			$('.pmd-card-title-text').text('Edit Kategori');

			$('#id').val(data.id_kategori);
			$('#nama').val(data.nama_kategori);
		},
		error : function(){
			alert("Tidak dapat menampilkan data!");
		}
	});
}

//Menghapus data
function deleteData(id){
	if(confirm("Apakah yakin data akan dihapus?")){
		$.ajax({
			url : "kategori/"+id,
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

//Menghapus semua data yang dicentang
function deleteAll(){
  if($('input:checked').length < 1){
    alert('Pilih data yang akan dihapus!');
  }else if(confirm("Apakah yakin akan menghapus semua data terpilih?")){
    $.ajax({
      url : "produk/hapus",
      type : "POST",
      data : {' _method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
      success : function (data){
        table.ajax.reload();
      },
      error : function(){
        alert("Tidak dapat menghapus data!");
      }
    });
  }
}

//Mencetak barcode ketika tombol Cetak Barcode diklik
function printBarcode(){
  if($('input:checked').length < 1){
    alert('Pilih data yang akan dicetak!');
  }else{
    $('#form-produk').attr('target', '_blank').attr('action', "produk/cetak").submit();
  }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>