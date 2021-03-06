	<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form action="" class="form-horizontal" data-toggle="validator" method="post">
					{{ csrf_field() }} {{ method_field('POST') }}

					<div class="modal-header">
						<button aria-label="Close" data-dismiss="modal" class="close" type="button">
              <span aria-hidden="true"> &times; </span></button>
						<h3 class="modal-title"></h3>
						<hr>
					</div>

					<div class="modal-body">

				  	<input type="hidden" id="id" name="id">
				  	<div class="form-group">
							<label for="nama" class="col-md-3 control-label">Nama Supplier</label>
  						<div class="col-md-6">
                <input id="kode" type='text' class="form-control" name="kode" autofocus required/>
                <span class="help-block with-errors"></span>
  						</div>
						</div>

						<div class="form-group">
							<label for="alamat" class="col-md-3 control-label">Alamat</label>
							<div class="col-md-8">
								<input id="alamat" type='text' class="form-control" name="alamat" required/>
								<span class="help-block with-errors"></span>
							</div>
					</div>

					<div class="form-group">
						<label for="telpon" class="col-md-3 control-label">Telpon</label>
						<div class="col-md-6">
							<input id="telpon" type='text' class="form-control" name="telpon"  autofocus required/>
							<span class="help-block with-errors"></span>
						</div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-save"> <i class="fa fa-floppy-o"></i> Simpan</button>
						<button class="btn btn-warning" data-dismiss="modal" type="button"> <i class="fa fa-arrow-circle-left"></i>
              Batal</button>
					</div>
				</form>

			</div>
		</div>
	</div>
