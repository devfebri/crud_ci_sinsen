 <div class="container-fluid">

 	<div class="row">
 		<div class="col-sm-12">
 			<div class="page-title-box">

 				<h4 class="page-title">Header Transakasi
 					<!-- <button type="button" class="btn btn-primary waves-effect waves-light float-right btn-small" data-toggle="modal" data-animation="bounce" data-target="#tambahmodal">Tambah Produk</button> -->
 				</h4>
 			</div>
 			<div class="card m-b-30">

 				<div class="card-body card-subtitle card-info">
 					<div class="row">
 						<div class="col-6">

 							<table>
 								<tr>
 									<td>Kode Transaksi</td>
 									<td>:</td>
 									<td><?= $kode_trx ?></td>
 								</tr>
 								<tr>
 									<td>Nama Consumen</td>
 									<td>:</td>
 									<td><?= $nama_consumen ?></td>
 								</tr>
 								<tr>
 									<td>Deskripsi</td>
 									<td>:</td>
 									<td><?= $deskripsi ?></td>
 								</tr>
 								<tr>
 									<td>Tanggal</td>
 									<td>:</td>
 									<td><?= $tanggal ?></td>
 								</tr>
 								<tr>
 									<td>Total</td>
 									<td>:</td>
 									<?php
										$totals = "Rp " . number_format($total, 0, ',', '.');
										?>
 									<td><?= $totals ?></td>
 								</tr>
 							</table>
 						</div>
 						<div class="col-6">
 							<span class="badge badge-primary float-right"><b><i><?= $status ?></i></b></span>
 						</div>
 					</div>
 				</div>
 			</div>

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
 								<th>Kode Produk</th>
 								<th>Nama Produk</th>
 								<th>Harga</th>
 								<th>Qty</th>
 								<th>Subtotal</th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php
								$i = 0;
								foreach ($datadetailtransaksi as $row) :
								?>
 								<tr>
 									<td><?= ++$i ?></td>
 									<td><?= $row['kode_produk'] ?></td>
 									<td><?= $row['nama'] ?></td>
 									<?php
										$subtotal = "Rp " . number_format($row['subtotal'], 0, ',', '.');
										$harga = "Rp " . number_format($row['harga'], 0, ',', '.');
										?>
 									<td><?= $row['harga'] ?></td>
 									<td><?= $row['qty'] ?></td>
 									<td><?= $subtotal ?></td>
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
 			<form action="<?php echo base_url() . 'Transaksi/tambahproduk'; ?>" method="post">
 				<div class="modal-body">
 					<input type="hidden" name="id_trx" value="<?= $id_trx ?>">
 					<div class="form-group row">
 						<label for="pilihproduk" class="col-sm-3 col-form-label">Pilih Produk </label>
 						<div class="col-sm-9">
 							<select class="form-control" name="pilihproduk" id="pilihproduk">
 								<option value="">-pilih-</option>
 								<?php foreach ($dataproduk as $row1) : ?>
 									<option value="<?= $row1['id'] ?>"><?= $row1['id'] ?> - <?= $row1['nama'] ?></option>
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
 							<input class="form-control" name="harga" type="text" id="harga" readonly>
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
 							<input class="form-control" name="subtotal" type="text" id="subtotal" disabled>
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
