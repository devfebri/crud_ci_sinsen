<div class="container-fluid">

	<div class="row">
		<div class="col-sm-12">
			<div class="page-title-box">
				<div class="btn-group float-right">

				</div>
				<h4 class="page-title">Tambah Data</h4>
			</div>
		</div>
	</div>
	<!-- end page title end breadcrumb -->

	<div class="row">
		<div class="col-lg-12">
			<div class="card m-b-30">
				<?php echo form_open(base_url() . "Transaksi/kirimdata"); ?>
				<div class="card-body">
					<h4 class="header-title mt-0">Transaksi Header</h4>
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
				<div class="card-body">
					<h4 class="header-title mt-0">Transaksi Detail <a href="javascript:void(0)" id="btn_tambahproduk" class="btn btn-primary">+</a> <a href="javascript:void(0)" id="btn_removeproduk" class="btn btn-danger">-</a></h4>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Produk</th>
								<th>Harga</th>
								<th  width="10%">Qty</th>
								<th>Subtotal</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="tbody">
						</tbody>
					</table>

					<button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Simpan</button>
				</div>
				<?php echo form_close(); ?>
			</div>

		</div> <!-- end col -->

	</div> <!-- end row -->

</div>
