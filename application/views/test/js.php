<script>
	let dproduk = $('#filterproduk').val(),
		dstatus = $('#filterstatus').val();



	function edit(id) {
		// alert(id);
		$.ajax({
			type: 'post',
			url: "<?= site_url('Test/formedit') ?>",
			data: {
				id: id
			},
			dataType: "json",
			success: function(response) {
				$('#judulHtml').html('Edit Data');
				$('#tambahmodal').modal('show');
				$('#kode_produk').val(response['kode_produk']);
				$('#nama').val(response['nama']);
				$('#harga').val(response['harga']);
				$('.statuss').val(response['status']).change();
				$('#id').val(response['id']);
				$('#foto').val('');
				$('#foto').attr('required', false);
			}
		});
	}

	function hapus(id) {
		Swal.fire({
			title: 'Hapus',
			text: `Yakin menghapus produk dengan id =${id} ?`,
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
					url: "<?= site_url('Test/hapus') ?>",
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

	function tampildata() {
		let table = $('#datatable2').DataTable({
			responsive: true,
			destroy: true,
			processing: true,
			serverSide: true,
			ajax: {
				url: "<?= site_url('Test/ambildata') ?>",
				type: "POST",
				data: function(d) {
					d.produk = dproduk;
					d.status = dstatus;
					return d;
				}
			},
			language: {
				searchPlaceholder: 'Minimal 3 karakter'
			}


		});

		$(".dataTables_filter input")
			.unbind() // Unbind previous default bindings
			.bind("input", function(e) { // Bind our desired behavior
				// If the length is 3 or more characters, or the user pressed ENTER, search
				if (this.value.length >= 3 || e.keyCode == 13) {
					// Call the API search function
					table.search(this.value).draw();
				}
				// Ensure we clear the search if they backspace far enough
				if (this.value == "") {
					table.search("").draw();
				}
				return;
			});

		$('#btnCari').on('click', function() {
			dproduk = $('#filterproduk').val();
			dstatus = $('#filterstatus').val();
			table.ajax.reload(null, false);
		});

		$('#btnReset').on('click', function() {
			// alert('ok');
			$('#filterproduk').val('').change();
			$('#filterstatus').val('').change();
			dproduk = $('#filterproduk').val();
			dstatus = $('#filterstatus').val();
			table.ajax.reload(null, false);
		});


	}

	$(document).ready(function() {



		tampildata();



		$('#centangSemua').click(function(e) {
			if ($(this).is(':checked')) {
				$(".centangId").prop("checked", true);
			} else {
				$(".centangId").prop("checked", false);
			}
		});
		$('.formhapus').submit(function(e) {


			let jmldata = $('.centangId:checked');

			if (jmldata.length === 0) {
				Swal.fire({
					icon: 'warning',
					title: 'Perhatian',
					text: 'Maaf tidak ada yang bisa dihapus, silahkan dicentang !'
				})
			} else {
				Swal.fire({
					title: 'Hapus Data',
					text: `Ada ${jmldata.length} data produk yang akan dihapus, yakin ?`,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Hapus',
					cancelButtonText: 'Tidak'
				}).then((result) => {
					if (result.value) {
						// console.log($(this).serialize())
						$.ajax({
							type: "post",
							url: $(this).attr('action'),
							data: $(this).serialize(),
							dataType: "json",
							success: function(response) {
								if (response.sukses) {
									Swal.fire({
										icon: 'success',
										title: 'Berhasil',
										text: response.sukses
									})
									tampildata();
								}
							},
							error: function(xhr, ajaxOptions, thrownError) {
								alert(xhr.status + "\n" + xhr.responseText + "\n" +
									thrownError);
							}
						});
					}
				})
			}
			return false;
		});


		$('#tomboltambah').click(function() {
			$('#kode_produk').val('');
			$('#nama').val('');
			$('#harga').val('');
			$('#id').val('');
			$('.statuss').val('').change();
			$('#foto').val('');
			// $('.statuss select option[value=""]').attr("selected", true);
			$('#judulHtml').html('Tambah Data');
			$('#foto').attr('required', true);
			$('#tambahmodal').modal('show');

		});


		$('.formsimpan').submit(function(e) {
			// alert($(this).attr('action'));
			$.ajax({
				type: "post",
				url: $(this).attr('action'),
				data: new FormData(this),
				dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				success: function(response) {
					// alert('ok');
					if (response.error) {
						$('.pesan').html(response.error).show();
					}
					if (response.sukses) {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: response.sukses
						});
						tampildata();
						$('#tambahmodal').modal('hide');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
				}
			});
			return false;
		});

	});
</script>
