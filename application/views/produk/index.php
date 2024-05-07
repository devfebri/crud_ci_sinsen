 <div class="container-fluid">

 	<div class="row">
 		<div class="col-sm-12">
 			<div class="page-title-box">

 				<h4 class="page-title">Produk
 					<button type="button" class="btn btn-primary waves-effect waves-light float-right btn-small" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg">Tambah Data</button>
 				</h4>
 			</div>
 			<form action="<?php echo base_url() . 'produk/index'; ?>" method="get">
 				<div class="form-group row">
 					<label for="example-text-input" class="col-sm-2 col-form-label">Nama </label>
 					<div class="col-sm-10">
 						<input class="form-control" name="search_text" type="text" id="example-text-input">
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="example-text-input" class="col-sm-2 col-form-label">Status </label>
 					<div class="col-sm-10">
 						<select class="form-control" name="caristatus">
 							<option value="">-pilih-</option>
 							<option value="1">Ya</option>
 							<option value="0">Tidak</option>
 						</select>
 					</div>
 				</div>
 				<input type="submit" class="btn btn-primary btn-block" value="Search">
 				<br>
 			</form>
 		</div>
 	</div>
 	<!-- end page title end breadcrumb -->

 	<div class="row">
 		<div class="col-12">
 			<div class="card m-b-30">


 				<div class="card-body">
 					<!-- <?php print_r($dataproduk); ?> -->


 					<table id="datatable2" class="table table-bordered">
 						<thead>
 							<tr>
 								<th>No</th>
 								<th>Name</th>
 								<th>Harga</th>
 								<th>Status</th>
 								<th>Kode Produk</th>
 								<th>Foto</th>
 								<th>Aksi</th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php
								$no = 1;
								foreach ($dataproduk as $row) : ?>
 								<tr>
 									<td><?= ++$start ?></td>
 									<td><?= $row['nama'] ?></td>
 									<td><?= $row['harga'] ?></td>
 									<td><?= $row['status'] ?></td>
 									<td><?= $row['kode_produk'] ?></td>
 									<td><?= $row['foto'] ?></td>
 									<td>
 										<button class="tabledit-edit-button btn btn-sm btn-warning" style="float: none; margin: 5px;"><span class="ti-pencil"></span></button>
 										<a href="<?= base_url('produk/delete') ?>/<?= $row['id'] ?>" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none; margin: 5px;"><span class="ti-trash"></span></a>
 									</td>
 								</tr>
 							<?php endforeach; ?>
 						</tbody>
 					</table>
									<?php echo $this->pagination->create_links(); ?>

 				</div>
 			</div>
 		</div> <!-- end col -->
 	</div> <!-- end row -->

 </div><!-- container -->




 <!--  Modal content for the above example -->
 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title mt-0" id="myLargeModalLabel">Data Produk</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
 			</div>
 			<form action="<?php echo base_url() . 'produk/tambah'; ?>" method="post">
 				<div class="modal-body">
 					<div class="form-group row">
 						<label for="example-text-input" class="col-sm-2 col-form-label">Kode Produk </label>
 						<div class="col-sm-10">
 							<input class="form-control" name="kode_produk" type="text" id="example-text-input">
 						</div>
 					</div>
 					<div class="form-group row">
 						<label for="example-text-input" class="col-sm-2 col-form-label">Nama </label>
 						<div class="col-sm-10">
 							<input class="form-control" name="nama" type="text" id="example-text-input">
 						</div>
 					</div>
 					<div class="form-group row">
 						<label for="example-text-input" class="col-sm-2 col-form-label">Harga </label>
 						<div class="col-sm-10">
 							<input class="form-control" name="harga" type="number" id="example-text-input">
 						</div>
 					</div>
 					<div class="form-group row">
 						<label for="example-text-input" class="col-sm-2 col-form-label">Status </label>
 						<div class="col-sm-10">
 							<select class="form-control" name="status">
 								<option value="">-pilih-</option>
 								<option value="1">Ya</option>
 								<option value="0">Tidak</option>
 							</select>
 						</div>
 					</div>
 					<div class="form-group row">
 						<label for="example-text-input" class="col-sm-2 col-form-label">Foto </label>
 						<div class="col-sm-10">
 							<input class="form-control" name="foto" type="text" id="example-text-input">
 						</div>
 					</div>

 				</div>
 				<div class="modal-footer">
 					<button type="submit" class="btn btn-primary">Simpan</button>
 					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 				</div>
 			</form>
 		</div><!-- /.modal-content -->
 	</div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
