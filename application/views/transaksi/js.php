<script>
	let dtgltrx = $('#filtertanggaltransaksi').val(),
		dstatus = $('#filterstatus').val();

	function tampildata() {
		let table = $('#datatable2').DataTable({

			processing: true,
			responsive: true,
			destroy: true,
			serverSide: true,
			ajax: {
				url: "<?= site_url('Transaksi/ambildata') ?>",
				type: "POST",
				data: function(d) {
					d.tanggal_trx = dtgltrx;
					d.status = dstatus;
					return d;
				}
			},
		});


		$('#btnCari').on('click', function() {
			dtgltrx = $('#filtertanggaltransaksi').val();
			dstatus = $('#filterstatus').val();
			table.ajax.reload(null, false);
		});
	}

	function hapus(id) {
		// alert($id);
		Swal.fire({
			title: 'Hapus',
			text: `Yakin menghapus transaksi dengan id =${id} ?`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "post",
					url: "<?= site_url('Transaksi/hapus') ?>",
					data: {
						id: id,
					},
					dataType: "json",
					success: function(response) {
						if (response.sukses) {
							Swal.fire({
								icon: 'success',
								title: 'Konfirmasi',
								text: response.sukses
							});
							tampildata();
						}
					}
				});
			}
		})
	}
	$(document).ready(function() {
		tampildata();
		$('.filter').on('change', function() {
			dstatus = $('#filterstatus').val();
			dtgltrx = $('#filtertanggaltransaksi').val();

			// alert(valtanggal);
			console.log([valstatus, valtanggal]);
		});

		$('#pilihproduk').on('change', function() {

			var id_data = $(this).val();
			// var url = "/Transaksi/getProduk/";
			// alert(url);
			$.ajax({
				url: "<?php echo base_url(); ?>Transaksi/getProduk",
				type: "POST",
				dataType: "json",
				data: {
					"id_data": id_data
				},
				cache: false,
				success: function(data) {
					if (data == null) {
						$('#harga').val('');
						$('#subtotal').val('');
						$('#qty').val('');
					} else {
						$('#harga').val(data['harga']);
						$('#subtotal').val('');
						$('#qty').val('');
					}
				}
			}); // you have missed this bracket
			// return false;
		});
		$('#qty').on('change', function() {
			var qty = $(this).val();
			var harga_produk = $('#harga').val();
			// alert(harga_produk);
			$.ajax({
				url: "<?php echo base_url(); ?>Transaksi/getSubtotal",
				type: "POST",
				dataType: "json",
				data: {
					"qty": qty,
					"harga": harga_produk
				},
				cache: false,
				success: function(data) {
					// alert(data);
					$('#subtotal').val(data);
				}
			})
			// alert(val_data);
		});
	});
</script>
