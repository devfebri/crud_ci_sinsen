 <script>
 	$(document).ready(function() {
 		let count = 1;

 		// Adding row on click to Add New Row button
 		$('#btn_tambahproduk').click(function() {
 			let dynamicRowHTML = `
            <tr class="remove">
				<td><input type="text" name="produk[]" ></td>
				<td><input type="text" name="harga[]" ></td>
				<td><input type="text" name="qty[]" class="col-sm-6"></td>
				<td><input type="text" name="subtotal[]"class="col-sm-6" ></td>
				<td><button class="removeBtn btn btn-danger">Remove</button></td>
			</tr>`;
 			$('#tbody').append(dynamicRowHTML);
 			count++;
 		});

 		// Removing Row on click to Remove button
 		$(document).on("click", ".removeBtn", function() {
 			$(this).closest("tr").remove();
 		});
 	});
 </script>
