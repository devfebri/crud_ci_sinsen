 <div class="container-fluid">

 	<div class="row">
 		<div class="col-sm-12">
 			<div class="page-title-box">
 				<h4 class="page-title">Transaksi
 					<!-- <button type="button" class="btn btn-primary waves-effect waves-light float-right btn-small ml-2" data-toggle="modal" data-animation="bounce" data-target="#tambahmodal">Tambah Data</button> -->
 					<a href="<?= base_url('Transaksi/tambahdata1'); ?>" class="btn btn-primary waves-effect waves-light float-right btn-small ml-2">Tambah Data</a>
 				</h4>
 			</div>

 		</div>
 	</div>
 	<div class="row">
 		<div class="col-12">
 			<div class="card m-b-30">

 				<div class="card-body">
 					<!-- <h4 class="header-title mt-0">TRANSAKSI
 						<a href="<?= base_url('Transaksi/tambahdata1'); ?>" class="btn btn-primary waves-effect waves-light float-right btn-small ml-2">Tambah Data</a>

 					</h4> -->
 					<div class="row">
 						<div class="col-6">
 							<h6 class="text-muted fw-400"><b>Status</b></h6>
 							<select class="select2 form-control mb-3 custom-select filter" id="filterstatus" style="width: 100%; height:36px;">
 								<option value="">-pilih-</option>
 								<option value="1">New</option>
 								<option value="2">Process</option>
 								<option value="3">Close</option>
 							</select>
 						</div>
 						<div class="col-6">
 							<h6 class="text-muted fw-400"><b>Tanggal</b></h6>
 							<input type="date" class="form-control filter" id="filtertanggaltransaksi">
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
 						
 					</table>

 				</div>
 			</div>
 		</div> <!-- end col -->
 	</div> <!-- end row -->

 </div><!-- container -->
