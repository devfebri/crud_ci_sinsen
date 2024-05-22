<div class="container-fluid">

	<div class="row">
		<div class="col-sm-12">
			<div class="page-title-box">
				<div class="btn-group float-right">

				</div>
				<h4 class="page-title">Edit Data Transaksi</h4>
			</div>
		</div>
	</div>
	<!-- end page title end breadcrumb -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card m-b-30">
				<?php echo form_open(base_url() . "Transaksi/kirimdataedit"); ?>
				<div class="card-body">
					<h4 class="header-title mt-0">Transaksi Header</h4>
					<div class="form-group row">
						<label for="nama_consumen" class="col-sm-3 col-form-label">Kode Transaksi</label>
						<div class="col-sm-9">
							<input class="form-control" name="kode_trx" type="text" id="kode_trx" value="<?= $datatransaksi->kode_trx ?>" readonly>
							<input class="form-control" name="id_trx" type="hidden" id="id_trx" value="<?= $datatransaksi->id_trx ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="nama_consumen" class="col-sm-3 col-form-label">Nama Consumen</label>
						<div class="col-sm-9">
							<input class="form-control" name="nama_consumen" type="text" id="nama_consumen" value="<?= $datatransaksi->nama_consumen ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
						<div class="col-sm-9">
							<textarea name="deskripsi" id="deskripsi" class="form-control" required><?= $datatransaksi->deskripsi ?></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="status" class="col-sm-3 col-form-label">Status </label>
						<div class="col-sm-9">
							<select class="form-control " style="width: 100%; height:36px;" name="status" required>
								<option value="">-pilih-</option>
								<option <?php if ($datatransaksi->status == 1) { ?>selected <?php } ?> value="1">New</option>
								<option <?php if ($datatransaksi->status == 2) { ?>selected <?php } ?> value="2">Process</option>
								<option <?php if ($datatransaksi->status == 3) { ?>selected <?php } ?> value="3">Close</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body">
					<h4 class="header-title mt-0">Transaksi Detail <a href="javascript:void(0)" id="btn_tambahproduk" class="btn btn-primary">+</a> </h4>
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="30%">Produk</th>
								<th width="25%">Harga</th>
								<th width="10%">Qty</th>
								<th width="25%">Subtotal</th>
								<th width="10%"></th>
							</tr>
						</thead>
						<tbody id="tbody">

						</tbody>
						<tfoot>
							<tr>
								<td colspan="3"><b>Total</b></td>
								<td><input type="text" class="form-control" name="total" id="total" value="<?= $datatransaksi->total ?>" readonly></td>
							</tr>
						</tfoot>
					</table>
					<button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Simpan</button>
				</div>
				<?php echo form_close(); ?>

			</div>

		</div> <!-- end col -->

	</div> <!-- end row -->

</div>
