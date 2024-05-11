<script>
	$("#pilihproduk").select2({
		width: '100%'
	});
	$(document).ready(function() {
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
