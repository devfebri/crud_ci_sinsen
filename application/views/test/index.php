 <div class="container-fluid">

 	<div class="row">
 		<div class="col-sm-12">
 			<div class="page-title-box">
 				<h4 class="page-title">Produk

 				</h4>
 			</div>

 		</div>
 	</div>
 	<!-- end page title end breadcrumb -->

 	<div class="row">
 		<div class="col-12">
 			<div class="card m-b-30">

 				<?= form_open('test/deletemultiple', ['class' => 'formhapus']) ?>
 				<div class="card-body">
 					<button type="button" class="btn btn-primary" id="tomboltambah">
 						<i class="fa fa-plus-circle"></i> Tambah Produk
 					</button>

 					<button type="submit" class="btn btn-sm btn-danger tombolHapusBanyak">
 						<i class="fa fa-trash-o"></i> Hapus Banyak
 					</button>
 					<br>
 					<div class="row">
 						<div class="col-6">
 							<h6 class="text-muted fw-400"><b>Produk</b></h6>
 							<select class="select2 form-control mb-3 custom-select filter" id="filterproduk" style="width: 100%; height:36px;">
 								<option value="">-pilih-</option>
 								<?php foreach ($produk as $item) : ?>
 									<option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
 								<?php endforeach ?>
 							</select>
 						</div>
 						<div class="col-6">
 							<h6 class="text-muted fw-400"><b>Status</b></h6>
 							<select class="select2 form-control mb-3 custom-select filter" id="filterstatus" style="width: 100%; height:36px;">
 								<option value="">-pilih-</option>
 								<option value="1">Ya</option>
 								<option value="0">Tidak</option>
 							</select>
 						</div>
						<div class="col-12">
							<button type="button" class="btn btn-primary btn-block" id="btnCari">Cari</button>
						</div>
						<br>
						<br>
 					</div>
 					<table id="datatable2" class="table table-bordered">
 						<thead>
 							<tr>
 								<th>
 									<input type="checkbox" id="centangSemua">
 								</th>
 								<th>No</th>
 								<th>Kode Produk</th>
 								<th>Nama</th>
 								<th>Harga</th>
 								<th>Status</th>
 								<th>Foto</th>
 								<th>Aksi</th>
 							</tr>
 						</thead>

 					</table>
 				</div>
 				<?= form_close(); ?>
 			</div>
 		</div> <!-- end col -->
 	</div> <!-- end row -->

 </div><!-- container -->



 <!--  Modal Tambah Data -->
 <div class="modal fade " id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title mt-0" id="judulHtml">dasdsa</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
 			</div>
 			<?php echo  form_open_multipart(base_url() . "test/simpandata", ['class' => 'formsimpan']); ?>
 			<div class="modal-body">
 				<div class="form-group row">
 					<label for="kode_produk" class="col-sm-2 col-form-label">Kode Produk </label>
 					<div class="col-sm-10">
 						<input class="form-control" name="kode_produk" type="text" id="kode_produk" required="">
 						<input class="form-control" name="id" type="hidden" id="id">
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="nama" class="col-sm-2 col-form-label">Nama </label>
 					<div class="col-sm-10">
 						<input class="form-control" name="nama" type="text" id="nama" required="">
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="harga" class="col-sm-2 col-form-label">Harga </label>
 					<div class="col-sm-10">
 						<input class="form-control" name="harga" type="number" id="harga" required="">
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="status" class="col-sm-2 col-form-label">Status </label>
 					<div class="col-sm-10">
 						<select class="form-control statuss" name="status" required="">
 							<option value="">-pilih-</option>
 							<option value="1">Ya</option>
 							<option value="0">Tidak</option>
 						</select>
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="foto" class="col-sm-2 col-form-label">Foto </label>
 					<div class="col-sm-10">
 						<input class="form-control" name="foto" type="file" id="foto" size="20" required="">
 					</div>
 				</div>

 			</div>
 			<div class="modal-footer">
 				<button type="submit" class="btn btn-primary">Simpan</button>
 				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 			</div>
 			<!-- </form> -->
 			<?php echo form_close() ?>
 		</div><!-- /.modal-content -->
 	</div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
