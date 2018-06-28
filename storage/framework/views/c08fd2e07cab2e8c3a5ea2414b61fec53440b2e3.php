<?php $__env->startSection('title'); ?>
  Daftar Kategori
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
  <li>kategori</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <a onclick="addForm()" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Tambah</a>
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th width="30">No</th>
              <th>Nama Kategori</th>
              <th width="100">Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
<?php echo $__env->make('kategori.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  var table, save_method;
  $(function(){
    //Menampilkan data dengan plugin DataTable
    table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
        "url" : "<?php echo e(route('kategori.data')); ?>",
        "type" : "GET"
      }
    });

  //Menyimpan data form tambah/edit beserta validasinya
  $('modal-form form').validator().on('submit', function(e){
    if (!e.isDefaultPrevented()) {
      var id = $('#id').val();
      if(save_method == "add") url = "<?php echo e(route('kategori.store')); ?>";
        else url = "kategori/"+id;

        $.ajax({
          url : url,
          type : "POST",
          data : $('#modal-form form').serialize(),
          success : function(data){
            $('#modal-form').modal('hide');
            table.ajax.reload();
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
	$('.modal-title').text('Tambah Kategori');
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
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>