 <div class="container-fluid">

 	<div class="row">
 		<div class="col-sm-12">
 			<div class="page-title-box">

 				<h4 class="page-title">Transaksi
 					<button type="button" class="btn btn-primary waves-effect waves-light float-right btn-small" data-toggle="modal" data-animation="bounce" data-target="#tambahmodal">Tambah Data</button>
 				</h4>
 			</div>
 			<form action="<?php echo base_url() . 'produk/index'; ?>" method="post">
 				<div class="form-group row">
 					<label for="example-text-input" class="col-sm-2 col-form-label">Nama </label>
 					<div class="col-sm-10">
 						<input class="form-control" name="carinama" type="text" id="example-text-input" autocomplete="off" autofocus>
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
 				<input type="submit" class="btn btn-primary btn-block" name="submit">
 				<br>
 			</form>
 		</div>
 	</div>
 	<!-- <h5>Total Rows : <?php echo $total_rows ?></h5> -->
 	<!-- end page title end breadcrumb -->

 	<div class="row">
 		<div class="col-12">
 			<div class="card m-b-30">


 				<div class="card-body">
 					<!-- <?php print_r($datatransaksi); ?> -->


 					<table id="datatable2" class="table table-bordered">
 						<thead>
 							<tr>
 								<th>No</th>
 								<th>Tanggal</th>
 								<th>Total</th>
 								<th>Status</th>
 								<th>Aksi</th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php
								$i = 1;
								foreach ($datatransaksi as $row) :
								?>
 								<tr>
 									<td><?= ++$i ?></td>
 									<td><?= $row['tanggal_trx'] ?></td>
 									<td><?= $row['total'] ?></td>
 									<td><?= $row['status'] ?></td>
 								</tr>

 							<?php endforeach; ?>
 						</tbody>
 					</table>

 				</div>
 			</div>
 		</div> <!-- end col -->
 	</div> <!-- end row -->

 </div><!-- container -->




 <!--  Modal Tambah Data -->
 <div class="modal fade " id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Data</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
 			</div>
 			<form action="<?php echo base_url() . 'produk/tambah'; ?>" method="post">
 				<div class="modal-body">
 					<div class="form-group row">
 						<label for="pilihproduk" class="col-sm-3 col-form-label">Pilih Produk </label>
 						<div class="col-sm-9">
 							<select class="form-control" name="pilihproduk" id="pilihproduk">
 								<option value="">-pilih-</option>
								<?php foreach($dataproduk as $row1): ?>
 								<option value="<?= $row1['id'] ?>"><?= $row1['nama'] ?></option>
								<?php endforeach; ?>
 							</select>
 						</div>
 					</div>
 					<!-- <div class="form-group row">
 						<label for="tanggal_trx" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
 						<div class="col-sm-9">
 							<input class="form-control" name="tanggal_trx" type="date" id="tanggal_trx">
 						</div>
 					</div> -->
 					<div class="form-group row">
 						<label for="harga" class="col-sm-3 col-form-label">Harga Produk</label>
 						<div class="col-sm-9">
 							<input class="form-control" name="harga" type="text" id="harga" value="1000" disabled>
 						</div>
 					</div>

 					<div class="form-group row">
 						<label for="status" class="col-sm-3 col-form-label">Status </label>
 						<div class="col-sm-9">
 							<select class="form-control" name="status">
 								<option value="">-pilih-</option>
 								<option value="1">New</option>
 								<option value="0">Process</option>
 								<option value="0">Close</option>
 							</select>
 						</div>
 					</div>
 					<div class="form-group row">
 						<label for="qty" class="col-sm-3 col-form-label">Jumlah </label>
 						<div class="col-sm-9">
 							<input class="form-control" name="qty" type="number" id="qty">
 						</div>
 					</div>
 					<div class="form-group row">
 						<label for="subtotal" class="col-sm-3 col-form-label">Subtotal </label>
 						<div class="col-sm-9">
 							<input class="form-control" name="subtotal" type="text" id="subtotal" value="10000" disabled>
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


 <!--  Modal Edit Data -->
 <!-- <?php foreach ($dataproduk as $row1) : ?>
 	<div class="modal fade" id="editmodal-<?= $row1['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 		<div class="modal-dialog modal-lg">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Data</h5>
 					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
 				</div>
 				<form action="<?php echo base_url() . 'produk/edit'; ?>" method="post">
 					<div class="modal-body">
 						<div class="form-group row">
 							<label for="kode_produk" class="col-sm-2 col-form-label">Kode Produk </label>
 							<div class="col-sm-10">
 								<input class="form-control" name="kode_produk" value="<?= $row1['kode_produk'] ?>" type="text" id="kode_produk">
 							</div>
 							<input type="hidden" value="<?= $row1['id'] ?>" name="id">
 						</div>
 						<div class="form-group row">
 							<label for="nama" class="col-sm-2 col-form-label">Nama </label>
 							<div class="col-sm-10">
 								<input class="form-control" name="nama" type="text" value="<?= $row1['nama'] ?>" id="nama">
 							</div>
 						</div>
 						<div class="form-group row">
 							<label for="harga" class="col-sm-2 col-form-label">Harga </label>
 							<div class="col-sm-10">
 								<input class="form-control" name="harga" type="number" value="<?= $row1['harga'] ?>" id="harga">
 							</div>
 						</div>
 						<div class="form-group row">
 							<label for="status" class="col-sm-2 col-form-label">Status </label>
 							<div class="col-sm-10">
 								<select class="form-control" name="status">
 									<option value="">-pilih-</option>
 									<option <?php if ($row1['status'] == '1') { ?>selected<?php } ?> value="1">Ya</option>
 									<option <?php if ($row1['status'] == '0') { ?>selected<?php } ?> value="0">Tidak</option>
 								</select>
 							</div>
 						</div>
 						<div class="form-group row">
 							<label for="foto" class="col-sm-2 col-form-label">Foto </label>
 							<div class="col-sm-10">
 								<input class="form-control" value="<?= $row1['foto'] ?>" name="foto" type="text" id="foto">
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
 <?php endforeach; ?> -->
