 <div class="container-fluid">

 	<div class="row">
 		<div class="col-sm-12">
 			<div class="page-title-box">
 				<h4 class="page-title">Transaksi
 					<button type="button" class="btn btn-primary waves-effect waves-light float-right btn-small ml-2" data-toggle="modal" data-animation="bounce" data-target="#tambahmodal">Tambah Data</button>
 					<a href="<?= base_url('Transaksi/tambahdata1'); ?>" class="btn btn-primary waves-effect waves-light float-right btn-small ml-2">Tambah Data 1</a>
 				</h4>
 			</div>
 			<form action="<?php echo base_url() . 'Transaksi/index'; ?>" method="post">
 				<div class="form-group row">
 					<label for="example-text-input" class="col-sm-2 col-form-label">Kode Transaksi </label>
 					<div class="col-sm-10">
 						<input class="form-control" name="carikodetrx" type="text" id="example-text-input" autocomplete="off" autofocus>
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="example-text-input" class="col-sm-2 col-form-label">Status </label>
 					<div class="col-sm-10">
 						<select class="form-control" name="caristatus">
 							<option value="">-pilih-</option>
 							<option value="1">New</option>
 							<option value="2">Process</option>
 							<option value="3">Close</option>
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
 								<th>Kode Transaksi</th>
 								<th>Nama</th>
 								<th>Deskripsi</th>
 								<th>Tanggal</th>
 								<th>Total</th>
 								<th>Status</th>
 								<th>Aksi</th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php
								$i = 0;
								foreach ($datatransaksi as $row) :
								?>
 								<tr>
 									<td><?= ++$i ?></td>
 									<td><?= $row['kode_trx'] ?></td>
 									<td><?= $row['nama_consumen'] ?></td>
 									<td><?= $row['deskripsi'] ?></td>
 									<td><?= $row['tanggal_trx'] ?></td>
 									<?php
										$total = "Rp " . number_format($row['total'], 0, ',', '.');
										?>
 									<td><?= $total ?></td>
 									<td>
 										<?php
											if ($row['status'] == 1) {
												echo 'New';
											} elseif ($row['status'] == 2) {
												echo 'Process';
											} elseif ($row['status'] == 3) {
												echo 'Close';
											}
											?>
 									</td>
 									<td>
 										<a href="<?= base_url('Transaksi/open') ?>/<?= $row['id_trx'] ?>" class="tabledit-edit-button btn btn-sm btn-primary" style="float: none; margin: 5px;"><span class="ti-arrow-right"></span></a>
 										<button class="tabledit-edit-button btn btn-sm btn-warning" style="float: none; margin: 5px;" data-toggle="modal" data-animation="bounce" data-target="#"><span class="ti-pencil"></span></button>
 										<a href="<?= base_url('Transaksi/delete') ?>/<?= $row['id_trx'] ?>" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none; margin: 5px;"><span class="ti-trash"></span></a>
 									</td>
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
 			<form action="<?php echo base_url() . 'transaksi/tambah'; ?>" method="post">
 				<div class="modal-body">

 					<div class="form-group row">
 						<label for="nama_consumen" class="col-sm-3 col-form-label">Kode Transaksi</label>
 						<div class="col-sm-9">
 							<input class="form-control" name="kode_trx" type="text" id="kode_trx" value="<?= $kode_trx ?>" readonly>
 						</div>
 					</div>
 					<div class="form-group row">
 						<label for="nama_consumen" class="col-sm-3 col-form-label">Nama Consumen</label>
 						<div class="col-sm-9">
 							<input class="form-control" name="nama_consumen" type="text" id="nama_consumen">
 						</div>
 					</div>
 					<div class="form-group row">
 						<label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
 						<div class="col-sm-9">
 							<textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
 						</div>
 					</div>

 					<div class="form-group row">
 						<label for="status" class="col-sm-3 col-form-label">Status </label>
 						<div class="col-sm-9">
 							<select class="form-control" name="status">
 								<option value="">-pilih-</option>
 								<option value="1">New</option>
 								<option value="2">Process</option>
 								<option value="3">Close</option>
 							</select>
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
