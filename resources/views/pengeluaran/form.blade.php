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
							<label for="jenis" class="col-md-3 control-label">Jenis Pengeluaran</label>
							<div class="col-md-6">
	              <input id="jenis" type='number' class="form-control" name="jenis" autofocus required/>
	              <span class="help-block with-errors"></span>
							</div>
						</div>

						<div class="form-group">
							<label for="nominal" class="col-md-3 control-label">Nominal</label>
							<div class="col-md-6">
								<input id="nominal" type='text' class="form-control"  name="nominal" autofocus required/>
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
