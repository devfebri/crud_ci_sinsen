 <script>
 	$(document).ready(function() {
 		let count = 1;
 		var dataDetail = <?php echo json_encode($datatransaksidetail); ?>;
 		var dataProduk = <?php echo json_encode($dataproduk); ?>;
 		let dataProdukHtml = '';
 		// alert(count);
 		$.each(dataDetail, function(index, value) {
 			dataProdukHtml += `
            <tr class="remove">
				<td>
				<select class="form-control selectproduk pilihproduk-` + count + `" data-id="` + count + `" name="pilihproduk[]" style="width: 100%; " required>
					<option value="">-pilih-</option>`;
 			$.each(dataProduk, function(index, value1) {

 				if (value1['id'] == value['id_produk']) {
 					dataProdukHtml += '<option value="' + value1['id'] + '" selected>' + value1['kode_produk'] + ' - ' + value1['nama'] + '</option>';
 				} else {
 					dataProdukHtml += '<option value="' + value1['id'] + '">' + value1['kode_produk'] + ' - ' + value1['nama'] + '</option>';
 				}
 			});
 			dataProdukHtml += ` </select>
				</td>
				<td><input type="text" name="harga[]" id="harga-` + count + `" data-id="` + count + `" value="` + value['harga'] + `"  class="form-control harga-` + count + `"  readonly></td>
				<td><input type="number" name="qty[]" id="qty-` + count + `" data-id="` + count + `" class="form-control " value="` + value['qty'] + `"  required></td>
				<td><input type="text" name="subtotal[]" id="subtotal-` + count + `" data-id="` + count + `" class="form-control value" value="` + value['subtotal'] + `"  readonly></td>
				<td><button class="removeBtn btn btn-danger"  class="form-control" required>Remove</button></td>
			</tr>`;
 			count++
 		});
 		$('#tbody').append(dataProdukHtml);

 		$('.pilihproduk-'.count).on('change', function() {
 			var rowke = $(this).data('id');
 			var id_data = $(this).val();
 			alert(rowke);
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
 		// -------------------------------------------------------------

 		$('#btn_tambahproduk').click(function() {
 			// alert(count);
 			let dynamicRowHTML = `
            <tr class="remove">
				<td>
				<select class="form-control selectproduk pilihproduk-` + count + `" data-id="` + count + `" name="pilihproduk[]" style="width: 100%; " required>
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
 				// alert('ok');
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

 		$(document).on('change', '.selectproduk', function() {
 			var selectnumber = $(this).val();
 			alert(selectnumber);
 		});
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
