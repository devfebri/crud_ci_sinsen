 <div class="container-fluid">

 	<div class="row">
 		<div class="col-sm-12">
 			<div class="page-title-box">
 				<h4 class="page-title">Produk
 					<button type="button" class="btn btn-primary waves-effect waves-light float-right btn-small" data-toggle="modal" data-animation="bounce" data-target="#tambahmodal">Tambah Data</button>
 				</h4>
 			</div>
 			<form action="<?php echo base_url() . 'produk/index'; ?>" method="post">
 				<div class="form-group row">
 					<label for="example-text-input" class="col-sm-2 col-form-label">Kode produk </label>
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
 	<h5>Total Rows : <?php echo $total_rows ?></h5>
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
 								<th>Kode Produk</th>
 								<th>Nama</th>
 								<th>Harga</th>
 								<th>Status</th>
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
 									<td><?= $row['kode_produk'] ?></td>
 									<td><?= $row['nama'] ?></td>

 									<?php
										$harga = "Rp " . number_format($row['harga'], 0, ',', '.');
										if ($row['status'] == 1) {
											$status = 'Ya';
										} else {
											$status = 'Tidak';
										} ?>
 									<td><?= $harga ?></td>
 									<td><?= $status ?></td>

 									<td><img src="<?= base_url() . '/foto/' . $row['foto'] ?>" width="100" alt=""></td>
 									<td>
 										<button class="tabledit-edit-button btn btn-sm btn-warning" style="float: none; margin: 5px;" data-toggle="modal" data-animation="bounce" data-target="#editmodal-<?= $row['id'] ?>"><span class="ti-pencil"></span></button>
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




 <!--  Modal Tambah Data -->
 <div class="modal fade " id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title mt-0" id="myLargeModalLabel">Tambah Data</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
 			</div>
 			<?php echo  form_open_multipart(base_url() . "produk/tambah"); ?>
 			<!-- <?php echo form_open(base_url() . "produk/tambah"); ?> -->
 			<!-- <form action="<?php echo base_url() . 'produk/tambah'; ?>" method="post"> -->
 			<div class="modal-body">
 				<div class="form-group row">
 					<label for="kode_produk" class="col-sm-2 col-form-label">Kode Produk </label>
 					<div class="col-sm-10">
 						<input class="form-control" name="kode_produk" type="text" id="kode_produk" required="">
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
 						<select class="form-control" name="status" required="">
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


 <!--  Modal Edit Data -->
 <?php foreach ($dataproduk as $row1) : ?>
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
 <?php endforeach; ?>
