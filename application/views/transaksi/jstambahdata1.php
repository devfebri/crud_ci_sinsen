 <script>
 	$(document).ready(function() {

 		let count = 1;
 		$('#btn_tambahproduk').click(function() {
 			let dynamicRowHTML = `
            <tr class="remove">
				<td>
				<select class="form-control pilihproduk-` + count + `" data-id="` + count + `" name="pilihproduk[]" style="width: 100%; " required>
					<option value="">-pilih-</option>
					<?php foreach ($dataproduk as $row1) : ?>  <option value = "<?= $row1['id'] ?>" ><?= $row1['id'] ?> - <?= $row1['nama'] ?> </option> 
					<?php endforeach; ?> 
 				</select>
				</td>
				<td><input type="text" name="harga[]" id="harga-` + count + `" data-id="` + count + `"  class="form-control harga-` + count + `"  readonly></td>
				<td><input type="number" name="qty[]" id="qty-` + count + `" data-id="` + count + `" class="form-control "  required></td>
				<td><input type="text" name="subtotal[]" id="subtotal-` + count + `" data-id="` + count + `" class="form-control value"  readonly></td>
				<td><button class="removeBtn btn btn-danger"  class="form-control" required>Remove</button></td>
			</tr>`;


 			$('#tbody').append(dynamicRowHTML);
 			$('.pilihproduk-' + count).on('change', function() {
 				var rowke = $(this).data('id');
 				var id_data = $(this).val();
 				if (id_data != '') {
 					$.ajax({
 						url: "<?php echo base_url(); ?>Transaksi/getProduk",
 						type: "POST",
 						dataType: "json",
 						data: {
 							"id_data": id_data
 						},
 						cache: false,
 						success: function(data) {
 							$('.harga-' + rowke).val(data['harga']);
 						}
 					});
 					return false;
 				} else {
 					$('.harga-' + rowke).val('');
 					$('#subtotal-' + rowke).val('');
 					$('#qty-' + rowke).val('');

 					var sum_value = 0;
 					$('.value').each(function() {
 						sum_value += +$(this).val();
 						$('#total').val(sum_value);
 						// alert('ok');
 					});
 				}

 			});
 			$(".pilihproduk-" + count).select2();
 			$('#qty-' + count).on('change', function() {
 				var total = 0;
 				var rowke = $(this).data('id');
 				var qty = $('#qty-' + rowke).val();
 				var harga_produk = $('#harga-' + rowke).val();
 				// alert(qty);
 				var hasil = qty * harga_produk;
 				$('#subtotal-' + rowke).val(hasil);

 				//MENCARI TOTAL HASIL
 				// var arraysubtotal=[1,2,3];
 				// var total=arraysubtotal.reduce(function(total,number){
 				// 	return total+number;
 				// },0);

 				// $('#total').val(total);
 				// alert(total);
 				var sum_value = 0;
 				$('.value').each(function() {
 					sum_value += +$(this).val();
 					$('#total').val(sum_value);
 					// alert('ok');
 				});


 			});
 			count++;
 		});

 		// Removing Row on click to Remove button
 		$(document).on("click", ".removeBtn", function() {
 			$(this).closest("tr").remove();
 			var sum_value = 0;
 			$('.value').each(function() {
 				sum_value += +$(this).val();
 				$('#total').val(sum_value);
 				// alert('ok');
 			});
 		});



 	});
 </script>
